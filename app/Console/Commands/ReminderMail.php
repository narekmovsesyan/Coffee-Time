<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Reminder;

class ReminderMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:reminder-each-minute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $active_reminders = Reminder::with('users')->where('status', 0)
            ->where('date_time', Carbon::now()->format('m/d/Y g:i A'))
            ->where('deleted_at', Null)
            ->get();

        if(isset($active_reminders[0])){
            $active_reminders->each(function ($item) {
                \Mail::send('reminder_email', ['name' => $item->name], function ($message) use ($item) {
                    $message->to($item->users[0]->email)->subject('Reminder!');
                    $this->info("Reminder to ".$item->users[0]->email." sended !");
                });

                Reminder::where('id', $item->id)
                    ->update([
                        'status' => 1,
                    ]);
            });
        } else {
            $this->info("There are no reminders for this minute !");
        }
    }
}
