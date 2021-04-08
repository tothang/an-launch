<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Modules\Webinar\Models\Stream;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadController extends Controller
{
    public function __invoke(Request $request, string $export, ?Stream $stream): BinaryFileResponse
    {
        return (new $export($stream))->download($this->filename($export));
    }

    private function filename(string $export): string
    {
        return app_auto_prefix(class_basename($export) . '_' . now()->format('Y_m_d_h_i_s') . '.xlsx');
    }
}
