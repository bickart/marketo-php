<?php

namespace Amaiza\Marketo\Resources;

use Amaiza\Marketo\Exceptions\MarketoException;
use Amaiza\Marketo\Factory;
use Amaiza\Marketo\Http\Response;

class Leads extends LeadDatabase
{

    public function __construct(\Amaiza\Marketo\Http\Client $client)
    {
        parent::__construct($client, 'leads');
    }

    /**
     * Get Lead by Id
     *
     * @param int $id
     * @param array|null $fields
     *
     * @return \Amaiza\Marketo\Http\Response
     */
    function getById($id, array $fields = null)
    {
        $endpoint = "/v1/lead/{$id}.json";

        return $this->client->request('get', $endpoint, null, (empty($fields)) ? '' : "fields=" . implode(",", $fields));
    }


    /**
     * Merges two or more known lead records into a single lead record.
     *
     * @param int $leadId - The id of the winning lead record
     * @param int|null $losingLeadId - The id of the losing record
     * @param array|null $leadIds - An array of ids of losing records
     * @param bool $mergeInCRM - If set, will attempt to merge the designated records in a natively-synched CRM. Only valid for instances with are natively synched to SFDC.
     *
     * @return \Amaiza\Marketo\Http\Response
     */
    function merge($leadId, $losingLeadId = null, array $leadIds = null, $mergeInCRM = false)
    {
        $endpoint = "/v1/leads/{$leadId}/merge.json";

        $options = array();
        if (!empty($losingLeadId)) {
            $options['json']['leadId'] = $losingLeadId;
        }

        if (!empty($leadIds)) {
            $options['json']['leadIds'] = implode(',', $leadIds);
        }

        if (!empty($mergeInCRM) && is_bool($mergeInCRM)) {
            $options['json']['mergeInCRM'] = $mergeInCRM;
        }

        if (empty($losingLeadId) && empty($leadIds)) {
            throw new MarketoException('When merging either losingLeadId or leadIds must be provided');
        }

        if (!empty($losingLeadId) && !empty($leadIds)) {
            throw new MarketoException('When merging either losingLeadId or leadIds can be provided but not both');
        }

        if (!is_bool($mergeInCRM)) {

            throw new MarketoException("When merging, mergeInCRM must be a boolean");
        }

        return $this->client->request('post', $endpoint, $options);
    }

    public function all()
    {
        $response = null;

        $maxLeadId = 0;
        $marketo = Factory::create(null, null, null, $this->client);

        $dt = new \DateTime('now', new \DateTimeZone('UTC'));
        $dt->sub(new \DateInterval('P5Y'));
        $token = $marketo->activities()->pagingToken(['sinceDatetime' => $dt->format(DATE_W3C)]);

        if ($token->isSuccess()) {
            $results = $this->getLeadCreatedActivity($marketo, $token->nextPageToken);
            while ($results->isSuccess() && $results->moreResult) {
                $results = $this->getLeadCreatedActivity($marketo, $results->nextPageToken);
            };

            foreach ($results->result as $item) {
                if ($item->leadId > $maxLeadId) {
                    $maxLeadId = $item->leadId;
                }
            }

            print_r($maxLeadId);

            $response = $this->getLeadsByFilterType('id', array($maxLeadId))->getData();

        }

        return $response;
    }

    /**
     * @param $marketo
     * @param $nextPageToken
     *
     * @return \Amaiza\Marketo\Http\Response
     */
    private function getLeadCreatedActivity($marketo, $nextPageToken)
    {
        return $marketo->activities()->activities(['activityTypeIds' => 12, 'nextPageToken' => $nextPageToken]);
    }

}



