<?php

namespace Bernard\BernardBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Bernard\BernardBundle\DependencyInjection\Compiler\MessageServiceCompilerPass;
use Bernard\BernardBundle\DependencyInjection\Compiler\ServiceSetupCompilerPass;

class BernardBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ServiceSetupCompilerPass());
        $container->addCompilerPass(new MessageServiceCompilerPass());
    }
}
