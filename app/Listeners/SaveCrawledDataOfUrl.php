<?php

namespace App\Listeners;

use App\PocketContent;
use App\Jobs\StoreCrawlData;
use App\Events\WebUrlCrawled;

class SaveCrawledDataOfUrl
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
     * @param  WebUrlCrawled  $event
     * @return void
     */
    public function handle($event)
    {
        StoreCrawlData::dispatch($event);
    }
}
