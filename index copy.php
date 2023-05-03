<?php

class HttpRequest {
    private string $url;
    private array $parameters;

    public function __construct()
    {
        $this->url = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        $this->parameters = $_GET;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
    public function setUrl($url): void
    {
        $this->url = $url;
    }
}

$myRequest = new HttpRequest;
var_dump($myRequest);

class Router {
    private HttpRequest $request;

    public function __construct()
    {
        $this->request = new HttpRequest();
    
    }
    public function getRequest() : HttpRequest {
        return $this->request;
    }
}

$myRouter = new Router();
var_dump($myRouter);
echo $myRouter->getRequest()->getUrl();