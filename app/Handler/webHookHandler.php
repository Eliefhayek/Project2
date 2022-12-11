<?php

namespace app\Handler;

use Spatie\WebhookClient\Jobs\ProcessWebhookJob as SpatieProcessWebhookJob;

class webHookHandler extends SpatieProcessWebhookJob{
    public function handle(){
        logger($this->webhookCall);
    }

}
