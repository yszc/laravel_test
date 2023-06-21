<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BracketsRequest;

class ServiceController extends Controller
{
    public function get(Request $request)
    {
        return $request->all();
    }


    public function post(Request $request)
    {
        return $request->all();
    }

    /**
     * return a bool value if brackets is closed
     */
    public function checkBrackets(BracketsRequest $request){
        $s = $request->input('s');
        $s = str_split($s);
        $stack = [];
        $map = [
            ')' => '(',
            ']' => '[',
            '}' => '{',
        ];
        foreach ($s as $key => $value) {
            if (in_array($value, $map)) {
                array_push($stack, $value);
            } else {
                if (end($stack) == $map[$value]) {
                    array_pop($stack);
                } else {
                    return false;
                }
            }
        }
        return empty($stack) ? true : false;
    }

}
