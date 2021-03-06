<?php
/**
 *
 * @author nyo
 * @date 2016/1/7
 * @package notify-postman
 */

define('PROJECT_ROOT', realpath(__DIR__ . '/../'));

include_once PROJECT_ROOT. '/vendor/autoload.php';

class Controller
{
    private $pub;
    private $sub;

    public function __construct()
    {
        $redis_client = new \Predis\Client();

        $handler = new \NotifyPostman\NotifyRedisHandler($redis_client);

        $this->pub = new \NotifyPostman\NotifyPublisher();
        $this->pub->setHandler($handler);

        $this->sub = new \NotifyPostman\NotifySubscriber();
        $this->sub->setHandler($handler);

    }

    public function push()
    {
        return $this->pub->save(new \NotifyPostman\NotifyMessage('test message', 'testing'));
    }

    public function pull()
    {
        return $this->sub->pull();
    }

    public function pub()
    {

    }

    public function sub()
    {

    }
}

$controller = new Controller();
$run_method = $argv[1];
$result = $controller->$run_method();
var_dump($result);

