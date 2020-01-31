<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\State;

/**
 * Class StateControllerTest
 *
 * @package App\Tests
 */
class StateControllerTest extends WebTestCase
{
    public function testStates()
    {
        $client = static::createClient();

        $states = $client->getContainer()
            ->get('doctrine.orm.entity_manager')
            ->getRepository(State::class)
            ->findAll();

        foreach($states as $state) {

            $client->request('GET', '/state/'. $state->getId());

            $this->assertEquals(200, $client->getResponse()->getStatusCode());
        }
    }
}