<?php 
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

    use App\Class\vet;
    use App\Class\animal;
    use App\Class\owner;
    use App\Class\logwizyt;

    class weterynarz extends AbstractController{

        public function displayVet(Request $request): Response{

            $vet = array(new vet("Agnieszka", "Kopacz"), new vet("Monika", "Kowalska"));

            $routeParameters = $request->attributes->get('_route_params');
            $num = $routeParameters['vetNum'];

            $vets = [];

            for($i = 0; $i < sizeof($vet); $i++){
                array_push($vets, $vet[$i]->listInfo());
            }

            return $this->render('displayVet.html.twig', [
                'vetName' => $vet[$num]->getName() . " " . $vet[$num]->getLastName(),
                'vets' => $vets,
            ]);
        }

        public function displayVetDetails(Request $request): Response{

            $vet = array(new vet("Agnieszka", "Kopacz"), new vet("Monika", "Kowalska"));
            $owner = array(new owner("Adrian", "Kowalczyk"), new owner("Michal", "Nowak"));
            $animal = array(new animal("Marcel", "Kotek", 17, 0), 
                            new animal("Blu", "Wieloryb", 10, 1), 
                            new animal("Łatka", "Piesek", 5, 1), 
                            new animal("Nje","Rekin", 12, 1));
            $logwizyt = array(new logwizyt("03/15/2022", 0, 0), 
                            new logwizyt("03/15/2022", 0, 1), 
                            new logwizyt("03/16/2022", 1, 0), 
                            new logwizyt("03/17/2022", 1, 1), 
                            new logwizyt("03/19/2022", 1, 1));
            $vet[0]->addAnimal(0);
            $vet[0]->addAnimal(1);
            $vet[1]->addAnimal(2);
            $vet[1]->addAnimal(3);


            $routeParameters = $request->attributes->get('_route_params');
            $vetNum = $routeParameters['vetNum'];

            $animals = [];

            for($i = 0; $i < sizeof($vet[$vetNum]->getAllAnimals()); $i++){
                $anInfo = $animal[$vet[$vetNum]->getSpecificAnimal($i)]->returnInfo();
                $anInfo['owner'] = $owner[$anInfo['owner']]->getName();

                array_push($animals, $anInfo);
            }

            $visits = [];

            for($i = 0; $i < sizeof($logwizyt); $i++){
                if($vetNum == $logwizyt[$i]->getVetId()){
                    array_push($visits, array('date' => $logwizyt[$i]->getDate(), 
                                            'vet' => $vet[$logwizyt[$i]->getVetId()]->getName(), 
                                            'animal' => $animal[$logwizyt[$i]->getAnimalId()]->getName()));
                }
            }


            return $this->render('displayVetDetails.html.twig', [
                'vetName' => $vet[$vetNum]->getName() . " " . $vet[$vetNum]->getLastName(),
                'animals' => $animals,
                'visits' => $visits
            ]);
        }

        public function displayOwner(Request $request): Response{

            $owner = array(new owner("Adrian", "Kowalczyk"), new owner("Michal", "Nowak"));

            $owners = [];

            for($i = 0; $i < sizeof($owner); $i++){
                array_push($owners, $owner[$i]->returnInfo());
            } 

            return $this->render('displayOwner.html.twig', [
                'owners' => $owners,
            ]);
        }

        public function displayOwnerDetails(Request $request): Response{

            $owner = array(new owner("Adrian", "Kowalczyk"), new owner("Michal", "Nowak"));
            $animal = array(new animal("Marcel", "Kotek", 17, 0), 
                            new animal("Blu", "Wieloryb", 10, 1), 
                            new animal("Łatka", "Piesek", 5, 1), 
                            new animal("Nje","Rekin", 12, 1));

            $animals = [];

            $routeParameters = $request->attributes->get('_route_params');
            $ownNum = $routeParameters['ownNum'];

            for($i = 0; $i < sizeof($animal); $i++){
                $anInfo = $animal[$i]->returnInfo();
                
                if($anInfo['owner'] == $ownNum){
                    $anInfo['id'] = $i;
                    array_push($animals, $anInfo);
                }
            }

            return $this->render('displayOwnerDetails.html.twig', [
                'owner' => $owner[$ownNum]->getName(),
                'animals' => $animals,
            ]);
        }

        public function displayAnimalDetails(Request $request): Response{

            $vet = array(new vet("Agnieszka", "Kopacz"), new vet("Monika", "Kowalska"));
            $owner = array(new owner("Adrian", "Kowalczyk"), new owner("Michal", "Nowak"));
            $animal = array(new animal("Marcel", "Kotek", 17, 0), 
                            new animal("Blu", "Wieloryb", 10, 1), 
                            new animal("Łatka", "Piesek", 5, 1), 
                            new animal("Nje","Rekin", 12, 1));
            $logwizyt = array(new logwizyt("03/15/2022", 0, 0), 
                            new logwizyt("03/15/2022", 0, 1), 
                            new logwizyt("03/16/2022", 1, 0), 
                            new logwizyt("03/17/2022", 1, 2), 
                            new logwizyt("03/19/2022", 1, 3));
            $vet[0]->addAnimal(0);
            $vet[0]->addAnimal(1);
            $vet[1]->addAnimal(2);
            $vet[1]->addAnimal(3);

            $routeParameters = $request->attributes->get('_route_params');
            $aniNum = $routeParameters['aniNum'];

            $visits = [];

            for($i = 0; $i < sizeof($logwizyt); $i++){
                if($aniNum == $logwizyt[$i]->getAnimalId()){
                    array_push($visits, array('date' => $logwizyt[$i]->getDate(), 
                                            'vet' => $vet[$logwizyt[$i]->getVetId()]->getName(), 
                                            'animal' => $animal[$logwizyt[$i]->getAnimalId()]->getName()));
                }
            }

            return $this->render('displayAnimalDetails.html.twig', [
                'animal' => $animal[$aniNum]->getName(),
                'visits' => $visits
            ]);
        }
    }
?>