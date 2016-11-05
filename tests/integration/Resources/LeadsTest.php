<?php
/**
 * Created by PhpStorm.
 * User: bickart
 * Date: 9/22/16
 * Time: 1:45 PM
 */

namespace Amaiza\Marketo\Tests\Integration\Resources;


use Amaiza\Marketo\Http\Client;
use Amaiza\Marketo\Resources\Leads;

class LeadsTest extends \PHPUnit_Framework_TestCase
{
    /* @var Leads */
    var $lead;

    public function testDescribe()
    {
        $response = $this->lead->describe();
        $this->assertEquals(200, $response->getStatusCode());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->lead = new Leads(new Client([
            'url' => 'https://271-FSL-691.mktorest.com/rest',
            'client_id' => '0efb9f65-39f1-45d9-ac6d-4d84f0c1087f',
            'client_secret' => 'jqK4SjqnTl4W6sjg8uO5ZukoH5QIuQiT'
        ]));
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
