<?php
/**
 *
 * @author nyo
 * @date 2016/1/7
 * @package notify-postman
 */

namespace NotifyPostman;

class FakeNotifyRedisHandler extends NotifyRedisHandler
{
    public function save()
    {
        return true;
    }
}

class NotifyPublisherTest extends \PHPUnit_Framework_TestCase
{
    public function testSetHandler()
    {
        $redis_handler = new FakeNotifyRedisHandler();
        $publisher = new NotifyPublisher('test');
        $publisher->setHandler($redis_handler);
        $this->assertEquals($redis_handler, $publisher->handler);
    }

    public function testSave()
    {
        $redis_handler = new FakeNotifyRedisHandler();
        $publisher = new NotifyPublisher('test');
        $publisher->setHandler($redis_handler);
        $notify_message = new NotifyMessage('test massage');

        $this->assertTrue($publisher->save($notify_message));
    }
}
