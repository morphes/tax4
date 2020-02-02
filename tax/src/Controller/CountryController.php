<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Repository\CountryRepository;
use App\Repository\CountyRepository;
use App\Repository\IncomeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CountryController
 *
 * @package App\Controller
 */
class CountryController extends AbstractController
{
    /**
     * @Route("/country/{id}", name="country")
     *
     * @param $id
     * @param CountryRepository $countryRepository
     * @param CountyRepository $countyRepository
     * @param IncomeRepository $incomeRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return mixed
     */
    public function index(
        $id,
        CountryRepository $countryRepository,
        CountyRepository $countyRepository,
        IncomeRepository $incomeRepository,
        PaginatorInterface $paginator,
        Request $request
    ) {
        $country = $countryRepository->find($id);

        if(!$country) {
            throw $this->createNotFoundException('The country does not exist');
        }

        $pagination = $paginator->paginate(
            $incomeRepository->findAll(),
            $request->query->getInt('page', 1)
        );

        return $this->render('country/index.html.twig', [
            'country' => $country,
            'states' => $country->getStates(),
            'avg_tax_rate' => $countyRepository->averageTaxPerCountry($country),
            'pagination' => $pagination
        ]);
    }
}
