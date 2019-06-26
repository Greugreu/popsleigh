<?php

namespace App\Controller;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class PropertyController extends AbstractController {

    /**
     * @Route("/covoit", name="property.index")
     * @return Response
     */

    public function index(): Response
    {
        return $this->render('property/index.html.twig', [
           'current_menu' => 'properties'
        ]);

    }


}
