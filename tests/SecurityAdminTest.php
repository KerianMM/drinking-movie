<?php

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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
        $this->assertTrue($client->getResponse()->isSuccessful());
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
        $this->assertFalse($client->getResponse()->isSuccessful());
    }

    public function urlAdminProvider() {
        yield ['/admin/movie/'];
        yield ['/admin/session/'];
    }
}