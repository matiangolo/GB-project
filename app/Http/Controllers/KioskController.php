<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KioskController extends Controller
{

    public function surveyKiosk()
    {
        //        '.' = next item in path
        return view('kiosks.survey');
    }

}
