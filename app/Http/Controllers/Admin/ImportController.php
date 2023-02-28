<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Imports\DataImport;
use Maatwebsite\Excel\Facades\Excel;
class ImportController extends Controller
{
    public function get()
    {

        return view('admin.import.view');

    }

    public function import(Request $request)
    {
    
       Excel::import(new DataImport,$request->file);


       return redirect('admin/import/data')->with('status', 'Import Done' );

    }
}