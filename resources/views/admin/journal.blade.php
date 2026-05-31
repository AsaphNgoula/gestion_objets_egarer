@extends('layouts.admin')

@section('title', 'Journal')
@section('breadcrumb', 'Journal d\'activité')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-black text-[#1B3A6B]" style="font-family:Georgia,serif">
                📜 Journal d'activité
            </h1>
            <p class="text-gray-500 text-[14px] mt-1">
                Historique complet — lecture seule
            </p>
        </div>
        <div class="bg-[#EDE9FE] border border-[#A78BFA] rounded-xl px-4 py-2
                    text-[#6D28D9] text-[13px] font-bold">
            🔒 Lecture seule
        </div>
    </div>

    {{-- MINI STATS --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @foreach([
            ['📋', $stats['total'],        'Total actions',    '#7C3AED'],
            ['👁️', $stats['consultation'],  'Consultations',    '#2D5FA8'],
            ['🤝', $stats['relation'],      'Mises en relation','#16A34A'],
            ['🔔', $stats['notification'],  'Notifications',    '#C8992A'],
        ] as [$icon, $count, $label, $color])
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm
                        relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-1"
                     style="background:{{ $color }}"></div>
                <span class="text-2xl block mb-2">{{ $icon }}</span>
                <span class="block text-3xl font-black text-[#1B3A6B]"
                      style="font-family:Georgia,serif">
                    {{ $count }}
                </span>
                <span class="text-[12px] text-gray-500">{{ $label }}</span>
            </div>
        @endforeach
    </div>

    {{-- TABLEAU --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-[13.5px]">
                <thead>
                    <tr class="bg-gradient-to-r from-[#4C1D95] to-[#7C3AED]">
                        @foreach(['#', 'Date & Heure', 'Type', 'Détail', 'Admin', 'IP'] as $th)
                            <th class="px-5 py-4 text-left text-white font-bold
                                       text-[11px] uppercase tracking-wide">
                                {{ $th }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($journaux as $log)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-4 text-gray-400 font-mono text-[11px]">
                                #{{ str_pad($log->id, 3, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <p class="font-bold text-gray-800">
                                    {{ $log->created_at->format('d/m/Y') }}
                                </p>
                                <p class="text-[11.5px] text-gray-400">
                                    {{ $log->created_at->format('H:i') }}
                                </p>
                            </td>
                            <td class="px-5 py-4">
                                <span class="text-[11px] font-bold px-3 py-1 rounded-full
                                             {{ $log->action === 'consultation'
                                                ? 'bg-[#DBEAFE] text-[#2D5FA8]'
                                                : ($log->action === 'relation'
                                                ? 'bg-[#DCFCE7] text-[#16A34A]'
                                                : ($log->action === 'notification'
                                                ? 'bg-[#FEF3C7] text-[#92400E]'
                                                : 'bg-[#EDE9FE] text-[#7C3AED]')) }}">
                                    {{ ucfirst($log->action) }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-gray-600 max-w-xs">
                                {{ $log->detail }}
                            </td>
                            <td class="px-5 py-4 font-medium text-gray-800">
                                {{ $log->admin->name ?? '—' }}
                            </td>
                            <td class="px-5 py-4 text-gray-400 font-mono text-[12px]">
                                {{ $log->ip_address }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-14 text-center text-gray-400">
                                <p class="text-4xl mb-3">📋</p>
                                <p class="text-[14px]">Aucune activité enregistrée</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($journaux->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $journaux->links() }}
            </div>
        @endif
    </div>

@endsection