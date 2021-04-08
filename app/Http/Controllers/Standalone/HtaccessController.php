<?php

namespace App\Http\Controllers\Standalone;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class HtaccessController extends Controller
{
    public function __invoke(): ?string
    {
        return "200";
    }
}
