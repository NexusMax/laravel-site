<?php

namespace App\Console\Commands;

use App\Settings;
use Illuminate\Console\Command;

class Currency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:usd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get currency usd';

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
        $url = "https://foxter.inf.ua/api/currency/curl.php";
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        $json = curl_exec($curl);
        curl_close($curl);
        unset($curl);
        $courses = json_decode($json, true);

        if (!empty($courses['usd'])) {
            Settings::where('param', 'currency_usd_uah')->update(['value' => $courses['usd']]);
        }
        return false;
    }
}
