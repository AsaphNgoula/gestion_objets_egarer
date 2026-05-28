<footer class="bg-[#1B3A6B] border-t-4 border-[#C8992A] text-white mt-0" id="contact">

    {{-- CONTENU PRINCIPAL --}}
    <div class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-4 gap-10">

        {{-- Colonne 1 : Brand --}}
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-[#C8992A] rounded-lg flex items-center justify-center text-white text-sm">
                    🛡
                </div>
                <div>
                    <div class="text-white font-black text-[15px]">Objets Égarés</div>
                    <div class="text-[#93B8E8] text-[10px] uppercase tracking-widest">Dschang</div>
                </div>
            </div>
            <p class="text-white/60 text-[13px] leading-relaxed">
                Plateforme officielle de gestion des objets égarés dans la ville de Dschang, Région de l'Ouest, Cameroun.
            </p>
            <div class="flex gap-3">
                <a href="#" class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center hover:bg-[#C8992A] transition text-sm">f</a>
                <a href="#" class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center hover:bg-[#C8992A] transition text-sm">W</a>
                <a href="#" class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center hover:bg-[#C8992A] transition text-sm">X</a>
            </div>
        </div>

        {{-- Colonne 2 : Navigation --}}
        <div class="flex flex-col gap-3">
            <h4 class="text-[#C8992A] text-[11px] font-bold uppercase tracking-[2px] mb-1">Navigation</h4>
            @foreach([
                ['Accueil', 'home'],
                ['Objets trouvés', 'objets.index'],
                ['Déclarer un objet', 'deposer'],
                ['Comment ça marche', 'comment'],
            ] as [$label, $route])
                <a href="{{ route($route) }}"
                   class="text-white/60 text-[13px] hover:text-white transition flex items-center gap-2">
                    <span class="text-[#C8992A] text-[10px]">›</span> {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Colonne 3 : Services --}}
        <div class="flex flex-col gap-3">
            <h4 class="text-[#C8992A] text-[11px] font-bold uppercase tracking-[2px] mb-1">Services</h4>
            @foreach([
                ['Déposer un objet trouvé', 'deposer'],
                ['Déclarer une perte', 'deposer'],
            ] as [$label, $route])
                <a href="{{ route($route) }}"
                   class="text-white/60 text-[13px] hover:text-white transition flex items-center gap-2">
                    <span class="text-[#C8992A] text-[10px]">›</span> {{ $label }}
                </a>
            @endforeach
            <a href="#"
               class="text-white/60 text-[13px] hover:text-white transition flex items-center gap-2">
                <span class="text-[#C8992A] text-[10px]">›</span> Créer un compte
            </a>
            <a href="#"
               class="text-white/60 text-[13px] hover:text-white transition flex items-center gap-2">
                <span class="text-[#C8992A] text-[10px]">›</span> Se connecter
            </a>
        </div>

        {{-- Colonne 4 : Contact --}}
        <div class="flex flex-col gap-4">
            <h4 class="text-[#C8992A] text-[11px] font-bold uppercase tracking-[2px] mb-1">Contact</h4>

            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-white/8 rounded-lg flex items-center justify-center text-[#C8992A] flex-shrink-0 mt-1 text-sm">
                    📍
                </div>
                <div>
                    <strong class="text-white text-[12px] block">Adresse</strong>
                    <span class="text-white/60 text-[12.5px]">Hôtel de Ville de Dschang, Région de l'Ouest</span>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-white/8 rounded-lg flex items-center justify-center text-[#C8992A] flex-shrink-0 mt-1 text-sm">
                    📞
                </div>
                <div>
                    <strong class="text-white text-[12px] block">Téléphone</strong>
                    <span class="text-white/60 text-[12.5px]">+237 6XX XX XX XX</span>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-white/8 rounded-lg flex items-center justify-center text-[#C8992A] flex-shrink-0 mt-1 text-sm">
                    ✉️
                </div>
                <div>
                    <strong class="text-white text-[12px] block">Email</strong>
                    <span class="text-white/60 text-[12.5px]">contact@dschanglost.cm</span>
                </div>
            </div>
        </div>

    </div>

    {{-- BAS DU FOOTER --}}
    <div class="border-t border-white/10 py-4 px-6">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-3">
            <p class="text-white/40 text-[12px]">
                © 2024 <span class="text-[#C8992A] font-semibold">DschangLost</span>
                — Ville de Dschang, Cameroun. Tous droits réservés.
            </p>
            <div class="flex gap-5">
                <a href="#" class="text-white/40 text-[12px] hover:text-white transition">Mentions légales</a>
                <a href="#" class="text-white/40 text-[12px] hover:text-white transition">Confidentialité</a>
                <a href="#" class="text-white/40 text-[12px] hover:text-white transition">Support</a>
            </div>
        </div>
    </div>

</footer>