<?php
declare(strict_types = 1);
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CountryRepository;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexController
 *
 * @package App\Controller
 */
class IndexController extends AbstractController
{
    /**
     * @Route("/", name="main_page")
     *
     * @param CountryRepository $countryRepository
     * @return mixed
     */
    public function index(
        CountryRepository $countryRepository)
    {
        return $this->render('root/index.html.twig', [
            'countries' => $countryRepository->findAll()
        ]);
    }
}
