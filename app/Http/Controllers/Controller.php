<?php

namespace App\Http\Controllers;

use App\Http\HttpCode;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function apiResponse(
            $details = [],
            $childName,
            $xml,
            $status = HttpCode::HTTP_OK,
            $headers = []
        ) {
            $xmlData = new \SimpleXMLElement($xml);
            foreach ($details as $detail) {
                $userElement = $xmlData->addChild($childName);
                foreach ($detail as $key => $value) {
                    $userElement->addChild($key, $value);
                }
            }
            $result =  $xmlData->asXML();
            return response($result, $status, $headers);
    }
}
