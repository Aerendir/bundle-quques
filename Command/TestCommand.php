<?php

namespace SerendipityHQ\Bundle\CommandsQueuesBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SynchOrdersCommand.
 */
class TestCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('queues:test')
            ->setDescription('[INTERNAL] A Job to test the behaviors of SHQCommandsQueuesBundle. Returns randomly exceptions, and false or true results.')
            ->setDefinition(
                new InputDefinition([
                    new InputOption('id', 'id', InputOption::VALUE_REQUIRED),
                    new InputOption('trigger-error', 'te', InputOption::VALUE_OPTIONAL),
                ])
            );
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return bool
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $triggerError = null === $input->getOption('trigger-error') ? rand(0, 10) : 1;
        $duration = rand(10, 10000);
        // Ok, all gone well (fingers crossed? :P )
        $output->writeln([
            'Hello!',
            'I\'m TestQueue #'.$input->getOption('id').', a command to test the Queue Daemon.',
            'During my execution I will trigger some random conditions to show you how Queue Daemon will',
            'manage them.',
            '',
            'The total duration of this script will be of about "'.$duration.'" seconds.',
        ]);

        // If the rand doesn't return a number divisible by two (is just a random condition)
        if ($triggerError % 2 !== 0) {
            // ... Randomly throw an exception
            throw new \RuntimeException('I\'ve just decided to throw a nice exception! Ah ah ah ah!');
        }

        // If the rand doesn't return a number divisible by two (is just a random condition)
        if (rand(0, 10) % 2 !== 0) {
            $output->writeln('Mmm, I think I will randomly return false!');
            // ... Randomly return false
            return false;
        }

        // Emulate a duration to execute the command
        $rand = rand(0, 10);
        $output->writeln(sprintf('I\'m so tired... I will sleep for %s seconds... Good bye, see you soon! :)', $rand));
        sleep($rand);

        // Ok, all gone well (fingers crossed? :P )
        $output->writeln('Hello! I just woke up! :) ... Finito.');

        return true;
    }
}
