<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Vet;
use App\Entity\Owner;
use App\Entity\Animal;
use App\Entity\Visits;

use \Datetimeimmutable;

class InsertionController extends AbstractController
{
    #[Route('/insertion', name: 'app_insertion')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $vet = new Vet();
        $vet->setName('Tostowy');
        $vet->setLastname('Tost');

        // $owner = new Owner();
        // $owner->setName('Grzegorz');
        // $owner->setLastName('Sienkiewicz');

        // $animal = new Animal();
        // $animal->setName('Michal');
        // $animal->setSpecies('Piesek');
        // $animal->setAge(8);
        // $animal->setOwnerId($doctrine->getRepository(Owner::class)->find(4));
        // $animal->setVetId($doctrine->getRepository(Vet::class)->find(3));

        // $visit = new Visits();
        // $visit->setDate(new DateTimeImmutable('2022-12-12'));
        // $visit->setVetId($doctrine->getRepository(Vet::class)->find(1));
        // $visit->setAnimalId($doctrine->getRepository(Animal::class)->find(3));


        $entityManager->persist($vet);
        // $entityManager->persist($owner);
        // $entityManager->persist($animal);
        // $entityManager->persist($visit);

        $entityManager->flush();
        
        return new Response('Saved with id ' . $vet->getId());
    }
}
