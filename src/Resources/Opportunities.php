<?php
/**
 * Created by PhpStorm.
 * User: bickart
 * Date: 9/22/16
 * Time: 2:25 PM
 */

namespace Amaiza\Marketo\Resources;


class Opportunities extends LeadDatabase
{

    public function __construct(\Amaiza\Marketo\Http\Client $client)
    {
        parent::__construct($client, 'opportunities');
    }
}