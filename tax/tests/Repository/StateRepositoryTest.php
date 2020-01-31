<?php
namespace App\Tests\Repository;

use App\Entity\Country;
use App\Entity\State;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class StateRepositoryTest
 *
 * @package App\Tests\Repository
 */
class StateRepositoryTest extends KernelTestCase
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

    public function testSearchByName()
    {
        $state = $this->entityManager
            ->getRepository(State::class)
            ->findOneBy(['name' => 'Moscow'])
        ;

        $this->assertNotNull($state);
    }

    public function testSubquery()
    {
        $country = $this->entityManager
            ->getRepository(Country::class)
            ->findOneBy(['name' => 'Russia'])
        ;

        $subQuery = $this->entityManager
            ->getRepository(State::class)
            ->statesByCountryDql($country);
        ;

        $this->assertNotEmpty($subQuery);
        $this->assertContains((string)$country->getId(), $subQuery);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}