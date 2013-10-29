<?php

namespace Bernard\BernardBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Bernard\Message;
use Bernard\Message\DefaultMessage;

/**
 * Inspired from https://github.com/stanlemon/bernard-app
 */
class ProduceCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('bernard:produce')
            ->setDescription('Bernard queue producer')
            ->addArgument('name', InputArgument::REQUIRED, 'Name for the message eg. "ImportUsers".')
            ->addArgument('message', InputArgument::OPTIONAL, 'JSON encoded string that is used for message properties.')
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $message = json_decode($input->getArgument('message'), true) ?: array();

        if (json_last_error()) {
            throw new \RuntimeException('Could not decode invalid JSON [' . json_last_error() . ']');
        }

        $producer = $this->getContainer()->get('bernard.producer');

        $producer->produce(new DefaultMessage($name, $message));
    }
}