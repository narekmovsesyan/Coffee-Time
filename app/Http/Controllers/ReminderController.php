<?php

namespace App\Http\Controllers;

use App\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReminderController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'time' => 'required|date|after:today',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $reminder_check = Reminder::where([
            ['user_id',  Auth::id()],
            ['date_time', $request->time],
            ['status', 0]
        ])->get();

        if(!isset($reminder_check[0])){
            Reminder::create([
                'user_id' => Auth::id(),
                'date_time' => $request->time,
                'status' => 0
            ]);

            return redirect()->back()->with('messages', 'Reminder successfully saved');
        } else {
            return redirect()->back()->withErrors('You already have this reminder');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAll(){
        $my_reminders = Reminder::where('user_id', Auth::id())->orderBy('updated_at', 'DESC')->get();

        if(isset($my_reminders[0])){
            return view('my_reminders', compact('my_reminders'));
        } else {
            return view('my_reminders')->with('messages', 'You have not any reminder');
        }
    }
}
