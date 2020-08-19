<?php

namespace CalendlyApi\Tests;

use CalendlyApi\Exceptions\CalendlyApiClientException;
use PHPUnit\Framework\TestCase;
use CalendlyApi\HttpAdapters\CurlHttpClient;
use CalendlyApi\CalendlyApi;

class ClientTest extends TestCase
{

    public function testExclude() {
        $this->assertTrue(true);
    }

    /**
    * @group api-call
     * @throws CalendlyApiClientException
    */
   public function testClient() {
        if (!file_exists(__DIR__ . '/CalendlyApiTestCredentials.php')) {
            throw new CalendlyApiClientException(
            'You must create a CalendlyApiTestCredentials.php file from CalendlyApiTestCredentials.php.dist'
            );
        } else {
            require_once "CalendlyApiTestCredentials.php";
        }

        if (!strlen(CalendlyApiTestCredentials::$token)) {
            throw new CalendlyApiClientException(
            'You must fill out CalendlyApiTestCredentials.php'
            );
        }

        $client = new CalendlyApi(CalendlyApiTestCredentials::$token, new CurlHttpClient);

        $this->assertNotEmpty($client->echo()->getArray());

        //$this->assertNotEmpty($client->user()->me());

        $this->assertNotEmpty($client->user()->event_types());
   }
}