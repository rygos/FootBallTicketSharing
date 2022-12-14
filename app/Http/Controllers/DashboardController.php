<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Match_;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    public function index(){

        //Get Last API Update Date from Database
        $lu_db = Setting::whereOption('api_last_update')->first();
        if(is_null($lu_db)){
            $lu_db_time = Carbon::parse(0);
        }else{
            $lu_db_time = Carbon::parse($lu_db->value);
        }

        $lu_data = json_decode(file_get_contents('https://www.openligadb.de/api/getmatchdata/bl1'));
        $league_name = $lu_data[0]->LeagueName;

        $check_api = false;
        foreach ($lu_data as $i) {
            $league_id = $i->LeagueId;
            $league_name = $i->LeagueName;
            if(Carbon::parse($i->LastUpdateDateTime) > Carbon::parse($lu_db_time)){
                $check_api = true;
                $lu_db_time = Carbon::parse($i->LastUpdateDateTime);
            }
        }

        if($check_api){
            $output = file_get_contents("https://www.openligadb.de/api/getmatchdata/bl1/".Carbon::now()->year);
            $data = json_decode($output);

            foreach ($data as $item) {
                if($item->Team1->TeamId == \Config::get('app.team_id')){
                    $up = Match_::updateOrCreate(
                        ['match_id' => $item->MatchID],
                        [
                            'league_id' => $item->LeagueId,
                            'match_id' => $item->MatchID,
                            'match_time' => Carbon::parse($item->MatchDateTime),
                            'team1_id' => $item->Team1->TeamId,
                            'team1_name' => $item->Team1->TeamName,
                            'team2_id' => $item->Team2->TeamId,
                            'team2_name' => $item->Team2->TeamName,
                            'group_name' => $item->Group->GroupName,
                            'last_update' => $item->LastUpdateDateTime,
                            'is_finished' => $item->MatchIsFinished,
                            'result_end_t1' => @$item->MatchResults[0]->PointsTeam1,
                            'result_end_t2' => @$item->MatchResults[0]->PointsTeam2,
                            'result_half_t1' => @$item->MatchResults[1]->PointsTeam1,
                            'result_half_t2' => @$item->MatchResults[1]->PointsTeam2,
                        ]
                    );
                }

            }
        }

        //Settings Aktualisieren oder Default setzen wenn nich vorhanden.
        Setting::updateOrCreate(['option' => 'api_last_update'], ['value' => $lu_db_time]);
        Setting::firstOrCreate(['option' => 'booking_days_after_match', 'value' => 7]);

        //Liga Tabelle aktualisieren
        League::updateOrCreate(['league_id' => $league_id],['league_name' => $league_name]);

        $data = Match_::whereLeagueId($league_id)->get();

        return view('Dashboard',[
            'data' => $data,
            'league_name' => $league_name,
        ]);
    }
}
