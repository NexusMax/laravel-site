<?php

namespace App\Listeners;

use App\Events\OrderStoredEvent;
use Illuminate\Http\Request;

class StoreOrderUserAgentEventListener
{
    private $request;
    private $ip;

    /**
     * Create the event listener.
     *
     * @author Tarasovych
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->ip = $request->ip();
    }

    /**
     * Handle the event. Store User-Agent data after new Order is stored.
     *
     * @author Tarasovych
     * @param  OrderStoredEvent $event
     * @return void
     */
    public function handle(OrderStoredEvent $event)
    {
        $event->order->update(
            [
                'ip' => $this->ip,
                'country' => geoip($ip = $this->ip)->country,
                'sc_userid' => $this->request->cookie('sc_userid'),
                'user_agent' => $this->request->header('User-Agent')
            ]
        );
    }
}
