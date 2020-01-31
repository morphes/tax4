<?php
namespace App\Tests\Repository;

use App\Entity\Country;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class CountryRepositoryTest
 *
 * @package App\Tests\Repository
 */
class CountryRepositoryTest extends KernelTestCase
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
        $country = $this->entityManager
            ->getRepository(Country::class)
            ->findOneBy(['name' => 'Russia'])
        ;

        $this->assertNotNull($country);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}