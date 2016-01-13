<?php
/**
 *
 * @author nyo
 * @date 2016/1/7
 * @package notify-postman
 */

namespace NotifyPostman;


class NotifySubscriber
{
    /**
     * @var NotifyRedisHandler
     */
    public $handler;

    public function setHandler(NotifyRedisHandler $handler)
    {
        $this->handler = $handler;
    }

    public function pull()
    {
        return $this->handler->pull(strtotime('-1 mins'));
    }

    public function pullAll()
    {
        return $this->handler->pull();
    }
}