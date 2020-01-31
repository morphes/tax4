<?php
namespace App\Tests\Repository;

use App\Entity\Country;
use App\Entity\County;
use App\Entity\State;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class CountyRepositoryTest
 *
 * @package App\Tests\Repository
 */
class CountyRepositoryTest extends KernelTestCase
{
    /**
     * @var
     */
    private $entityManager;

    protected function setUp()
    {
        $kernel = self::bootKernel();

        if($kernel->getEnvironment() == 'dev') {
            $this->markTestSkipped();
        }

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testFindOneBy()
    {
        $county = $this->entityManager
            ->getRepository(County::class)
            ->findOneBy(['name' => 'Vnukovo'])
        ;

        $this->assertNotNull($county);
    }

    public function testCountiesByStateDql()
    {
        $state = $this->entityManager
            ->getRepository(State::class)
            ->findOneBy(['name' => 'Moscow'])
        ;

        $subQuery = $this->entityManager
            ->getRepository(County::class)
            ->countiesByStateDql($state);
        ;

        $this->assertNotEmpty($subQuery);
        $this->assertContains((string)$state->getId(), $subQuery);
    }

    public function testAverageTaxPerState()
    {
        $state = $this->entityManager
            ->getRepository(State::class)
            ->findOneBy(['name' => 'Moscow'])
        ;

        $taxPerState = $this->entityManager
            ->getRepository(County::class)
            ->averageTaxPerState($state);
        ;

        $this->assertEquals('13.91', $taxPerState);
    }

    public function testAverageTaxPerCountry()
    {
        $country = $this->entityManager
            ->getRepository(Country::class)
            ->findOneBy(['name' => 'Russia'])
        ;

        $taxPerCountry = $this->entityManager
            ->getRepository(County::class)
            ->averageTaxPerCountry($country);
        ;

        $this->assertEquals('16.96', $taxPerCountry);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}