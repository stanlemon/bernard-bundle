<?php

/**
 * (c) 2013 - ∞ Bernard
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bernard\BernardBundle\Handler;

use Bernard\Message\DefaultMessage;

abstract class InvokeMessageHandler
{
    public function __call($methodName, $arguments)
    {
        $className = get_class($this);
        if ($methodName == lcfirst($className)) {
            return $this->__invoke($arguments);
        }

        throw new \Exception('Wrong method called on message handler');
    }

    abstract public function __invoke(DefaultMessage $message);
}