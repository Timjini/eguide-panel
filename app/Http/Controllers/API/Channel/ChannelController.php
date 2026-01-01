<?php

namespace App\Http\Controllers\API\Channel;

use App\Http\Controllers\API\BaseController;
use App\Models\Channel;
use App\Models\ChannelSubscriber;
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
            $channel = Channel::where('code' , $request->code)
            ->where('status', 'active')
            ->where('ended_at', '>' , now())->first();

            $success =  $channel;
            return $this->sendResponse($success, 'Channel Active.');
        } catch (\Exception $e)
        {
            return $this->sendError('Unauthorised.', ['error' => $e->getMessage()]);
        }
    }

    public function joinChannel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'channelId' => 'required',
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
            $channel = Channel::find($request->channelId);

            if(!$channel)
            {
                return $this->sendError('Unauthorised.', ['error' => 'Channel Expired']);
            }

            $subscriber = ChannelSubscriber::create([
                'channel_id' => $channel->id,
                'user_id' => $user->id,
                'name' => $user->name ?? $user->email,
                'joined_at' => now(),
                'status' => 'active'
            ]);

            if(!$subscriber)
            {
                return $this->sendError('Unauthorised.', ['error' => 'can not subscribe']);
            }

            $success['joined'] =  true;
            return $this->sendResponse($success, 'Joined Channel Successfully.');
        } catch (\Exception $e)
        {
            return $this->sendError('Unauthorised.', ['error' => $e->getMessage()]);
        }
    }
}