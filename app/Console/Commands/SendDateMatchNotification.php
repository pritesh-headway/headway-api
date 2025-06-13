<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\UserDevices;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Services\FcmNotificationService;


class SendDateMatchNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:date-match';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = UserDevices::whereNotNull('device_token')->where('status', 1)->get();
        $fcm = new FcmNotificationService();
        $receiver_id = [];
        foreach ($users as $user) {
            $receiver_id[] = $user->user_id;
        }

        $today = Carbon::today()->toDateString(); // e.g. '2025-06-09'

        $events = Event::whereDate('event_date', $today)->where('status', 1)->get();
        $newData  = json_encode(array());
        foreach ($events as $key => $evnt) {
            $message = $evnt->event_name . ' - Location:' . $evnt->location . ' is happening today!';

            $body = array('receiver_id' => $receiver_id, 'title' => $message, 'message' => $message, 'data' => $newData, 'content_available' => true);

            $fcm->sendFcmNotification($body);
        }
    }
}
