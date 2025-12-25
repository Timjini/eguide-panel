<?php

namespace Database\Seeders;

use App\Models\Onboarding;
use App\Models\OnboardingStep;
use Illuminate\Database\Seeder;

class OnboardingSeeder extends Seeder
{
    public function run(): void
    {
        $onboardings = [
            [
                'title' => 'Select type',
                'slug' => 'select-type',
                'sort_order' => 1,
            ],
            [
                'title' => 'create company',
                'slug' => 'create-company',
                'sort_order' => 2,
            ],
            [
                'title' => 'Choose A Plan',
                'slug' => 'choose-plan',
                'sort_order' => 3,
            ],
        ];

        foreach ($onboardings as $onboarding) {
            Onboarding::updateOrCreate(
                ['slug' => $onboarding['slug']],
                $onboarding
            );
        }

        $this->command->info('Onboarding created');
    }
}
