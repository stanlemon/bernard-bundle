<?php

namespace Cordoval\BernardBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * Inspired from https://github.com/stanlemon/bernard-app
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class CordovalBernardExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        // Configure driver
        switch ($config['driver']) {
            case 'dbal':
                $connectionName = sprintf("doctrine.dbal.%s_connection", $config['dbal']);

                $container->getDefinition('bernard.doctrine_driver')
                    ->setArguments([new Reference($connectionName)])
                ;

                $container->setAlias('bernard.driver', 'bernard.doctrine_driver');
                break;
            case 'sqs':
                $sqs = new Definition('Aws\Sqs\SqsClient');
                $sqs->setFactoryClass('Aws\Sqs\SqsClient');
                $sqs->setFactoryMethod('factory');
                $sqs->setArguments([
                        [
                            'key'      => $config['sqs']['key'],
                            'secret'   => $config['sqs']['secret'],
                            'region'   => $config['sqs']['region'],
                        ]
                    ]
                );

                $container->setDefinition('bernard.sqs', $sqs);

                $container->setAlias('bernard.driver', 'bernard.sqs_driver');
                break;
            case 'redis':
                $redis = new Definition('Redis');
                $redis->addMethodCall('connect', [$config['redis']['host'], $config['redis']['port']]);
                $redis->addMethodCall('setOption', [2, 'bernard:']);

                $container->setDefinition('bernard.redis', $redis);

                $container->setAlias('bernard.driver', 'bernard.redis_driver');
                break;
            case 'predis':
                $predis = new Definition('Predis\Client');
                $predis->setArguments([
                        $config['predis']['dsn'],
                        [
                            'prefix' => 'bernard:',
                        ]
                    ]
                );

                $container->setDefinition('bernard.predis', $predis);

                $container->setAlias('bernard.driver', 'bernard.predis_driver');
                break;
            case 'ironmq':
                $ironmq = new Definition('IronMQ');
                $ironmq->setArguments([
                        [
                            'token'      => $config['ironmq']['token'],
                            'project_id' => $config['ironmq']['project_id'],
                        ]
                    ]
                );

                $container->setDefinition('bernard.ironmq', $ironmq);

                $container->setAlias('bernard.driver', 'bernard.ironmq_driver');
                break;
            case 'appengine':
            default:
                throw new \RuntimeException(sprintf("The %s driver is not yet implemented", $config['driver']));
        }


        // Configure serializer
        switch ($config['serializer']) {
            case 'simple':
                $serializer = 'bernard.simple_serializer';
                break;
            case 'jms':
                throw new \RuntimeException("The JMS serializer has not yet been implemented");
            case 'symfony':
                $serializer = 'bernard.symfony_serializer';
                break;
            default:
                throw new \RuntimeException("Invalid serializer specified");
        }

        $container->setAlias('bernard.serializer', $serializer);
    }
}