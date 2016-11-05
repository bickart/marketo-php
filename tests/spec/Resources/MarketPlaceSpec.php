<?php

namespace spec\Amaiza\Marketo\Resources;

use Amaiza\Marketo\Http\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MarketPlaceSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith('demo', $client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Amaiza\Marketo\Resources\MarketPlace');
    }
}
