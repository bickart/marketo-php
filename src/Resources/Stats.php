<?php

namespace Amaiza\Marketo\Resources;


/**
 * Class Stats
 * @package Amaiza\Marketo\Resources
 */
class Stats extends Base
{
    /**
     * Stats constructor.
     * @param \Amaiza\Marketo\Http\Client $client
     */
    public function __construct(\Amaiza\Marketo\Http\Client $client)
    {
        parent::__construct($client, 'stats');
    }

    /**
     * Retrieves a list of API users and a count of each error type they have encountered in the current day.
     *
     * @return \Amaiza\Marketo\Http\Response
     */
    function errors()
    {
        $endpoint = "/v1/{$this->class}/errors.json";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Returns a list of API users and a count of each error type they have encountered in the past 7 days.
     *
     * @return \Amaiza\Marketo\Http\Response
     */
    function errorsLastSevenDays()
    {
        $endpoint = "/v1/{$this->class}/errors/last7days.json";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Returns a list of API users and the number of calls they have consumed for the day.
     *
     * @return \Amaiza\Marketo\Http\Response
     */
    function usage()
    {
        $endpoint = "/v1/{$this->class}/usage.json";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Returns a list of API users and the number of calls they have consumed in the past 7 days.
     *
     * @return \Amaiza\Marketo\Http\Response
     */
    function usageLastSevenDays()
    {
        $endpoint = "/v1/{$this->class}/usage/last7days.json";

        return $this->client->request('get', $endpoint);
    }
}