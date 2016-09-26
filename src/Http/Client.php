<?php

namespace Amaiza\Marketo\Http;

use GuzzleHttp\Client as GuzzleClient;
use Amaiza\Marketo\Exceptions\BadRequest;
use Amaiza\Marketo\Exceptions\InvalidArgument;

class Client
{
    /** @var string */
    public $url;

    /** @var string */
    public $client_id;

    /** @var string */
    public $client_secret;

    /** @var \GuzzleHttp\Client */
    public $client;

    /** @var string */
    private $user_agent = "Amaiza_Marketo_PHP/1.0.0-rc.1 (https://github.com/bickart/marketo-php)";

    /**
     * Make it, baby.
     *
     * @param  array $config Configuration array
     * @param  GuzzleClient $client The Http Client (Defaults to Guzzle)
     * @throws \Amaiza\Marketo\Exceptions\InvalidArgument
     */
    function __construct($config = [], $client = null)
    {
        $this->url = isset($config["url"]) ? $config["url"] : getenv("MARKETO_ENDPOINT");
        if (empty($this->url)) {
            throw new InvalidArgument("You must provide a Marketo REST URL");
        }

        $this->client_id = isset($config["client_id"]) ? $config["client_id"] : getenv("MARKETO_CLIENT_ID");
        if (empty($this->client_id)) {
            throw new InvalidArgument("You must provide a Marketo REST Client ID");
        }

        $this->client_secret = isset($config["client_secret"]) ? $config["client_secret"] : getenv("MARKETO_CLIENT_SECRET");
        if (empty($this->client_secret)) {
            throw new InvalidArgument("You must provide a Marketo REST Client Secret");
        }

        $this->client = $client ?: new GuzzleClient();
    }

    /**
     * Send the request...
     *
     * @param  string $method The HTTP request verb
     * @param  string $endpoint The Marketo API endpoint
     * @param  array $options An array of options to send with the request
     * @param  string $query_string A query string to send with the request
     * @return \Amaiza\Marketo\Http\Response
     * @throws \Amaiza\Marketo\Exceptions\BadRequest
     */
    function request($method, $endpoint, $options = [], $query_string = null)
    {
        $url = $this->generateUrl($endpoint, $query_string);

        $token = $this->getToken();
        $options['headers']['User-Agent'] = $this->user_agent;
        $options['headers']['Accept-Encoding'] = 'gzip';

        $options['headers']['Authorization'] = "{$token->token_type} {$token->access_token}";

        try {
            return new Response($this->client->request($method, $url, $options));
        } catch (\Exception $e) {
            throw new BadRequest($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Generate the full endpoint url, including query string.
     *
     * @param  string $endpoint The HubSpot API endpoint.
     * @param  string $query_string The query string to send to the endpoint.
     * @return string
     */
    protected function generateUrl($endpoint, $query_string = null)
    {
//        $token = $this->getToken();
//        return "{$this->url}{$endpoint}?access_token=".$token->data->access_token.$query_string;

        return "{$this->url}{$endpoint}?{$query_string}";

    }

    protected function getToken()
    {

        $url = str_replace("/rest", "/identity", $this->url);
        $endpoint = "{$url}/oauth/token?grant_type=client_credentials&client_id={$this->client_id}&client_secret={$this->client_secret}";

        $options['headers']["User-Agent"] = $this->user_agent;

        try {
            return new Response($this->client->request('GET', $endpoint, $options));
        } catch (\Exception $e) {
            throw new BadRequest($e->getMessage(), $e->getCode(), $e);
        }

    }
}
