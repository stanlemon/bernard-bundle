<?php

namespace Bernard\BernardBundle\Message;

use Bernard\Message\DefaultMessage;

class EchoMessageHandler
{
    public function echoMessageHandler(DefaultMessage $message)
    {
        echo $message->message . PHP_EOL;
    }
}