<?php

namespace App\Http\Controllers\Admin\Import;

use App\Http\Controllers\Controller;
use App\User;
use App\EnvX\Database\AutoImport;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\Csv\AbstractCsv;
use League\Csv\Reader;

class UserController extends Controller
{
    private $importer;
    protected $extensionSupported = ['csv'];

    public function __construct(AutoImport $importer)
    {
        $this->importer = $importer;
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $file = $request->file('file');
        if (!$file || !in_array($file->getClientOriginalExtension(), $this->extensionSupported)) {
            return back()->with('error', "Only CSV files are supported.");
        }

        $countSuccess = 0;
        $countFailure = 0;

        $rows = $this->collectRows($request);

        $rows->each(function (array $row) use (&$countSuccess, &$countFailure) {
            $row = $this->processForSemiColonDelimeter($row);
            $row = array_change_key_case($row,CASE_LOWER);
            try {
                $validator = Validator::make($row, [
                    'brand' => 'required',
                    'name' => 'required',
                    'email' => 'required|email:filter|safe',
                    'language' => 'required',
                    'role' => 'required',
                ]);

                if ($validator->fails()) {
                    $countFailure++;

                    return;
                }

                $splitName = $this->splitName($row['name']);
                $data = [
                    'password' => empty($row['password']) ? bcrypt(Str::random()) : bcrypt($row['password']),
                    'api_token' => Str::random(32),
                    'needs_reset' => 0,
                    'forename' => $splitName[0],
                    'surname' => $splitName[1]
                ];

                if ($row['role'] === User::ROLE_EMPLOYEE) {
                    $data['employee_function'] = $row['employee_function'] ?? $row['dealership_name'] ?? '';
                } else if ($row['role'] === User::ROLE_DEALER) {
                    $data['dealership_name'] = $row['dealership_name'] ?? $row['employee_function'] ?? '';
                }

                $row = array_merge($row, $data);

                unset($row['name']);

                User::updateOrCreate([
                    'email' => $row['email'],
                    'brand' => $row['brand']
                ], $row);

                $countSuccess++;
            } catch (\Throwable $e) {
                $countFailure++;
            }
        });

        return back()->with('success', "{$countSuccess} Delegates have been imported.");
    }

    /**
     * @return \Illuminate\Support\Collection
     * @throws Exception
     */
    protected function collectRows(Request $request): Collection
    {
        $file = Reader::createFromPath($request->file('file')->path());

        $this->setHeaders($file);

        return collect(
            $file->setHeaderOffset(0)->getRecords()
        );
    }

    /**
     * @param AbstractCsv $file
     * @return Collection
     */
    private function setHeaders(AbstractCsv $file): Collection
    {
        return $this->headers = collect($file->fetchOne());
    }

    /**
     * @param $name
     * @return array
     */
    private function splitName($name): array {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim( preg_replace('#'.preg_quote($last_name,'#').'#', '', $name ) );
        return array($first_name, $last_name);
    }

    private function processForSemiColonDelimeter($row) {
        if (count($row) == 1) {
            $keys = array_keys($row);
            $keys = explode(';', $keys[0] ?? '');

            $values = array_values($row);
            $values = explode(';', $values[0] ?? '');

            $length = count($keys);
            $row = [];

            for ($i = 0; $i < $length; $i++) {
                $row[$keys[$i]] = $values[$i] ?? '';
            }
        }

        return $row;
    }
}
