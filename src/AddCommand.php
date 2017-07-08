<?php

namespace Acme;

//use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;

class AddCommand extends Command{
    public function configure()
    {
        $this->setName('add')
            ->setDescription('Add New Task')
            ->addArgument('description',InputArgument::REQUIRED);

    }

    public function execute(InputInterface $input,OutputInterface $output)
    {
        $description = $input->getArgument('description');
        $this->database->query(
            'INSERT INTO tasks(description) VALUES(:description)',
            compact('description')
        );

        $output->writeln('<info>Task Added</info>');

        $this->showTasks($output);
    }
    
    
}