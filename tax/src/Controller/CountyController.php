<?php

namespace App\Controller;

use App\Repository\CountyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CountyController
 *
 * @package App\Controller
 */
class CountyController extends AbstractController
{
    /**
     * @Route("/county/{id}", name="county")
     *
     * @param $id
     * @param CountyRepository $countyRepository
     * @return mixed
     */
    public function index($id, CountyRepository $countyRepository)
    {
        return $this->render('county/index.html.twig', [
            'county' => $countyRepository->find($id)
        ]);
    }
}
