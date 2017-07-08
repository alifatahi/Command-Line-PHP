<?php

namespace Acme;

//use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;

class CompleteCommand extends Command{
    public function configure()
    {
        $this->setName('complete')
            ->setDescription('Complete Task By ID')
            ->addArgument('id',InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input,OutputInterface $output)
    {
        $id = $input->getArgument('id');

        $this->database->query('delete from tasks where id = :id',compact('id'));

        $output->writeln('<info>Task Complete</info>');

        $this->showTasks($output);
    }


}