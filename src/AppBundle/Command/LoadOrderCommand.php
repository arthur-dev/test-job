<?php

namespace AppBundle\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Created by PhpStorm.
 * User: arthur
 * Date: 10/10/16
 * Time: 12:48
 */
class LoadOrderCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('import:order')
            ->setDescription('import orders form xml files')
            ->addArgument(
                'filePath',
                InputArgument::OPTIONAL,
                'file path'
            )
            ->addArgument(
                'offer',
                InputArgument::OPTIONAL,
                'offer')

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filepath = $input->getArgument('filePath');
        $offer = $input->getArgument('offer');

        try{
            $data = file_get_contents($filepath);
        }
        catch(\Exception $e)
        {
            throw new \Exception('bad path to file');
        }

        $this->getContainer()->get('app_importData_service')->import($data,$offer);



            $output->writeln('import success');
    }
}