<?php

use App\Service\DataSourceFactory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class DataSourceFactoryTest
 */
class DataSourceFactoryTest extends WebTestCase
{
    public function testApiManager()
    {
        $apiManager = DataSourceFactory::create('api');

        self::bootKernel();

        $data = $apiManager
            ->setUrl(self::$container->getParameter('api_source_url'))
            ->getData();

        $this->assertNotEmpty($data);
    }

    public function testFileManager()
    {
        $kernel     = self::bootKernel();

        $filePath   = $kernel->getProjectDir() . self::$container->getParameter('file_source_path');

        $this->assertFileExists($filePath);

        $fileManager = DataSourceFactory::create('file');

        $data = $fileManager
            ->setPath($filePath)
            ->getData();

        $this->assertNotEmpty($data);
    }
}