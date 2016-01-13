<?php
/**
 *
 * @author nyo
 * @date 2016/1/7
 * @package notify-postman
 */

namespace NotifyPostman;

use Predis\Client;

class NotifyRedisHandler
{
    /**
     * @var Client
     */
    private $client;
    private $key_header = 'notify_postman';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @var NotifyMessage
     */
    private $message;

    public function setMessage(NotifyMessage $msg)
    {
        $this->message = $msg;
    }

    public function save()
    {
        return $this->zSetSave();
    }

    public function pull($from = '')
    {
        return $this->zSetPull($from);

    }

    private function listSave()
    {
        return $this->client->lpush(
            $this->key_header,
            array($this->message->getJsonFormat())
        );
    }

    private function listPull()
    {
        return $this->client->rpop($this->key_header);
    }

    private function zSetSave()
    {
        return $this->client->zadd(
            $this->key_header,
            array(
                $this->message->getJsonFormat() => strtotime($this->message->getCreateAt()),
            )
        );
    }

    private function zSetPull($from = '')
    {
        if (empty($from)) {
            $from = '-inf';
        }

        $result = $this->client->zrangebyscore(
            $this->key_header,
            $from,
            '+inf'
        );

        //$this->client->zremrangebyscore($this->key_header, '-inf', strtotime("-1 mins"));

        return $result;
    }
}