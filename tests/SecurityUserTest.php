<?php

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SecurityUserTest extends WebTestCase
{
    public function urlLoggedClientProvider() {
        yield ['/api/sessions/'];
        yield ['/session/'];
    }

    public function urlUnloggedClientProvider() {
        yield ['/login'];
        yield ['/register'];
    }

    /**
     * @dataProvider urlLoggedClientProvider
     */
    public function testDisabledUnloggedClient($url) {
        $client = self::createClient();
        $client->request('GET', $url);
        $this->assertNotSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    /**
     * @dataProvider urlUnloggedClientProvider
     */
    public function testEnabledUnloggedClient($url) {
        $client = self::createClient();
        $client->request('GET', $url);
        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}