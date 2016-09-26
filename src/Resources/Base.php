<?php

namespace Amaiza\Marketo\Resources;

abstract class Base
{
    /**
     * @var \Amaiza\Marketo\Http\Client
     */
    protected $client;

    /* @var string */
    protected $class;

    /**
     * Makin' a good ole resource
     *
     * @param \Amaiza\Marketo\Http\Client $client
     * @param string $class
     */
    function __construct($client, $class)
    {
        $this->client = $client;
        $this->class = $class;
    }
}