<?php

namespace App\Listeners;

use App\Events\ApiRequest;
use App\Models\ApiLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogApi
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ApiRequest  $event
     * @return void
     */
    public function handle(ApiRequest $event)
    {
        ApiLog::create([
            'method' => $event->method,
            'data'=> $event->data,
        ]);
    }
}
