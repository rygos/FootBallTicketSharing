<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    public function index(){

        $output = file_get_contents("https://www.openligadb.de/api/getmatchdata/bl1/2022");
        $data = json_decode($output);

        return view('Dashboard',[
            'data' => $data,
        ]);
    }
}
