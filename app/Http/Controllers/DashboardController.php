<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    public function index(){

        $output = file_get_contents("https://www.openligadb.de/api/getmatchdata/bl1/".Carbon::now()->year);
        $data = json_decode($output);

        return view('Dashboard',[
            'data' => $data,
        ]);
    }
}
