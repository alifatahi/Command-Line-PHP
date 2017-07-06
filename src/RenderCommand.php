<?php
/**
 * Created by PhpStorm.
 * User: west
 * Date: 7/6/2017
 * Time: 10:04 PM
 */

namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RenderCommand extends Command
{
    public function configure()
    {
        $this->setName('render')
            ->setDescription('Render Some Table');
    }

    public function execute(InputInterface $input,OutputInterface $output)
    {
        $table = new Table($output);

        $table->setHeaders(['name','age'])
            ->setRows([
               ['Ali Fatahi',25],
               ['Peyman Sade',23],
               ['Zohi',24],
            ])
        ->render();
    }
}