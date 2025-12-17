<x-layouts.onboarding :title="__('Onboarding')">
    <div class="mt-8 sm:w-full sm:max-w-md ">
        <form method="POST" action={{ route('onboarding.step', $stepOrder) }} class=" py-8 px-4 shadow sm:rounded-lg sm:px-10 bg-white dark:bg-zinc-800">
            @csrf
            <div class="border-b border-gray-200 pb-5 mb-6">
                <h3 class="text-lg font-medium leading-6">
                    Select the type of onboarding
                </h3>
                <p class="mt-1 text-sm ">
                    Create a new organization account or join your team.
                </p>
            </div>

            <div class="space-y-4">
                <!-- New Organization Option -->
                <label class="relative flex items-start p-4 border border-gray-300 rounded-lg hover:border-blue-500 transition-all duration-200 cursor-pointer group">
                    <div class="flex items-center h-5">
                        <input type="radio" 
                               name="onboarding_type" 
                               value="new_organization"
                               class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                               checked>
                    </div>
                    <div class="ml-3 flex flex-col">
                        <span class="block text-sm font-medium ">
                            New Organization
                        </span>
                        <span class="block text-sm  mt-1">
                            Register your organization and invite members.
                        </span>
                    </div>
                    <div class="absolute inset-0 rounded-lg border-2 border-transparent group-hover:border-blue-200 pointer-events-none"></div>
                </label>

                <!-- Invited Option -->
                <label class="relative flex items-start p-4 border border-gray-300 rounded-lg hover:border-blue-500  transition-all duration-200 cursor-pointer group">
                    <div class="flex items-center h-5">
                        <input type="radio" 
                               name="onboarding_type" 
                               value="invited"
                               class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                    </div>
                    <div class="ml-3 flex flex-col">
                        <span class="block text-sm font-medium ">
                            Invited by an Organization
                        </span>
                        <span class="block text-sm text-gray-500 mt-1">
                            Join an organization
                        </span>
                    </div>
                    <div class="absolute inset-0 rounded-lg border-2 border-transparent group-hover:border-blue-200 pointer-events-none"></div>
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-3">
                <button type="submit"
                        class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md  bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Continue
                </button>
                <button type="button"
                        class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md  hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Back
                </button>
            </div>
        </form>
    </div>
</x-layouts.onboarding>