<?php

declare(strict_types=1);

namespace App\Products\Application\Console;

use App\Shared\Application\Bus\Command\CommandBusInterface;
use App\Products\Application\Commands\Create\CreateProduct;
use App\Products\Application\Commands\Create\CreateProductDTO;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-product-cli',
    description: 'Creates a new product via CLI.',
    aliases: ['app:add-product-cli']
)]
class CreateProductConsole extends Command
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the product.')
            ->addArgument('price', InputArgument::REQUIRED, 'The price of the product.')
            ->addArgument('description', InputArgument::OPTIONAL, 'The description of the product.')
            ->addArgument('date_add', InputArgument::OPTIONAL, 'The date the product was added.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $name = $input->getArgument('name');
        $price = (float) $input->getArgument('price');
        $description = $input->getArgument('description') ?? '';
        $dateAdd = $input->getArgument('date_add') ? new \DateTimeImmutable($input->getArgument('date_add')) : null;

        $createProductDTO = new CreateProductDTO($name, $price, $description, $dateAdd);
        $createProductCommand = new CreateProduct($createProductDTO);

        $product = $this->commandBus->handle($createProductCommand);

        $io->success('Product created successfully: ' . $name);
        $io->table(['Name', 'Price', 'Description'], [[ $name, $price, $description ]]);

        return Command::SUCCESS;
    }
}
