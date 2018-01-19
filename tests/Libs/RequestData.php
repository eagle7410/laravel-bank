<?php
namespace Tests\Libs;

class RequestData
{
    public $method;
    public $url;
    public $status = 200;
    public $data;
    public $isCall = false;

    public function __construct($url, $method = "GET", $data = [])
    {
        $this->url = $url;
        $this->method = $method ?? "GET";
        $this->data = $data;
    }

    public function setIsCall(bool $isCall)
    {
        $this->isCall = $isCall;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}
