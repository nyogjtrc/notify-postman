<?php
/**
 *
 * @author nyo
 * @date 2016/1/7
 * @package notify-postman
 */

namespace NotifyPostman;


class NotifyPublisher
{
    /**
     * @var NotifyRedisHandler
     */
    public $handler;

    public function setHandler(NotifyRedisHandler $handler)
    {
        $this->handler = $handler;
    }

    public function save(NotifyMessage $message)
    {
        if (!$this->handler) {
            return false;
        }

        $this->handler->setMessage($message);

        return $this->handler->save();
    }
}