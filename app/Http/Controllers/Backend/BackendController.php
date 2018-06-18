<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    protected $limit = 7;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check-permissions');
    }
}
