<?php


namespace App\Http\Controllers\Admin\Export;


use App\Http\Controllers\Admin\Report\IndexController;
use App\Http\Controllers\Controller;
use League\Csv\Writer;

class ExportReportController extends Controller
{
    public function __invoke()
    {
        $csv = Writer::createFromFileObject(new \SplTempFileObject());

        $delegates = IndexController::getReportQuery()->get();

        $headers = [
            'Name',
            'Email',
            'Brand',
            'Role',
            'Duration of viewed time'
        ];

        $csv->insertOne([isHyster() ? 'Hyster Report' : 'Yale Report']);
        $csv->insertOne(['']);

        $csv->insertOne($headers);
        $delegates->each(function($delegate) use ($csv){
            $csv->insertOne([
                $delegate->forename . ' ' . $delegate->surname,
                $delegate->email,
                $delegate->brand,
                $delegate->role,
                gmdate("H:i:s", $delegate->view_time)
            ]);
        });

        $prefix = isHyster() ? 'hyster-report-' : 'yale-report-';
        $csv->output($prefix . time() . '.csv');

        exit;
    }
}