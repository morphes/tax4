<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class AddUserCommandTest
 */
class AddUserCommandTest extends WebTestCase
{
    public function testGenerateRandomData()
    {
        self::bootKernel();

        $randomGeoSource = self::$container->get('App\Service\RandomGeoSource');
        $this->assertNotEmpty($randomGeoSource->generateRandomData());

        $randomGeoSourceReflection = new ReflectionClass($randomGeoSource);
        $constants = $randomGeoSourceReflection->getConstants();
        $this->assertArrayHasKey('DEV_SOURCES', $constants);
        $this->assertArrayHasKey('SOURCES', $constants);
        $this->assertNotEmpty($constants['DEV_SOURCES']);
        $this->assertNotEmpty($constants['SOURCES']);
    }
}