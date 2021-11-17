<?php

namespace App\Http\Controllers;
use App\Imports\SentencesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AutomaticController extends Controller
{
    public function import(Request $request) 
    {  

        Excel::import(new SentencesImport(), $request->file('import_file'));
        
        return redirect('/automatic')->with('success', 'file uploaded successfully!');
    }
}
