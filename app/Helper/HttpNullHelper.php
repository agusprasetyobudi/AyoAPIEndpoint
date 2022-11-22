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

    public function customResponseForSchedule($match_now, $match_comming)
    {
        return [
            'error' => false,
            'message' => 'Get Match Schedule Success',
            'data' =>[
                'match_now' =>$match_now,
                'match_comming' => $match_comming
            ]
        ];
    }

}
