<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function get_test_for_invoice(Request $request){

        $searchText = $request->input('search_text');
        $data = DB::table('tests')->where('testName','LIKE','%'.$searchText.'%')->get();

        return response()->json($data);

    }
}
