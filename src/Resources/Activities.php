<?php

namespace Amaiza\Marketo\Resources;


/**
 * Class Stats
 * @package Amaiza\Marketo\Resources
 */
class Activities extends Base
{
    /**
     * Stats constructor.
     * @param \Amaiza\Marketo\Http\Client $client
     */
    public function __construct(\Amaiza\Marketo\Http\Client $client)
    {
        parent::__construct($client, 'activities');
    }

    public function activities($params = [])
    {
        $endpoint = '/v1/activities.json';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);

    }

    public function deletedLeads()
    {
        $endpoint = '/v1/activities/deletedleads.json';
    }

    public function external()
    {
        $endpoint = '/v1/activities/external.json';
    }

    public function pagingToken($params = [])
    {
        $endpoint = '/v1/activities/pagingtoken.json';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    public function leadChanges($params = array())
    {
        $endpoint = '/v1/activities/leadchanges.json';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    public function types()
    {
        $endpoint = '/v1/activities/types.json';
    }
}