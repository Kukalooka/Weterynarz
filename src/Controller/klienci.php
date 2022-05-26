<?php 
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Doctrine\Persistence\ManagerRegistry;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

    use Symfony\Component\Serializer\Encoder\JsonEncoder;
    use Symfony\Component\Serializer\Encoder\XmlEncoder;
    use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
    use Symfony\Component\Serializer\Serializer;
    use Symfony\Component\Serializer\SerializerInterface;

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

    class klienci extends AbstractController{

        public function list(ManagerRegistry $doctrine, Request $request, SerializerInterface $serializer): Response{
            return $this->render('displayOwner.html.twig', [
                'owners' => $doctrine->getRepository(Owner::class)->findAll(),
            ]);
        }

        public function details(ManagerRegistry $doctrine, Request $request, SerializerInterface $serializer): Response{
            if($doctrine->getRepository(Owner::class)->find($request->attributes->get('_route_params')['num'])){
                return $this->render('displayOwnerDetails.html.twig', [
                    'owner' => $doctrine->getRepository(Owner::class)->find($request->attributes->get('_route_params')['num'])->getName(),
                    'animals' => $serializer->normalize(
                        $doctrine->getRepository(Owner::class)->find($request->attributes->get('_route_params')['num'])->getAnimals(), 
                        'json', ['groups' => ['animal']]),
                ]);
            }
            else{
                return $this->render('displayError.html.twig', [
                    'message' => "An owner with this ID does not exist",
                ]);
            }
        }

        public function animal(ManagerRegistry $doctrine, Request $request, SerializerInterface $serializer): Response{
            if($doctrine->getRepository(Animal::class)->find($request->attributes->get('_route_params')['num'])){
                return $this->render('displayAnimalDetails.html.twig', [
                    'animal' => $serializer->normalize(
                        $doctrine->getRepository(Animal::class)->find($request->attributes->get('_route_params')['num']), 
                        'json', ['groups' => ['animal']]),
                    'visits' => $serializer->normalize(
                        $doctrine->getRepository(Animal::class)->find($request->attributes->get('_route_params')['num'])->getVisits(), 
                        'json', ['groups' => ['visits', 'vet', 'animal']])
                ]); 
            }
            else{
                return $this->render('displayError.html.twig', [
                    'message' => "An animal with this ID does not exist",
                ]);
            }
        }
    }
?>