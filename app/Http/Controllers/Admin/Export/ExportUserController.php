<?php

namespace App\Http\Controllers\Admin\Export;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use League\Csv\Writer;
use SplTempFileObject;

class ExportUserController extends Controller
{
    /**
     * @param Request $request
     */
    public function __invoke(Request $request, string $brand)
    {
        $csv = $this->createCsv([
            'Brand',
            'Name',
            'Email address',
            'Language',
            'Role',
            'Dealership Name / Employee Function',
            'Country / Office Location',
            'Region',
            'Breakout group',
            'City'
        ]);

        User::where('brand', $brand)->chunk(200, function (Collection $users) use (&$csv) {
            $rows = $users->map(function (User $user) {
                return [
                    $user->getBrandStringify(),
                    $user->name,
                    $user->email,
                    $user->getLanguageStringify(),
                    $user->getRoleStringify(),
                    $user->getDealerShipNameOrEmployeeFunction(),
                    $user->country_office_location,
                    $user->region,
                    $user->breakout_group,
                    $user->city
                ];
            });

            $csv->insertAll($rows);
        });

        $csv->output('delegates_' . now()->format('Y_m_d_h_i_s') . '.csv');
        exit;
    }

    /**
     * Create empty csv
     *
     * @param array $headers
     * @return \League\Csv\Writer
     */
    protected function createCsv(array $headers = [])
    {
        $csv = Writer::createFromFileObject(new SplTempFileObject());

        if (! empty($headers)) {
            $csv->setOutputBOM(Writer::BOM_UTF8);

            $csv->insertOne($headers);
        }

        return $csv;
    }
}
