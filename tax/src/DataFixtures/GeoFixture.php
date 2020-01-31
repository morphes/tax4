<?php

namespace App\DataFixtures;

use App\Entity\Country;
use App\Entity\County;
use App\Entity\Income;
use App\Entity\State;
use App\Repository\CountyRepository;
use App\Service\DataSourceFactory;
use App\Service\RandomGeoSource;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class GeoFixture
 *
 * @package App\DataFixtures
 */
class GeoFixture extends Fixture
{
    const DATA_TYPE_SOURCES = [
        self::TYPE_SOURCE_API,
        self::TYPE_SOURCE_FILE,
        self::TYPE_SOURCE_RAND
    ];

    const TYPE_SOURCE_API = 'api';
    const TYPE_SOURCE_FILE = 'file';
    const TYPE_SOURCE_RAND = 'rand';

    /**
     * @var
     */
    private $manager;
    /**
     * @var CountyRepository
     */
    private $countyRepository;
    /**
     * @var KernelInterface
     */
    private $kernel;
    /**
     * @var ParameterBagInterface
     */
    private $parameterBag;
    /**
     * @var RandomGeoSource
     */
    private $randomGeoSource;

    /**
     * GeoFixture constructor.
     *
     * @param CountyRepository $countyRepository
     * @param KernelInterface $kernel
     * @param ParameterBagInterface $parameterBag
     */
    public function __construct(
        CountyRepository $countyRepository,
        KernelInterface $kernel,
        ParameterBagInterface $parameterBag,
        RandomGeoSource $randomGeoSource
    ) {
        $this->countyRepository = $countyRepository;
        $this->kernel           = $kernel;
        $this->parameterBag     = $parameterBag;
        $this->randomGeoSource  = $randomGeoSource;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $methodName    = 'load' . ucfirst($this->kernel->getEnvironment()) . 'Data';
        if (method_exists($this, $methodName)) {
            $this->$methodName();
        }
    }

    /**
     * @throws \Exception
     */
    private function loadDevData()
    {
        $randSourceType = rand(0, count(self::DATA_TYPE_SOURCES) - 1);

        $sourceType = self::DATA_TYPE_SOURCES[$randSourceType];
        $data = [];

        switch ($sourceType) {
            case self::TYPE_SOURCE_API:
                $dataSource = DataSourceFactory::create(self::TYPE_SOURCE_API);
                $jsonData   = $dataSource
                    ->setUrl($this->parameterBag->get('api_source_url'))
                    ->getData();
                $data       = json_decode($jsonData, true);
                break;

            case self::TYPE_SOURCE_FILE:
                $dataSource = DataSourceFactory::create(self::TYPE_SOURCE_FILE);
                $jsonData   = $dataSource
                    ->setPath($this->kernel->getProjectDir() . $this->parameterBag->get('file_source_path'))
                    ->getData();
                $data       = json_decode($jsonData, true);
                break;

            case self::TYPE_SOURCE_RAND:
                $data = $this->randomGeoSource->generateRandomData();
                break;
            default:
                break;
        }
        $this->loadDataToDB($data);
    }

    /**
     * @param array $data
     */
    private function loadDataToDb(array $data)
    {
        foreach (array_keys($data) as $countryName) {

            $country = new Country();
            $country->setName($countryName);
            $this->manager->persist($country);

            foreach (array_keys($data[$countryName]) as $sourceState) {

                $state = new State();
                $state->setName($sourceState);
                $state->setCountry($country);
                $this->manager->persist($state);

                foreach ($data[$countryName][$sourceState]['counties'] as $sourceCounty => $dataCounty) {

                    $county = new County();
                    $county->setName($sourceCounty);
                    $county->setState($state);
                    $county->setTaxRate($dataCounty['tax_rate']);
                    $this->manager->persist($county);
                    $this->manager->flush();

                    foreach ($dataCounty['rates'] as $incomeAmount) {

                        $income = new Income();
                        $income->setCounty($county);
                        $income->setAmount($incomeAmount);
                        $this->manager->persist($income);

                    }
                    $this->manager->flush();
                }
            }
        }
    }

    /**
     * Load data for testing purposes
     */
    private function loadTestData()
    {
        $testSources = RandomGeoSource::DEV_SOURCES;

        foreach (array_keys($testSources) as $countryName) {

            $country = new Country();
            $country->setName($countryName);
            $this->manager->persist($country);

            foreach (array_keys($testSources[$countryName]) as $sourceState) {

                $state = new State();
                $state->setName($sourceState);
                $state->setCountry($country);
                $this->manager->persist($state);

                foreach ($testSources[$countryName][$sourceState] as $sourceCounty => $sourceTaxRate) {

                    $county = new County();
                    $county->setName($sourceCounty);
                    $county->setState($state);
                    $county->setTaxRate($sourceTaxRate);
                    $this->manager->persist($county);

                }
            }
        }

        $this->manager->flush();

        $counties = $this->countyRepository->findAll();

        foreach ($counties as $county) {
            $stepIncome = 100;

            for ($count = 0; $count < 3; $count++) {

                $income = new Income();
                $income->setCounty($county);
                $stepIncome += $stepIncome;
                $income->setAmount($stepIncome);
                $this->manager->persist($income);

            }
        }

        $this->manager->flush();
    }
}
