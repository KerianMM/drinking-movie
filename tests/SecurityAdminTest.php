<?php

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SecurityAdminTest extends WebTestCase {
    /**
     * @dataProvider urlAdminProvider
     */
    public function testEnabledClient($url) {
        $client = self::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'admin',
        ]);
        $client->request('GET', $url);
        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    /**
     * @dataProvider urlAdminProvider
     */
    public function testDisabledClient($url) {
        $client = self::createClient([], [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'fjksdhflksdhfql',
        ]);
        $client->request('GET', $url);
        $this->assertNotSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function urlAdminProvider() {
        yield ['/admin/movie/'];
        yield ['/admin/session/'];
    }
}