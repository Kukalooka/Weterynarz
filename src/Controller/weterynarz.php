<?php 
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Doctrine\Persistence\ManagerRegistry;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Doctrine\DBAL\Connection;
    use Doctrine\DBAL\Statement;
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
    use App\Repository\view;

    use \Datetimeimmutable;
    use \Datetime;

    class weterynarz extends AbstractController{

        public function list(ManagerRegistry $doctrine, Request $request, SerializerInterface $serializer): Response{
            return $this->render('displayVet.html.twig', [
                'vets' => $doctrine->getRepository(Vet::class)->findAll(),
            ]);
        }

        public function details(ManagerRegistry $doctrine, Request $request, SerializerInterface $serializer): Response{
            if($doctrine->getRepository(Vet::class)->find($request->attributes->get('_route_params')['num'])){
                return $this->render('displayVetDetails.html.twig', [
                    'vetName' => $doctrine->getRepository(Vet::class)->find($request->attributes->get('_route_params')['num']),
                    'animals' => $serializer->normalize(
                        $doctrine->getRepository(Vet::class)->find($request->attributes->get('_route_params')['num'])->getAnimals(), 
                        'json', ['groups' => ['animal', 'ownerPlug', 'owner']]),
                    'visits' => $serializer->normalize(
                        $doctrine->getRepository(Vet::class)->find($request->attributes->get('_route_params')['num'])->getVisits(), 
                        'json', ['groups' => ['visits', 'vet', 'animal']])
                ]);
            }
            else{
                return $this->render('displayError.html.twig', [
                    'message' => "A vet with this ID does not exist",
                ]);
            }
        }

        public function summary(ManagerRegistry $doctrine, Request $request, Connection $connection): Response{   
            return $this->render('displaySummary.html.twig', [
                'views' => $connection->fetchAllAssociative('SELECT * FROM summary2022')
            ]);
        }  
    }
?>