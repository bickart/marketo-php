<?php
/**
 * Created by PhpStorm.
 * User: bickart
 * Date: 9/26/16
 * Time: 11:48 AM
 */

namespace Amaiza\Marketo\Tests\Integration\Resources;


use Amaiza\Marketo\Http\Client;
use Amaiza\Marketo\Resources\Stats;

class StatsTest extends \PHPUnit_Framework_TestCase
{

    /* @var Stats */
    var $stats;

    protected function setUp()
    {
        parent::setUp();

        $this->stats = new Stats(new Client([
            'url' => 'https://271-FSL-691.mktorest.com/rest',
            'client_id' => '0efb9f65-39f1-45d9-ac6d-4d84f0c1087f',
            'client_secret' => 'jqK4SjqnTl4W6sjg8uO5ZukoH5QIuQiT'
        ]));
    }

    public function testUsage()
    {
        $response = $this->stats->usage();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUsageLastSevenDays()
    {
        $response = $this->stats->usageLastSevenDays();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testErrors()
    {
        $response = $this->stats->errors();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testErrorsLastSevenDays()
    {
        $response = $this->stats->errorsLastSevenDays();
        $this->assertEquals(200, $response->getStatusCode());
    }

}
