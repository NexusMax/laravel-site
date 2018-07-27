<?php

namespace App\Console\Commands;

use App\User;
use App\Mailchimp as Mail;
use Illuminate\Console\Command;

class MailChimp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailchimp:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MailChimp';

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
        $user = new User();
        $mail = new Mail();
        $from = strtotime(date('Y-m-d H:i:s'));
        $to = date('Y-m-d H:i:s', strtotime('-3 hour', $from));
        $users = $user->where('lastmod', '<', $to)->orWhere('lastmod', null)->limit(20)->get();

        foreach ($users as $u) {
            $result = $mail->check_landing($u['email']);
            if (!empty($result)) {
                $url = $result->_links[4]->href;

                $mail->curl('DELETE', '', '', $url);
            }
            $mail->for_cron_update($u['id'], $u['experience']);

            // Обновляем дату последнего апдейта
            $task = User::find($u['id']);
            $task->fill([
                'landing_reg' => 1,
                'lastmod' => date('Y-m-d H:i:s'),
            ])->save();
        }

    }
}
