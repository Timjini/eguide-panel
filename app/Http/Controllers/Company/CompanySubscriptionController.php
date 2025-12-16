<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Jobs\SubscribeCompanyToPlan;
use Illuminate\Http\Request;

final class CompanySubscriptionController extends Controller
{
    public function subscribe(Request $request, string $billableId)
    {
        SubscribeCompanyToPlan::dispatchSync(
            billableId: $billableId,
            planCode: $request->string('plan_code')->toString()
        );

        return response()->json(['status' => 'subscribed'], 201);
    }
}
