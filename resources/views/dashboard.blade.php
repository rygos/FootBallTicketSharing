<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    {{ $league_name }}
                    <div class="font-light text-gray-500">{{ __('Last Update') }}: {{ Carbon\Carbon::parse(\App\Models\Setting::whereOption('api_last_update')->first()->value)->format('d.m.Y H:m') }}</div>
                    <table class="border-collapse table-fixed w-full text-sm table-auto">
                        <thead class="w-full text-sm text-left">
                            <tr>
                                <th scope="col" class="py-3 px-6">{{ __('Opponent') }}</th>
                                <th scope="col" class="py-3 px-6">{{ __('Result') }}</th>
                                <th scope="col" class="py-3 px-6">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                @if ($item->team1_id == Config::get('app.team_id'))
                                    <tr>
                                        <td class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap">
                                            <img class="w-10 h-10 rounded-lg"
                                                src="/images/clubs/{{ $item->team2_id }}.png" alt="Logo {{ $item->team2_name }}">
                                            <div class="pl-3">
                                                <div class="text-base font-semibold">{{ $item->team2_name }}</div>
                                                <div class="font-normal text-gray-500">
                                                    {{ $item->group_name }} - {{ Carbon\Carbon::parse($item->match_time)->format('d.m.Y H:m') }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="items-center py-4 px-6 text-gray-900 whitespace-nowrap">
                                            <div class="pl-3">
                                                <div class="text-base font-semibold">
                                                    {{ @$item->result_end_t1 }} -
                                                    {{ @$item->result_end_t2 }}</div>
                                                <div class="font-normal text-gray-500">
                                                    ({{ @$item->result_half_t1 }} -
                                                    {{ @$item->result_half_t2 }})</div>
                                            </div>
                                        </td>
                                        <td class="items-center py-4 px-6 text-gray-900 whitespace-nowrap">
                                            @php
                                                $show_share = false;
                                                $ownTickets = \App\Models\Ticket::whereLeagueId($item->league_id)->get();
                                                foreach ($ownTickets as $it){
                                                    if(\App\Models\TicketClaim::whereTicketId($it->id)->whereNull('claimed_by_id')->where('match_id', $item->match_id)->count() == 0){
                                                        $show_share = true;
                                                    }
                                                }
                                                $bookingcount = \App\Models\TicketClaim::whereMatchId($item->match_id)->whereNull('claimed_by_id')->count();
                                            @endphp
                                            <div class="pl-3">
                                                @if($show_share and \Carbon\Carbon::parse($item->match_time)->diffInDays(\Carbon\Carbon::now(), false) <= \App\Models\Setting::whereOption('booking_days_after_match')->first()->value)
                                                    <div class="text-base font-semibold">
                                                        <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" href="{{ route('ticket.share', ['league_id' => $item->league_id, 'match_id' => $item->match_id]) }}">{{ __('Share Ticket') }}</a>
                                                    </div>
                                                @endif
                                                @if($bookingcount != 0 and \Carbon\Carbon::parse($item->match_time)->diffInDays(\Carbon\Carbon::now(), false) <= \App\Models\Setting::whereOption('booking_days_after_match')->first()->value)
                                                    <div class="text-base font-semibold">
                                                        <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" href="{{ route('ticket.booking', ['league_id' => $item->league_id, 'match_id' => $item->match_id]) }}">{{ __('Book Ticket') }}</a>
                                                    </div>
                                                @endif

                                                <div class="font-normal text-gray-500">Verfügbare Karten: {{ $bookingcount }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
