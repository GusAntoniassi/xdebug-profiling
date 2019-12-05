<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;   
    }

    public function importUsers($usuarios, $iteracoes)
    {
        for ($i = 0; $i < $iteracoes; $i++) { 
            $usuarioCsv = $usuarios[$i % 3];

            $usuario = new User();
            $usuario->setLogin($usuarioCsv[0]);
            $usuario->setEmail($usuarioCsv[1]);
            $usuario->setFullName($usuarioCsv[2]);

            $this->entityManager->persist($usuario);

            if ($i % 1000 === 0) {
                echo $i . " usuários importados\n";
                $this->entityManager->flush();
                // $this->entityManager->clear(User::class);

                // $fd = fopen(__DIR__ . "/../../var/meminfo-dump-$i.json", 'w');
                // meminfo_dump($fd);
                // fclose($fd);
            }

            // usleep(100); // Descomente caso o uso de CPU ficar muito alto
        }

        $this->entityManager->flush();
        echo $i . " usuários importados\n";
    }
}
