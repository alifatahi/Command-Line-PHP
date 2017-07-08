<?php
/**
 * Created by PhpStorm.
 * User: west
 * Date: 7/8/2017
 * Time: 12:20 PM
 */

namespace Acme;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;

class command extends SymfonyCommand
{
    protected $database;

    //Make Connection to DB
    public function __construct(DatabaseAdapter $database)
    {
        $this->database = $database;
        //we call parent construct which is database
        parent::__construct();
    }

    //Method to Show Tasks
    protected function showTasks(OutputInterface $output)
    {
        //so with connection we made we fetch all tasks from tasks table
        if (!$tasks = $this->database->fetchAll('tasks')){
            return $output->writeln('<info>No Tasks</info>');
        }
        $table = new Table($output);
        //Table Header of table
        $table->setHeaders(['id','Description'])
            //set Row
            ->setRows($tasks)
            //and Finally Render(present)
            ->render();
    }

}