<?php

declare(strict_types=1);

namespace App\Users\Application\Console;

use App\Shared\Application\Bus\Command\CommandBusInterface;
use App\Users\Application\Commands\Create\CreateUser;
use App\Users\Application\Commands\Create\CreateUserDTO;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-user-cli',
    description: 'Creates a new user via CLI.',
    aliases: ['app:add-user-cli']
)]
class CreateUserConsole extends Command
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
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the user.')
            ->addArgument('email', InputArgument::REQUIRED, 'The email of the user.')
            ->addArgument('password', InputArgument::REQUIRED, 'The password of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $name = $input->getArgument('name');
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        $createUserDTO = new CreateUserDTO($name, $email, $password);
        $createUserCommand = new CreateUser($createUserDTO);

        // Usar CommandBus para manejar el comando
        $this->commandBus->handle($createUserCommand);

        $io->success('User successfully created via CLI!');
        $io->table(['Name', 'Email'], [[$name, $email]]);

        return Command::SUCCESS;
    }
}
