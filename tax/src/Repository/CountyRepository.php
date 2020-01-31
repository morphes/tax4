<?php

namespace App\Repository;

use App\Entity\Country;
use App\Entity\County;
use App\Entity\State;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method County|null find($id, $lockMode = null, $lockVersion = null)
 * @method County|null findOneBy(array $criteria, array $orderBy = null)
 * @method County[]    findAll()
 * @method County[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountyRepository extends ServiceEntityRepository
{
    /**
     * @var CountryRepository
     */
    private $countryRepository;
    /**
     * @var StateRepository
     */
    private $stateRepository;

    /**
     * CountyRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(
        ManagerRegistry $registry,
        CountryRepository $countryRepository,
        StateRepository $stateRepository
    ) {
        parent::__construct($registry, County::class);
        $this->countryRepository = $countryRepository;
        $this->stateRepository = $stateRepository;
    }

    /**
     * @param State $state
     * @return string
     */
    public function countiesByStateDql(State $state)
    {
        return $this->createQueryBuilder('c')
            ->select('c.id')
            ->where('c.state = ' . $state->getId())
            ->getDQL();
    }

    /**
     * @param State $state
     * @return mixed
     */
    public function averageTaxPerState(State $state)
    {
        return $this->createQueryBuilder('c')->select('AVG(c.tax_rate)')
            ->where(
                'c.state = :state_id'
            )
            ->setParameter('state_id', $state->getId())
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @param Country $country
     * @return mixed
     */
    public function averageTaxPerCountry(Country $country)
    {
        $query = $this->createQueryBuilder('c');
        return $query->select('AVG(c.tax_rate)')
            ->where(
                $query->expr()->in('c.state', $this->stateRepository->statesByCountryDql($country))
            )
            ->getQuery()
            ->getSingleScalarResult();
    }
}
