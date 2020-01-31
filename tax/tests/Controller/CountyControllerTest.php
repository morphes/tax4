<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\County;

/**
 * Class CountyControllerTest
 *
 * @package App\Tests
 */
class CountyControllerTest extends WebTestCase
{
    public function testCounties()
    {
        $client = static::createClient();

        $counties = $client->getContainer()
            ->get('doctrine.orm.entity_manager')
            ->getRepository(County::class)
            ->findAll();

        foreach($counties as $county) {

            $client->request('GET', '/county/'. $county->getId());

            $this->assertEquals(200, $client->getResponse()->getStatusCode());
        }
    }
}