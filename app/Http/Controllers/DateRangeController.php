<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class DateRangeController extends Controller
{
    function index(Request $request)
    {

        if(request()->ajax())
        {
            if(!empty($request->from_date))
            {
                $data = DB::table('table')
                    ->whereBetween('order_date', array($request->from_date, $request->to_date))
                    ->get();
            }
            else
            {
                $data = DB::table('table')
                    ->get();
            }
            return datatables()->of($data)->make(true);
        }
        return view('daterange');
    }
}

?>
 