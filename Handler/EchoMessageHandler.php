<?php

/**
 * (c) 2013 - ∞ Bernard
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bernard\BernardBundle\Handler;

use Bernard\Message\DefaultMessage;

class EchoMessageHandler
{
    public function echoMessageHandler(DefaultMessage $message)
    {
        echo $message->message . PHP_EOL;
    }
}