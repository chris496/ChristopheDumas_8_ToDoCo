<?php

namespace App\Command;

use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'user-anonyme',
    description: 'Add a short description for your command',
)]
class UserAnonymeCommand extends Command
{
    private $taskRepository;
    private $userRepository;

    public function __construct(TaskRepository $taskRepository, UserRepository $userRepository, EntityManagerInterface $em)
    {
        parent::__construct(null);
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $user = $this->userRepository->findBy(array('username' => 'anonyme'));
        $user= $user[0];
        $test = $this->taskRepository->findAll();
        foreach ($test as $t) {
            if($t->getUser() == null) {
                $t->setUser($user);
                $this->em->persist($t);
                $this->em->flush();   
            }
        }
        return Command::SUCCESS;
    }
}
