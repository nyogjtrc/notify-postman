<?php
/**
 *
 * @author nyo
 * @date 2016/1/7
 * @package notify-postman
 */

namespace NotifyPostman;

class NotifyMessage
{
    private $catalog;
    private $data;
    private $create_at;

    /**
     * NotifyMessage constructor.
     *
     * @param string $data
     * @param string $catalog
     */
    public function __construct($data = 'NoMessage', $catalog = 'NoCatalog')
    {
        $this->data = $data;
        $this->catalog = $catalog;
        $this->create_at = date('Y-m-d H:i:s');
    }

    public function getData()
    {
        return $this->data;
    }

    public function getCreateAt()
    {
        return $this->create_at;
    }

    public function getJsonFormat()
    {
        return json_encode([
            'catalog' => $this->catalog,
            'message' => $this->data,
            'create_at' => $this->create_at,
        ]);
    }
}