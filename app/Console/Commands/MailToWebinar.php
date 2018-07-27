<?php

namespace App\Console\Commands;

use App\EventsOrder;
use App\ItemsEvents;
use App\Logging;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MailToWebinar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webinar:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command MailToWebinar';

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
     * @return mixed
     */
    public function handle()
    {
        $from = strtotime(date('Y-m-d H:i:s'));
        $to = [
            strtotime('+10 minutes', strtotime(date('Y-m-d H:i:s'))),
            strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))),
            strtotime('+4 hours', strtotime(date('Y-m-d H:i:s'))),
            strtotime('+1 day', strtotime(date('Y-m-d H:i:s'))),
        ];
//        $items = ItemsEvents::where('created_at' , '>', date('Y-m-d H:i:s', $from))
//            ->where('created_at' , '<=', date('Y-m-d H:i:s', $to))
//            ->get();
        $users = EventsOrder::select('events_order.*')
            ->leftjoin('sp_items_events', 'sp_items_events.id', 'events_order.event_id')
            ->where('sp_items_events.created_at', '>', date('Y-m-d H:i:s'))
            ->get();
        foreach ($users as $u) {
            $item = ItemsEvents::where('created_at', '>', $from)
                ->where('id', intval($u->event_id))
                ->get()->first();
            $start_event = strtotime(date('Y-m-d H:i:s', strtotime($item['created_at'])));

            if (($from < $start_event) && ($start_event <= $to[0])) {
                $this->mailto('10m', $u, $item);
            } else if (($to[0] < $start_event) && ($start_event <= $to[1])) {
                $this->mailto('60m', $u, $item);
            } else if (($to[1] < $start_event) && ($start_event <= $to[2])) {
                $this->mailto('4h', $u, $item);
            } else if (($to[2] < $start_event) && ($start_event <= $to[3])) {
                $this->mailto('1d', $u, $item);
            }
        }
    }

    private function mailto($id, $u, $item) {
        $template = 'vendor.mail.html.events.event_' . $id;
        $user = User::find(intval($u->user_id));

        $log = Logging::where('action', $id)
            ->where('object_id', 'webinar_'.$item['id'])
            ->where('email', $user['email'])
            ->count();
        if (!$log) {
            if (empty($template)) die('please create template ' . $template);

            Mail::send($template, [
                'name' => $user['name'],
                'item' => $item,
                'subject' => 'Напоминание о вебинаре',
            ], function ($m) use ($user) {
                $m->from('info@sportcasta.com', 'Sport Casta');
                $m->to($user['email'], $user['name'])->subject('Напоминание о вебинаре');
            });

            Logging::create(array(
                'action' => $id,
                'object_id' => 'webinar_' . $item['id'],
                'email' => $user['email']
            ));
        }
    }
}
