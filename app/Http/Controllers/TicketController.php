<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use function Symfony\Component\String\b;

class TicketController extends Controller
{
    public function show(){
        $data = Ticket::whereOwnerId(\Auth::user()->id)->get();

        return view('tickets.show', [
            'data' => $data,
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'description' => 'required',
            'season' => 'required',
        ]);

        //get league_id from year
        $league_id = $request->post('season');

        $ticket = new Ticket;
        $ticket->league_id = $league_id;
        $ticket->owner_id = \Auth::id();
        $ticket->title = $request->post('description');
        $ticket->save();

        return back()->with('success', __('You have successfully added your ticket.'));
    }

    public function delete($id){
        //Todo: Karte entfernen
    }
}
