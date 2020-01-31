<?php
namespace App\Tests\Repository;

use App\Entity\Income;
use App\Entity\State;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class IncomeRepositoryTest
 *
 * @package App\Tests\Repository
 */
class IncomeRepositoryTest extends KernelTestCase
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

    public function testTotalsByStateException()
    {
        $state = $this->entityManager
            ->getRepository(State::class)
            ->findOneBy(['name' => 'Moscow'])
        ;

        $this->expectException(\InvalidArgumentException::class);
        $this->entityManager
            ->getRepository(Income::class)
            ->totalsByState($state, 'COUNTING')
        ;
    }

    public function testTotalsByState()
    {
        $state = $this->entityManager
            ->getRepository(State::class)
            ->findOneBy(['name' => 'Moscow'])
        ;

        $totalsByState = $this->entityManager
            ->getRepository(Income::class)
            ->totalsByState($state, 'SUM')
        ;

        $this->assertEquals(2800, $totalsByState);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}