<?php

namespace Bernard\BernardBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

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
                $className = $container->getParameterBag()->resolveValue($className);
            }

            $reflection = new \ReflectionClass($className);
            $receivers[$reflection->getShortName()] = $id;
        }

        $definition->addArgument($receivers);
    }
}