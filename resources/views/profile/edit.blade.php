<x-profile-layout>
    <div class="p-8">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            {{ __('Profile') }}
        </h2>
    
        <div class="py-12">
            <div class="max-w-7xl space-y-6">
                <div class="p-4 sm:p-8 bg-blue-400 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
    
                <div class="p-4 sm:p-8 bg-blue-400 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
    
                <div class="p-4 sm:p-8 bg-blue-400 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-profile-layout>
