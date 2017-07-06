<?php
/**
 * Created by PhpStorm.
 * User: west
 * Date: 7/6/2017
 * Time: 7:35 PM
 */

namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class SayHelloCommand extends Command
{
    //Method to Configure our Command
    public function configure()
    {
        $this->setName('sayHelloTo')
            ->setDescription('Offer Greeting To My App')
            ->addArgument('name',InputArgument::OPTIONAL,'Your Name')
            ->addOption('greeting',null,InputOption::VALUE_OPTIONAL,'Override Default','Hello') ;
    }

    /*
    Method to Execute input and output
    */
    public function execute(InputInterface $input,OutputInterface $output)
    {
//        $message = 'Hello , ' .$input->getArgument('name');
        $message = sprintf('%s , %s',$input->getOption('greeting'),$input->getArgument('name'));
        $output->writeln("<info>{$message}</info>");
    }
}