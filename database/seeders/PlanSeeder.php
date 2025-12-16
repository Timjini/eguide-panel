<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic Plan',
                'slug' => 'basic',
                'stripe_price_id' => 'price_1Sb2nrJ9jOIfrybIlXWF6QBI',
                'stripe_product_id' => 'prod_TY96JaiqgqWMD0',
                'description' => 'Perfect for small teams getting started',
                'price' => 5.99,
                'currency' => 'usd',
                'interval' => 'month',
                'interval_count' => 1,
                'trial_days' => 14,
                'sort_order' => 1,
                'is_active' => true,
                'features' => [
                    'Up to 5 team members',
                    'Basic project management',
                    '5GB storage',
                    'Email support',
                    'Monthly reports',
                ],
                'limits' => [
                    'max_users' => 5,
                    'max_projects' => 10,
                    'storage_gb' => 5,
                    'support_level' => 'email',
                ],
            ],
            [
                'name' => 'Premium Plan',
                'slug' => 'premium',
                'stripe_price_id' => 'price_1SUU9MJ9jOIfrybIrvNSOYlO',
                'stripe_product_id' => 'prod_TRMtVoJqvGMB3U',
                'description' => 'For growing teams with advanced needs',
                'price' => 9.99,
                'currency' => 'usd',
                'interval' => 'month',
                'interval_count' => 1,
                'trial_days' => 14,
                'sort_order' => 2,
                'is_active' => true,
                'features' => [
                    'All Basic Plan features',
                    'Advanced project management',
                    '50GB storage',
                    'Priority email & chat support',
                    'Custom reports',
                ],
                'limits' => [
                    'max_users' => 20,
                    'max_projects' => 100,
                    'storage_gb' => 50,
                    'support_level' => 'priority',
                ],
            ],
        ];

        foreach ($plans as $plan) {
            Plan::updateOrCreate(
                ['slug' => $plan['slug']],
                $plan
            );
        }

        $this->command->info('Basic ($5.99) and Premium ($9.99) plans created!');
    }
}
