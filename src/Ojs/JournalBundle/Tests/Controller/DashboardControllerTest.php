<?php

namespace Ojs\JournalBundle\Tests\Controller;

use Ojs\CoreBundle\Tests\BaseTestSetup as BaseTestCase;

class DashboardControllerTest extends BaseTestCase
{

    public function testIndex()
    {
        $this->logIn();
        $client = $this->client;
        $client->request('GET', '/journal/1/dashboard');

        $this->assertStatusCode(200, $client);
    }

}