<?php

namespace BookStore\Api\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    public function sendResponse($result, $message, $total=0, $code = 200)
    {
        if($total > 0) {
            $response = [
                'success' => true,
                'total'   => $total,
                'data'    => $result,
                'message' => $message
            ];
        } else {
            $response = [
                'success' => true,
                'data'    => $result,
                'message' => $message
            ];
        }

        return response()->json($response, $code);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success'  =>  false,
            'message'  =>  $error
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
