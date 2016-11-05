<?php
/**
 * Created by PhpStorm.
 * User: bickart
 * Date: 9/27/16
 * Time: 1:30 PM
 */

namespace Amaiza\Marketo\Http;


abstract class OauthToken
{
    /* @var int */
    var $expires_in;

    /* @var string */
    var $access_token;

    /* @var DateTime */
    var $expires;


    public function __construct()
    {
        $this->setExpiresIn(900);
    }

    /**
     * @return int
     */
    public function getExpiresIn()
    {
        return $this->expires_in;
    }

    /**
     * @param int $expires_in
     */
    public function setExpiresIn($expires_in)
    {
        $this->expires_in = $expires_in;
        $now = new DateTime('now', new DateTimeZone('GMT'));
        print_r($now->format('Y-m-d H:i:s'));
        echo PHP_EOL;
        $now->add(new DateInterval('PT'.$expires_in.'S'));
        print_r($now->format('Y-m-d H:i:s'));

        $this->expires = $now;
        echo PHP_EOL;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {

        $interval = $this->expires->diff(new DateTime('now', new DateTimeZone('GMT')));
        if ($interval->h > 1 || $interval->i > 1) {
            return $this->access_token;
        }
    }

    /**
     * @param string $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

}