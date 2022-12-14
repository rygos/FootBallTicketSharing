<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Application Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1 flex justify-between">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium text-grey-900">{{ __('Application Settings') }}</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __('All fields must be filled out.') }}
                                    </p>
                                </div>
                                <div class="px-4 sm:px-0"></div>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form method="post" action="{{ route('admin.store_settings') }}">
                                    @csrf
                                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                                        <div class="block font-medium text-sm text-gray-700" for="api_last_update">{{ __('Date of the last API update (Set to old value to force an update)') }}</div>
                                        <input value="{{ $settings['api_last_update'] }}" name="api_last_update" id="api_last_update" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" type="text">
                                    </div>
                                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                                        <div class="block font-medium text-sm text-gray-700" for="booking_days_after_match">{{ __('Days after a match in which you can still book tickets later.') }}</div>
                                        <input value="{{ $settings['booking_days_after_match'] }}" name="booking_days_after_match" id="booking_days_after_match" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" type="text">
                                    </div>
                                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                                        <div class="block font-medium text-sm text-gray-700" for="booking_random_ticket">{{ __('Random ticket allocation or selection?') }}</div>
                                        <select name="booking_random_ticket" id="booking_random_ticket" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                                            <option value="1" {{ ($settings['booking_random_ticket'] == 1) ? 'selected' : '' }} >{{ __('Random ticket allocation') }}</option>
                                            <option value="0" {{ ($settings['booking_random_ticket'] == 0) ? 'selected' : '' }}>{{ __('Ticket Selection') }}</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center justify-end px-4 py-3 bg-green-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                                        @if(Session::has('success'))
                                            <div class="alert alert-success">
                                                {{Session::get('success')}}
                                            </div>
                                        @endif
                                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="submit">{{ __('Save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
