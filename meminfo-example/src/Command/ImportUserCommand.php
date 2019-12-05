<?php

namespace App\Command;

use App\Service\UserManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ImportUserCommand extends Command
{
    protected static $defaultName = 'app:import-users';

    /**
     * @var UserManager
     */
    private $userManager;

    /** 
     * @var ParameterBagInterface
     */
    private $params;

    public function __construct(UserManager $userManager, ParameterBagInterface $params)
    {
        $this->userManager = $userManager;
        $this->params = $params;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Importa os usuários do CSV.')
            ->setHelp('Este comando importa os usuários definidos no arquivo `import.csv` localizado na raíz do projeto')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Importação de usuários',
            '============',
            '',
        ]);

        $csvPath = $this->params->get('csv_path');
        $csvContents = file($csvPath);

        if (!$csvContents) {
            $output->writeln([
                'Arquivo', $csvPath, ' inválido'
            ]);
        }

        $users = array_map('str_getcsv', $csvContents);

        $this->userManager->importUsers($users, 50000);

        $output->writeln([
            '============',
            'Importação concluída com sucesso!',
            '',
        ]);

        return 0;
    }
}
