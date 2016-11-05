<?php

namespace Amaiza\Marketo;

use Amaiza\Marketo\Http\Client;


/**
 * Class Factory
 * @package Amaiza\Marketo
 *
 * @method \Amaiza\Marketo\Resources\Companies companies()
 * @method \Amaiza\Marketo\Resources\Leads leads()
 * @method \Amaiza\Marketo\Resources\Opportunities opportunities()
 * @method \Amaiza\Marketo\Resources\OpportunityRoles opportunityroles()
 * @method \Amaiza\Marketo\Resources\SalesPersons salespersons()
 * @method \Amaiza\Marketo\Resources\Stats stats()
 * @method \Amaiza\Marketo\Resources\Activities activities()
 */
class Factory
{
    /**
     * C O N S T R U C T O R ( ^_^)y
     *
     * @param  array $config An array of configurations. You need at least the 'key'.
     * @param  Client $client
     */
    function __construct($config = [], $client = null)
    {
        $this->client = $client ?: new Client($config);
    }

    /**
     * Create an instance of the service with an URL and Token key.
     *
     * @param  string $url Marketo Endpoint URL.
     * @param  string $token Marketo API Token.
     * @param  Client $client An Http client.
     * @return static
     */
    static function create($url = null, $client_id = null, $client_secret = null, $client = null)
    {
        return new static(['url' => $url, 'client_id' => $client_id, 'client_secret' => $client_secret], $client);
    }

    /**
     * Create an instance of the service with an Oauth token.
     *
     * @param  string $token Marketo oauth access token.
     * @param  Client $client An Http client.
     * @return static
     */
    static function createWithToken($token, $client = null)
    {
        return new static(['key' => $token, 'oauth' => true], $client);
    }

    /**
     * Return an instance of a Resource based on the method called.
     *
     * @param  string $name
     * @param  array $arguments
     * @return \Amaiza\Marketo\Resources\Resource
     */
    function __call($name, $arguments = null)
    {
        $resource = 'Amaiza\\Marketo\\Resources\\' . ucfirst($name);

        return new $resource($this->client);
    }
}
