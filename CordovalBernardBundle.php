<?php

namespace Cordoval\BernardBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Cordoval\BernardBundle\DependencyInjection\Compiler\MessageServiceCompilerPass;
use Cordoval\BernardBundle\DependencyInjection\Compiler\ServiceSetupCompilerPass;

class CordovalBernardBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ServiceSetupCompilerPass());
        $container->addCompilerPass(new MessageServiceCompilerPass());
    }
}
