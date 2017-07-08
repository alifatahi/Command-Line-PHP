<?php

namespace Acme;

//use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;

class ShowCommand extends Command{

    //Configure Method for set Command
    public function configure()
    {
        $this->setName('show')
            ->setDescription('Show All Tasks');
    }

    //Execute Method for run command
    public function execute(InputInterface $input,OutputInterface $output)
    {
        $this->showTasks($output);
    }


}