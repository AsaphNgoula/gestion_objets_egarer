@extends('layouts.admin')

@section('title', 'Demandes')
@section('breadcrumb', 'Demandes d\'assistance')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-black text-[#1B3A6B]" style="font-family:Georgia,serif">
                ✉️ Demandes d'assistance
            </h1>
            <p class="text-gray-500 text-[14px] mt-1">
                Messages envoyés par les propriétaires inscrits
            </p>
        </div>
    </div>

    {{-- MINI STATS --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @foreach([
            ['📧', $stats['total'],   'Total',     '#2D5FA8'],
            ['🔴', $stats['non_lu'],  'Non lus',   '#DC2626'],
            ['🟡', $stats['lu'],      'Lus',       '#C8992A'],
            ['✅', $stats['traite'],  'Traités',   '#16A34A'],
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

    {{-- LISTE --}}
    <div class="flex flex-col gap-4">
        @forelse($demandes as $dem)
            <div class="bg-white rounded-2xl border shadow-sm overflow-hidden
                        {{ $dem->statut === 'non_lu'
                           ? 'border-l-4 border-l-red-500 border-gray-100'
                           : ($dem->statut === 'traite'
                           ? 'border-l-4 border-l-[#16A34A] border-gray-100'
                           : 'border-l-4 border-l-[#C8992A] border-gray-100') }}">

                <div class="p-6">
                    {{-- Header --}}
                    <div class="flex flex-col sm:flex-row sm:items-center
                                justify-between gap-3 mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#1B3A6B] rounded-full flex items-center
                                        justify-center text-white font-black text-[15px]">
                                {{ substr($dem->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-black text-gray-800 text-[14px]">
                                    {{ $dem->user->name }}
                                </p>
                                <p class="text-[12px] text-gray-400">
                                    {{ $dem->user->email }}
                                    · {{ $dem->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <span class="text-[11.5px] font-bold px-3 py-1.5 rounded-full
                                     {{ $dem->statut === 'non_lu'
                                        ? 'bg-red-50 text-red-600'
                                        : ($dem->statut === 'traite'
                                        ? 'bg-[#DCFCE7] text-[#16A34A]'
                                        : 'bg-[#FEF3C7] text-[#92400E]') }}">
                            {{ $dem->statut === 'non_lu' ? '🔴 Non lu' :
                               ($dem->statut === 'traite' ? '✅ Traité' : '🟡 Lu') }}
                        </span>
                    </div>

                    {{-- Objet concerné --}}
                    @if($dem->declaration)
                        <div class="bg-[#EFF6FF] border border-[#BFDBFE] rounded-xl
                                    px-4 py-3 mb-4 flex items-center gap-2">
                            <span class="text-[#2D5FA8]">📋</span>
                            <p class="text-[13px] text-[#1B3A6B]">
                                <span class="font-bold">Objet concerné :</span>
                                {{ $dem->declaration->nom ?? $dem->declaration->categorie }}
                                — {{ $dem->declaration->lieu }}
                            </p>
                        </div>
                    @endif

                    {{-- Message --}}
                    <div class="bg-gray-50 rounded-xl px-5 py-4 mb-4 border-l-3
                                border-l-[#1B3A6B] italic text-gray-600 text-[13.5px]
                                leading-relaxed">
                        "{{ $dem->message }}"
                    </div>

                    {{-- Réponse admin existante --}}
                    @if($dem->reponse_admin)
                        <div class="bg-[#DCFCE7] border border-[#86EFAC] rounded-xl
                                    px-5 py-4 mb-4">
                            <p class="text-[11px] font-bold text-[#16A34A] uppercase
                                      tracking-wide mb-1">
                                ✅ Réponse de l'admin
                            </p>
                            <p class="text-[13.5px] text-gray-700">
                                {{ $dem->reponse_admin }}
                            </p>
                        </div>
                    @endif

                    {{-- Actions --}}
                    <div class="flex flex-wrap gap-3">

                        @if($dem->statut === 'non_lu')
                            <form method="POST"
                                  action="{{ route('admin.demandes.statut', $dem) }}">
                                @csrf @method('PATCH')
                                <input type="hidden" name="statut" value="lu"/>
                                <button type="submit"
                                        class="flex items-center gap-2 bg-[#FEF3C7]
                                               text-[#92400E] font-bold text-[12.5px]
                                               px-4 py-2 rounded-lg hover:bg-[#C8992A]
                                               hover:text-white transition">
                                    📖 Marquer lu
                                </button>
                            </form>
                        @endif

                        {{-- Formulaire réponse --}}
                        @if($dem->statut !== 'traite')
                            <button onclick="toggleReponse({{ $dem->id }})"
                                    class="flex items-center gap-2 bg-[#DBEAFE]
                                           text-[#2D5FA8] font-bold text-[12.5px]
                                           px-4 py-2 rounded-lg hover:bg-[#2D5FA8]
                                           hover:text-white transition">
                                💬 Répondre
                            </button>
                        @endif

                    </div>

                    {{-- Zone réponse cachée --}}
                    @if($dem->statut !== 'traite')
                        <div id="reponse-{{ $dem->id }}" class="hidden mt-4">
                            <form method="POST"
                                  action="{{ route('admin.demandes.repondre', $dem) }}">
                                @csrf
                                <textarea name="reponse_admin" rows="3" required
                                          placeholder="Votre réponse..."
                                          class="w-full px-4 py-3 border-2 border-gray-200
                                                 rounded-xl text-[13.5px] outline-none
                                                 focus:border-[#2D5FA8] resize-none mb-3">{{ old('reponse_admin') }}</textarea>
                                <button type="submit"
                                        class="bg-[#1B3A6B] text-white font-bold text-[13px]
                                               px-6 py-2.5 rounded-xl hover:bg-[#14305a] transition">
                                    ✈️ Envoyer la réponse
                                </button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm
                        py-16 text-center text-gray-400">
                <p class="text-5xl mb-4">📭</p>
                <p class="text-[14px]">Aucune demande d'assistance pour le moment</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($demandes->hasPages())
        <div class="mt-6">{{ $demandes->links() }}</div>
    @endif

@endsection

@push('scripts')
<script>
function toggleReponse(id) {
    const el = document.getElementById('reponse-' + id);
    el.classList.toggle('hidden');
}
</script>
@endpush