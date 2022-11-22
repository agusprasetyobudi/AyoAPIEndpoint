<?php
namespace App\Helper;
class HttpNullHelper{

    public function nullJsonMessage($module)
    {
        return [
            'error' => true,
            'message' => "Data $module Not Found",
            'data' => null
        ];
    }

}
