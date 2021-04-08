<?php

namespace App\Modules\Webinar\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(Request $request): View
    {
        return view('webinar::contact.index', [
            'locale' => $request->user()->getLocaleAttribute(),
            'brand' => isHyster() ? 'hyster' : 'yale'
        ]);
    }
}
