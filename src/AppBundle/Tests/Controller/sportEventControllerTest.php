<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class sportEventControllerTest extends WebTestCase
{
    public function testCreateevent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/createEvent');
    }

    public function testEditevent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editEvent');
    }

    public function testJoinevent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/joinEvent');
    }

    public function testViewevent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/viewEvent');
    }

    public function testSearchevent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/searchEvent');
    }

    public function testListevents()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/listEvents');
    }

}
