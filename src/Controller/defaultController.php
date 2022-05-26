<?php 
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


    class defaultController extends AbstractController{

        public function displaySelection(Request $request): Response{

            return $this->render('displaySelection.html.twig');
        }
    }
?>