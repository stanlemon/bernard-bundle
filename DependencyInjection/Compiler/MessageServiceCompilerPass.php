<?php

namespace Cordoval\BernardBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Inspired from https://github.com/stanlemon/bernard-app
 */
class MessageServiceCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('bernard.router');
        $taggedServices = $container->findTaggedServiceIds('bernard.receiver');

        $receivers = [];
        foreach ($taggedServices as $id => $attributes) {
            $service = $container->getDefinition($id);

            if (!class_exists($className = $service->getClass())) {
                $className = $container->getParameterBag()->resolveValue($service->getClass());
            }

            $reflection = new \ReflectionClass($className);
            $receivers[$reflection->getShortName()] = $id;
        }

        $definition->addArgument($receivers);
    }
}