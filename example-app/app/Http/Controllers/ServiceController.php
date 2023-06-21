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
     * check brackets is closed
     */
    public function checkBrackets(BracketsRequest $request){
        $input = $request->get('s');
        $stack = [];
        $brackets = [
            '(' => ')',
            '[' => ']',
            '{' => '}',
        ];
        $openBrackets = array_keys($brackets);
        $closeBrackets = array_values($brackets);
        $inputLength = strlen($input);
        for ($i = 0; $i < $inputLength; $i++) {
            $char = $input[$i];
            if (in_array($char, $openBrackets)) {
                array_push($stack, $char);
            } elseif (in_array($char, $closeBrackets)) {
                $lastOpenBracket = array_pop($stack);
                if ($brackets[$lastOpenBracket] != $char) {
                    return false;
                }
            }
        }
        return empty($stack);

    }

}
