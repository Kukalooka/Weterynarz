<?php 
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Doctrine\Persistence\ManagerRegistry;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

    use App\Entity\Vet;
    use App\Entity\Owner;
    use App\Entity\Animal;
    use App\Entity\Visits;

    use App\Repository\VetRepository;
    use App\Repository\OwnerRepository;
    use App\Repository\AnimalRepository;
    use App\Repository\VisitsRepository;

    use \Datetimeimmutable;
    use \Datetime;

    class weterynarz extends AbstractController{

        public function displayVet(ManagerRegistry $doctrine, Request $request): Response{
            $repository = $doctrine->getRepository(Vet::class);
            
            $vets = $repository->findAll();

            $vetInfo = [];

            for($i = 0; $i < sizeof($vets); $i++){
                $vet = ['name' => $vets[$i]->getName(), 'lastName' => $vets[$i]->getLastname()];

                array_push($vetInfo, $vet);
            }

            return $this->render('displayVet.html.twig', [
                'vets' => $vetInfo,
            ]);
        }

        public function displayVetDetails(ManagerRegistry $doctrine, Request $request): Response{
            $routeParameters = $request->attributes->get('_route_params');
            $vetNum = $routeParameters['vetNum'];

            $repository = $doctrine->getRepository(Vet::class);

            $vet = $repository->find($vetNum);
            $animals = $vet->getAnimals();
            $visits = $vet->getVisits();

            $animalList = [];


            for($i = 0; $i < sizeof($animals); $i++){
                $animal = ['name' => $animals[$i]->getName(), 
                            'species' => $animals[$i]->getSpecies(), 
                            'age' => $animals[$i]->getAge(),
                            'owner' => $animals[$i]->getOwnerId()->getName()];

                array_push($animalList, $animal);
            }

            $visitList = [];

            for($i = 0; $i < sizeof($visits); $i++){
                $visit = ['date' => $visits[$i]->getDate()->format('y-m-d'),
                            'vet' => $visits[$i]->getVetId()->getName(),
                            'animal' => $visits[$i]->getAnimalId()->getName(),];

                array_push($visitList, $visit);
            }


            return $this->render('displayVetDetails.html.twig', [
                'vetName' => $vet->getName() . " " . $vet->getLastName(),
                'animals' => $animalList,
                'visits' => $visitList
            ]);
        }

        public function displayOwner(ManagerRegistry $doctrine, Request $request): Response{
            $repository = $doctrine->getRepository(Owner::class);
            
            $owners = $repository->findAll();

            $ownerList = [];

            for($i = 0; $i < sizeof($owners); $i++){
                $owner = ['name' => $owners[$i]->getName(),
                            'lastName' => $owners[$i]->getLastname()];
                array_push($ownerList, $owner);
            } 

            return $this->render('displayOwner.html.twig', [
                'owners' => $ownerList,
            ]);
        }

        public function displayOwnerDetails(ManagerRegistry $doctrine, Request $request): Response{
            $routeParameters = $request->attributes->get('_route_params');
            $ownNum = $routeParameters['ownNum'];

            $repository = $doctrine->getRepository(Owner::class);

            $owner = $repository->find($ownNum);
            $animals = $owner->getAnimals();

            $animalList = [];

            for($i = 0; $i < sizeof($animals); $i++){
                $animal = ['name' => $animals[$i]->getName(), 
                            'species' => $animals[$i]->getSpecies(), 
                            'age' => $animals[$i]->getAge(),
                            'owner' => $owner->getName(),
                            'id' => $animals[$i]->getId()];

                array_push($animalList, $animal);
            }

            return $this->render('displayOwnerDetails.html.twig', [
                'owner' => $owner->getName(),
                'animals' => $animalList,
            ]);
        }

        public function displayAnimalDetails(ManagerRegistry $doctrine, Request $request): Response{
            $routeParameters = $request->attributes->get('_route_params');
            $aniNum = $routeParameters['aniNum'];

            $repository = $doctrine->getRepository(Animal::class);

            $animal = $repository->find($aniNum);
            $visits = $animal->getVisits();

            $visitList = [];

            for($i = 0; $i < sizeof($visits); $i++){
                $visit = ['date' => $visits[$i]->getDate()->format('y-m-d'),
                            'vet' => $visits[$i]->getVetId()->getName(),
                            'animal' => $visits[$i]->getAnimalId()->getName(),];

                array_push($visitList, $visit);
            }

            return $this->render('displayAnimalDetails.html.twig', [
                'animal' => $animal->getName(),
                'species' => $animal->getSpecies(),
                'age' => $animal->getAge(),
                'visits' => $visitList
            ]);
        }
    }
?>