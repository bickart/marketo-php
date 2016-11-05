<?php

namespace Amaiza\Marketo\Resources;

abstract class LeadDatabase extends Base
{

    /**
     * @return \Amaiza\Marketo\Http\Response
     */
    function describe()
    {
        $endpoint = "/v1/{$this->class}/describe.json";

        return $this->client->request('get', $endpoint);
    }


    /**
     * Returns a list of up to 300 records based on a list of values in a particular field
     *
     * @param $filterType
     * @param array $filterValues
     * @param array $fields
     * @param int $batchSize
     * @param string $nextPageToken
     *
     * @return \Amaiza\Marketo\Http\Response
     */
    public function getByFilterType($filterType, array $filterValues, array $fields = null, $batchSize = 300, $nextPageToken = '')
    {
        $endpoint = "/v1/{$this->class}.json";

        $params = array(
            'filterType' => $filterType,
            'filterValues' => $filterValues,
            'fields' => $fields,
            'batchSize' => $batchSize,
            'nextPageToken' => $nextPageToken
        );

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

}