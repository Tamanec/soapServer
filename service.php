<?php

header("Content-Type: text/xml; charset=utf-8");
header('Cache-Control: no-store, no-cache');
header('Expires: '.date('r'));

ini_set("soap.wsdl_cache_enabled", "0");

//Создаем новый SOAP-сервер
$server = new SoapServer(__DIR__ . '/service.wsdl', [
    'classmap' => [
        'myMessage' => 'MyMessage',
        'saveMessages' => 'SaveMessages',
    ],
    'features' => SOAP_SINGLE_ELEMENT_ARRAYS
]);

// SOAP-ERROR: Parsing WSDL: Couldn't load from 'http://localhost:8080/serviceWsdl.php' : failed to load external entity "http://localhost:8080/serviceWsdl.php"
// $server = new SoapServer("http://{$_SERVER['HTTP_HOST']}/serviceWsdl.php");

//Регистрируем класс обработчик
$server->setClass("MarmServiceGateway");

//Запускаем сервер
$server->handle();


class MarmServiceGateway {

    public function saveMessages($messageData) {
        file_put_contents(
            __DIR__ . '/service.log' ,
            var_export($messageData, true)
            . "\n---------------\n\n"
            /*$messageData->messageList[0]->title . "\n"
            . $messageData->messageList[0]->body . "\n"
            . "\n---------------\n\n"*/,
            FILE_APPEND
        );
    }

}

class SaveMessages {

    private $messageList;

    function __construct($messageList)
    {
        $this->messageList = $messageList;
    }

    /**
     * @return mixed
     */
    public function getMessageList()
    {
        return $this->messageList;
    }

    /**
     * @param mixed $messageList
     */
    public function setMessageList($messageList)
    {
        $this->messageList = $messageList;
    }

}

class MyMessage {

    private $title;
    private $body;

    function __construct($title, $body)
    {
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

}