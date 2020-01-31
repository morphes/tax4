<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Country;

/**
 * Class CountryControllerTest
 *
 * @package App\Tests
 */
class CountryControllerTest extends WebTestCase
{
    public function testCountries()
    {
        $client = static::createClient();

        $countries = $client->getContainer()
            ->get('doctrine.orm.entity_manager')
            ->getRepository(Country::class)
            ->findAll();

        foreach($countries as $country) {

            $client->request('GET', '/country/'. $country->getId());

            $this->assertEquals(200, $client->getResponse()->getStatusCode());
        }
    }
}