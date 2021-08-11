<?php
require_once '../model/Random.php';

class Api
{
    private $randomObj;
    private $requestMethod;
    private $seed;

    public function __construct($requestMethod, $seed = false)
    {
        $this->requestMethod = $requestMethod;
        $this->seed = $seed;

        $this->randomObj = new Random();
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'generate':
                $response = $this->generate();
                break;
            case 'retrive':
                $response = $this->retrive();
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }

        http_response_code($response['code']);

        if (isset($response['data'])) {
            echo json_encode($response['data']);
        }
    }

    function generate()
    {
        $seed = $this->randomObj->getSeed();
        $number = $this->randomObj->getRandom();
        $data = ['seed' => $seed, 'number' => $number];

        return ['code' => 200, 'data' => $data];
    }

    public function retrive()
    {
        $seed = $this->seed;
        if(is_numeric(intval($seed))){
            $seed = intval($seed);
            $this->randomObj->setSeed($seed);
            $number = $this->randomObj->getRandom();
            $data = ['seed' => $seed, 'number' => $number];
            return ['code' => 200, 'data' => $data];
        } else {
            return ['code' => '400'];
        }
    }

    public function notFound()
    {
        return ['code' => '404'];
    }
}