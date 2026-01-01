<?php

namespace App\Http\Controllers\API\Channel;

use App\Http\Controllers\API\BaseController;
use App\Models\Channel;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ChannelController extends BaseController
{
    public function getChannelByCode(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = $request->user();

        if (!$user) 
        {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }

        try{
            $channel = Channel::where('code' , $request->code)->first();
            $success =  $channel;
            return $this->sendResponse($success, 'Channel Active.');
        } catch (\Exception $e)
        {
            return $this->sendError('Unauthorised.', ['error' => $e->getMessage()]);
        }


    }
}