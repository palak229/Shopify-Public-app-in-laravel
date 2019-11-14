<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class appMainController extends Controller
{
    public function __construct()
    {
    	$this->store = Session::get('storename');
    }

    public function index(Request $request)
    {
    	$shop = $request->shop;
    	Session::put('storename',$shop);
    	echo Session::get('storename');
    }
}
