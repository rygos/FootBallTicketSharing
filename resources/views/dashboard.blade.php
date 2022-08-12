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
                    <table class="border-collapse table-fixed w-full text-sm table-auto">
                        <thead class="w-full text-sm text-left">
                            <tr>
                                <th scope="col" class="py-3 px-6">Gegner</th>
                                <th scope="col" class="py-3 px-6">Ergebnis</th>
                                <th scope="col" class="py-3 px-6">Buchen</th>
                            </tr>
                        </thead>
@
                        <tbody>
                            @foreach ($data as $item)
                                @if ($item->Team1->TeamId == Config::get('app.team_id'))
                                    <tr>
                                        <td class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap">
                                            <img class="w-10 h-10 rounded-full"
                                                src="/images/clubs/{{ $item->Team2->TeamId }}.png" alt="Logo {{ $item->Team2->TeamName }}">
                                            <div class="pl-3">
                                                <div class="text-base font-semibold">{{ $item->Team2->TeamName }}</div>
                                                <div class="font-normal text-gray-500">
                                                    {{ Carbon\Carbon::parse($item->MatchDateTime)->format('d.m.Y H:m') }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="items-center py-4 px-6 text-gray-900 whitespace-nowrap">
                                            <div class="pl-3">
                                                <div class="text-base font-semibold">
                                                    {{ @$item->MatchResults[0]->PointsTeam1 }} -
                                                    {{ @$item->MatchResults[0]->PointsTeam2 }}</div>
                                                <div class="font-normal text-gray-500">
                                                    {{ @$item->MatchResults[1]->PointsTeam1 }} -
                                                    {{ @$item->MatchResults[1]->PointsTeam2 }}</div>
                                            </div>
                                        </td>
                                        <td class="items-center py-4 px-6 text-gray-900 whitespace-nowrap">
                                            <div class="pl-3">
                                                <div class="text-base font-semibold">Karte freigeben</div>
                                                <div class="font-normal text-gray-500">Verfügbare Karten: 3</div>
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
