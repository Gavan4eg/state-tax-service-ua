<?php

namespace Gavan4eg\StateTaxServiceUkraine\Services;

use GuzzleHttp\Client;
use PPOLib\KeyStore;
use PPOLib\PPO;

class PPOService extends LoadKeyPPOService
{


    protected $cert;
    protected $key;
    private $json;

    public function __construct()
    {
        $this->cert = $this->getKey()[1];
        $this->key = $this->getKey()[0];

        $this->json = new PostJsonTaxService();

    }


    /**
     * Отримати усі змніи за період
     *
     * @param $prro
     * @param $dateFrom
     * @param $dateTo
     * @return mixed
     * @throws \Exception
     */

    public function PPOSingShifts($prro, $dateFrom, $dateTo)
    {
        $json = PPO::sign($this->json->jsonShiftsList($prro, $dateFrom, $dateTo), $this->key, $this->cert);

        return $this->sendJson($json);
    }

    /**
     * Отримання ZRep отчета
     * @param $prro
     * @param $check
     * @param $key
     * @param $cert
     * @return string
     * @throws \Exception
     */
    public function PPOSignZRep($prro, $check)
    {
        $sing = PPO::sign($this->json->jsonSignZRep($prro, $check), $this->key, $this->cert);

        $xml = $this->sendAndDecrypt($sing);

        return $this->convetXmlToJson($xml);

    }


    /**
     * Отримання розгорнутого чеку
     * @param $prro
     * @param $check
     * @return mixed
     * @throws \Exception
     */

    public function PPOSignCheckSum($prro, $check)
    {
        $sing = PPO::sign($this->json->jsonSignCheck($prro, $check), $this->key, $this->cert);

        $array =  $this->sendAndDecrypt($sing);

        return  $this->convetXmlToJson($array);
    }


    /**
     * Отимання чеків за зміну
     * @param $prro
     * @param $shift
     * @param $key
     * @param $cert
     * @return mixed
     */
    public function PPOGetCheckList($prro, $shift, $openFiscalNum)
    {
        $json = PPO::sign($this->json->jsonCheckList($prro, $shift, $openFiscalNum), $this->key, $this->cert);

        return $this->sendJson($json);
    }


    /**
     * @throws \Exception
     */
    private function sendJson($json)
    {
        $answer = PPO::send($json, 'cmd');

        return json_decode($answer, true);
    }


    /**
     * @throws \Exception
     */
    private function sendAndDecrypt($sing): string
    {
        $answer = PPO::send($sing, 'cmd');

        return PPO::decrypt($answer, true);
    }

    /**
     * Коверт xml to json
     * @param $data
     * @return mixed
     */

    private function convetXmlToJson($data)
    {
        $array = simplexml_load_string($data);
        $json = json_encode($array);

        return json_decode($json, true);
    }


}
