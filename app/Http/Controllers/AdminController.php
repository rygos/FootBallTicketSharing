<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show_settings(){
        $settings_data = Setting::all();

        foreach($settings_data as $i){
            $settings[$i->option] = $i->value;
        }

        return view('admin.settings.show', [
            'settings' => $settings,
        ]);
    }

    public function store_settings(Request $request){
        $this->validate($request, [
            'api_last_update' => 'required',
            'booking_days_after_match' => 'required',
            'booking_random_ticket' => 'required',
        ]);

        Setting::updateOrCreate(['option' => 'api_last_update'],['value' => $request->post('api_last_update')]);
        Setting::updateOrCreate(['option' => 'booking_days_after_match'],['value' => $request->post('booking_days_after_match')]);
        Setting::updateOrCreate(['option' => 'booking_random_ticket'],['value' => $request->post('booking_random_ticket')]);

        return back()->with('success', __('Settings saved.'));
    }
}
