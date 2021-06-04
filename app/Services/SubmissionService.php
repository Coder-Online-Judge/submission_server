<?php

namespace App\Services;

use App\Models\Submission;
use File;
use Illuminate\Support\Str;

class SubmissionService
{

	public static function compressString($str,$len=250){
        $stringLen = strlen($str);
        if($stringLen<=$len)return $str;
        return substr($str, 0, $len)."...";
    }


    public static function createToken($id)
    {
        return md5(uniqid()) . '-' . md5($id) . '-' . Str::random(15);
    }

    public static function createInputOutputFile($token)
    {
        File::put(self::getFileName('input', $token), isset(request()->input) ? request()->input : "");
        File::put(self::getFileName('expected_output', $token), isset(request()->expected_output) ? request()->expected_output : "");
    }

    public static function getFileName($operation, $token)
    {
        return "test_case/{$operation}/{$token}.txt";
    }

    public static function filterSubmissionByFields($data)
    {
        $fields = isset(request()->fields) ? explode(',', request()->fields) : [];
        return empty($fields) ? $data : array_intersect_key($data, array_flip($fields));
    }
}
