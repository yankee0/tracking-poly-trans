<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Web extends BaseController
{
    public function home()
    {
        return view('pages/home');
    }
}
