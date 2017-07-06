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
use GuzzleHttp\ClientInterface;
use ZipArchive;



class NewCommand extends Command
{
    private $client;
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;

        parent::__construct();
    }
    //Method to Configure our Command
    public function configure()
    {
        $this->setName('new')
            ->setDescription('Create New Laravel Application')
            ->addArgument('name',InputArgument::OPTIONAL);
    }

    /*
    Method to Execute input and output
    */
    public function execute(InputInterface $input,OutputInterface $output)
    {
        //get Current Dir
        $directory = getcwd() . '/' . $input->getArgument('name');
        $this->assertApplicationDoesNotExist($directory,$output);

        $output->writeln('<info>Crafting Application...</info>');

        $this->download($zipFile = $this->makeFileName())
            ->extract($zipFile,$directory)
            ->cleanUp($zipFile);

        $output->writeln('<comment>Application is Ready</comment>');
    }

    private function assertApplicationDoesNotExist($directory,OutputInterface $output)
    {
        if (is_dir($directory)){
            $output->writeln('<error>Application already Exists!</error>');
            exit(1);
        }
    }

    private function makeFileName()
    {
        return getcwd() . '/laravel_' . md5(time().uniqid()) . '.zip';
    }


    private function download($zipFile)
    {
        $response = $this->client->get('http://cabinet.laravel.com/latest.zip')->getBody() ;
        file_put_contents($zipFile,$response);

        return $this;
    }


    private function extract($zipFile,$directory)
    {
        $archive = new ZipArchive;
        $archive->open($zipFile);
        $archive->extractTo($directory);
        $archive->close();

        return $this;
    }

    private function cleanUp($zipFile)
    {
        @chmod($zipFile,0777);
        @unlink($zipFile);

        return $this;
    }
}