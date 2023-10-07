<?php

namespace Gavan4eg\StateTaxServiceUkraine\Services;

use GuzzleHttp\Client;
use PPOLib\KeyStore;
use PPOLib\PPO;

class PostJsonTaxService
{
    public function jsonShiftsList($ppro, $dateFrom, $dateTo)
    {
        return '{"Command":"Shifts","NumFiscal":"' . $ppro . '","From":"' . $dateFrom . '","To":"' . $dateTo . '"}';
    }

    public function jsonCheckList($prro, $shift, $openFiscalNum)
    {
        return '{"Command":"Documents","NumFiscal":"' . $prro . '","ShiftId":"' . $shift . '","OpenShiftFiscalNum":"' . $openFiscalNum . '"}';
    }

    public function jsonSignCheck($prro, $check): string
    {
        return '{"Command":"Check","RegistrarNumFiscal":"' . $prro . '","NumFiscal":"' . $check . '","Original":false}';
    }

    public function jsonSignZRep($prro, $check): string
    {
        return '{"Command":"ZRep","RegistrarNumFiscal":"' . $prro . '","NumFiscal":"' . $check . '","Original":true}';
    }
}
