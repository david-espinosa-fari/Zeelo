<?php

namespace App\Command;

use App\Item\Aplication\TableItemsCreator;
use App\Item\Domain\IItemsDetailsRepository;
use App\Item\Infrastructure\ItemDetailRepositoryMysql;
use App\Item\Infrastructure\ItemsRepositoryMysql;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateTableItemCommand extends Command
{
    protected static $defaultName = 'createTableItem';
    protected static $defaultDescription = 'Command to create the default table in the database ';

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addOption('create', null, InputOption::VALUE_NONE, 'Create the default table in the database')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if ($input->getOption('create')) {
            $itemDb = ItemsRepositoryMysql::getInstance();
            $ItemsDetails = ItemDetailRepositoryMysql::getInstance();
            $tableCreate = new TableItemsCreator($itemDb,$ItemsDetails);
            try {

                $tableCreate();
                $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

                return 0;
            } catch (\Exception $e) {
                $io->error($e->getMessage());
                return 1;
            }
        }
        $io->success('Table have not being created, do you forget create option?');
        return 0;

    }
}
