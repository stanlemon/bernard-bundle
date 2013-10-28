<?php

namespace Cordoval\BernardBundle\Message;

use Bernard\Message\DefaultMessage;

/**
 * Inspired from https://github.com/stanlemon/bernard-app
 */
class EchoMessageHandler
{
    public function echoMessageHandler(DefaultMessage $message)
    {
        echo $message->message . PHP_EOL;
    }
}