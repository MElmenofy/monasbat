<?php
namespace App\Traits;

trait ApiTrait
{

    public function apiData($data = null, $msg = null, $status = null)
    {
        $array = [
            'data' => $data,
            'msg' => $msg,
            'status' => $status,
        ];
        return response($array);
    }


}
