<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    {{ __('Your Tickets') }}
                    <table class="border-collapse table-fixed w-full text-sm table-auto">
                        <thead class="w-full text-sm text-left">
                        <tr>
                            <th scope="col" class="py-3 px-6">{{ __('Ticket Name') }}</th>
                            <th scope="col" class="py-3 px-3">{{ __('Season') }}</th>
                            <th scope="col" class="py-3 px-3">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($data)
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap">
                                            {{ $item->title }}
                                        </td>
                                        <td>
                                            {{ \App\Models\League::whereLeagueId($item->league_id)->first()->league_name }}
                                        </td>
                                        <td class="items-center py-4 px-6 text-gray-900 whitespace-nowrap">
                                            <div class="pl-3">
                                                <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" href="{{ route('ticket.delete', ['id' => $item->id]) }}">{{ __('Delete Ticket') }}</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>{{ __('You have not added any tickets yet.') }}</td>
                                    <td></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    {{ __('Add new Ticket') }}
                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1 flex justify-between">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium text-grey-900">{{ __('Add Ticket') }}</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __('All fields must be filled out.') }}
                                    </p>
                                </div>
                                <div class="px-4 sm:px-0"></div>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        {{Session::get('success')}}
                                    </div>
                                @endif
                                <form method="post" action="{{ route('ticket.store') }}">
                                    @csrf
                                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                                        <div class="block font-medium text-sm text-gray-700" for="description">{{ __('Description') }}</div>
                                        <input name="description" id="description" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" type="text">
                                    </div>
                                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                                        <div class="block font-medium text-sm text-gray-700" for="season">{{ __('Year of Season Beginning') }}</div>
                                        <select name="season" id="season" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                                            @foreach(\App\Models\League::get() as $item)
                                                <option value="{{ $item->league_id }}">{{ $item->league_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex items-center justify-end px-4 py-3 bg-green-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
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
