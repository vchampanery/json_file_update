<?php

namespace App\Service;

use stdClass;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class ApiService
 * @package App\Service
 */
class ApiService{

    /** @var boolean $valid */
    private $valid;

    /** @var string $message */
    private $message;

    /** @var array $respData */
    private $respData;

    /** @var string  */
    private $code;

    /** @var stdClass $buildResponse */
    private $buildResponse;


    /**
     * ApiService constructor.
     */
    public function __construct()
    {
        $this->valid = false;
        $this->message = '';
        $this->respData = [];
        $this->code = '200';
    }

    /**
     * @return ApiService
     */
    public function buildResponse(): self {
        $this->buildResponse = (object)[
            'valid'=> $this->valid,
            'code'=> $this->code,
            'message'=> $this->message,
            'data'=> $this->respData
        ];

        return $this;
    }

    /**
     * @return stdClass
     */
    public function getResponse(): stdClass
    {
        return $this->buildResponse;
    }

    /**
     * @return JsonResponse
     */
    public function respond(): JsonResponse
    {
        return new JsonResponse($this->buildResponse()->getResponse());
    }

    /**
     * @param bool $valid
     * @return ApiService
     */
    public function setValid(bool $valid = true): self
    {
        $this->valid = $valid;
        return $this;
    }

    /**
     * @param string $message
     * @return ApiService
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param string $key
     * @param $respData
     * @return ApiService
     */
    public function addRespData(string $key, $respData): self
    {
        $this->respData[$key] = $respData;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function addRespDataArray(array $data) : self
    {

        $this->respData = $data;

        return $this;
    }



    /**
     * @deprecated
     * @param bool $valid
     * @param object|null $data
     * @param string $message
     * @param string $code
     * @return object
     */
    public function response(bool $valid = true, ?object $data = null, string $message = '', string $code = '200' ) : object{


        $resp = (object)[
            'valid'=>$valid,
            'code'=>$code,
            'message'=>$message,
            'data'=>$data
        ];

        return $resp;
    }
}
