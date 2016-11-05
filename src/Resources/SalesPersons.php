<?php
/**
 * Created by PhpStorm.
 * User: bickart
 * Date: 9/22/16
 * Time: 2:25 PM
 */

namespace Amaiza\Marketo\Resources;


class SalesPersons extends LeadDatabase
{
    public function __construct(\Amaiza\Marketo\Http\Client $client)
    {
        parent::__construct($client, 'salespersons');
    }

    public function create($externalSalesPersonId, $firstName, $lastName, $email, $title = '', $mobilePhone = '', $phone = '', $fax = '')
    {

        $endpoint = "/v1/{$this->class}.json";

        $salesperson = new \stdClass();
        $salesperson->externalSalesPersonId = empty($externalSalesPersonId) ? $email : $externalSalesPersonId;
        $salesperson->firstName = $firstName;
        $salesperson->lastName = $lastName;
        $salesperson->email = $email;

        if (!empty($title)) {
            $salesperson->title = $title;
        }
        if (!empty($mobilePhone)) {
            $salesperson->mobilePhone = $mobilePhone;
        }
        if (!empty($phone)) {
            $salesperson->phone = $phone;
        }
        if (!empty($fax)) {
            $salesperson->fax = $fax;
        }

        $requestBody = new \stdClass();
        $requestBody->action = 'createOrUpdate';
        $requestBody->dedupeBy =  'dedupeFields';
        $requestBody->input = [$salesperson];

        $options['json'] = $requestBody;

        return $this->client->request('post', $endpoint, $options);
    }

}