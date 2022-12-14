<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketClaim;
use Illuminate\Http\Request;

class TicketShareController extends Controller
{
    public function share($league_id, $match_id){
        $ownTickets = Ticket::whereOwnerId(\Auth::id())->where('league_id', $league_id)->get();
        foreach ($ownTickets as $item){
            if(TicketClaim::whereTicketId($item->id)->whereNull('claimed_by_id')->where('match_id', $match_id)->count() == 0){
                $claim = new TicketClaim;
                $claim->ticket_id = $item->id;
                $claim->match_id = $match_id;
                $claim->save();
            }
        }

        return back();
    }

    public function booking($league_id, $match_id){
        $freeticket = TicketClaim::whereMatchId($match_id)->inRandomOrder()->first();
        $freeticket->claimed_by_id = \Auth::id();
        $freeticket->save();

        return back();
    }
}
