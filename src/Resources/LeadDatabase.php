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

}