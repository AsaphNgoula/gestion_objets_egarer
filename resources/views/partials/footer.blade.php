<footer class="bg-[#1B3A6B] border-t-4 border-[#C8992A] text-white mt-0" id="contact">

    {{-- CONTENU PRINCIPAL --}}
    <div class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-4 gap-12">

        {{-- Colonne 1 : Brand --}}
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#C8992A] rounded-xl flex items-center justify-center text-white text-lg shadow-md">
                    🛡️
                </div>
                <div>
                    <div class="text-white font-black text-base leading-tight">Objets Égarés</div>
                    <div class="text-[#93B8E8] text-[11px] uppercase tracking-widest font-semibold">Dschang</div>
                </div>
            </div>
            <p class="text-white/70 text-sm leading-relaxed">
                Plateforme officielle de gestion des objets égarés dans la ville de Dschang, Région de l'Ouest, Cameroun.
            </p>
            <div class="flex gap-3 mt-2">
                <a href="#" class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center text-white/80 hover:bg-[#C8992A] hover:text-white transition-all duration-300 hover:scale-110">📘</a>
                <a href="#" class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center text-white/80 hover:bg-[#C8992A] hover:text-white transition-all duration-300 hover:scale-110">🐦</a>
                <a href="#" class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center text-white/80 hover:bg-[#C8992A] hover:text-white transition-all duration-300 hover:scale-110">📷</a>
            </div>
        </div>

        {{-- Colonne 2 : Navigation --}}
        <div class="flex flex-col gap-3">
            <h4 class="text-[#C8992A] text-xs font-black uppercase tracking-[2px] mb-2">Navigation</h4>
            @foreach([
                ['Accueil', 'home'],
                ['Objets trouvés', 'objets.index'],
                ['Déclarer un objet', 'deposer'],
                ['Comment ça marche', 'comment'],
            ] as [$label, $route])
                <a href="{{ route($route) }}"
                   class="text-white/70 text-sm hover:text-white transition-all duration-200 flex items-center gap-2 group">
                    <span class="text-[#C8992A] text-xs group-hover:translate-x-1 transition-transform">›</span> 
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Colonne 3 : Services & Compte --}}
        <div class="flex flex-col gap-3">
            <h4 class="text-[#C8992A] text-xs font-black uppercase tracking-[2px] mb-2">Services</h4>
            @foreach([
                ['Déposer un objet trouvé', 'deposer'],
                ['Déclarer une perte', 'deposer'],
            ] as [$label, $route])
                <a href="{{ route($route) }}"
                   class="text-white/70 text-sm hover:text-white transition-all duration-200 flex items-center gap-2 group">
                    <span class="text-[#C8992A] text-xs group-hover:translate-x-1 transition-transform">›</span> 
                    {{ $label }}
                </a>
            @endforeach
            <a href="{{ route('register') }}"
               class="text-white/70 text-sm hover:text-white transition-all duration-200 flex items-center gap-2 group">
                <span class="text-[#C8992A] text-xs group-hover:translate-x-1 transition-transform">›</span> 
                Créer un compte
            </a>
            <a href="{{ route('login') }}"
               class="text-white/70 text-sm hover:text-white transition-all duration-200 flex items-center gap-2 group">
                <span class="text-[#C8992A] text-xs group-hover:translate-x-1 transition-transform">›</span> 
                Se connecter
            </a>
        </div>

        {{-- Colonne 4 : Contact --}}
        <div class="flex flex-col gap-4">
            <h4 class="text-[#C8992A] text-xs font-black uppercase tracking-[2px] mb-2">Contact</h4>

            <div class="flex items-start gap-3 group">
                <div class="w-9 h-9 bg-white/10 rounded-xl flex items-center justify-center text-[#C8992A] flex-shrink-0 group-hover:bg-[#C8992A] group-hover:text-white transition-all duration-300">
                    📍
                </div>
                <div>
                    <strong class="text-white text-sm block">Adresse</strong>
                    <span class="text-white/60 text-sm">Hôtel de Ville de Dschang, Région de l'Ouest</span>
                </div>
            </div>

            <div class="flex items-start gap-3 group">
                <div class="w-9 h-9 bg-white/10 rounded-xl flex items-center justify-center text-[#C8992A] flex-shrink-0 group-hover:bg-[#C8992A] group-hover:text-white transition-all duration-300">
                    📞
                </div>
                <div>
                    <strong class="text-white text-sm block">Téléphone</strong>
                    <span class="text-white/60 text-sm">+237 6XX XX XX XX</span>
                </div>
            </div>

            <div class="flex items-start gap-3 group">
                <div class="w-9 h-9 bg-white/10 rounded-xl flex items-center justify-center text-[#C8992A] flex-shrink-0 group-hover:bg-[#C8992A] group-hover:text-white transition-all duration-300">
                    ✉️
                </div>
                <div>
                    <strong class="text-white text-sm block">Email</strong>
                    <span class="text-white/60 text-sm">contact@dschanglost.cm</span>
                </div>
            </div>
        </div>

    </div>

    {{-- BAS DU FOOTER --}}
    <div class="border-t border-white/10 py-5 px-6">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-white/50 text-sm">
                © 2025 <span class="text-[#C8992A] font-bold">DschangLost</span>
                — Ville de Dschang, Cameroun. Tous droits réservés.
            </p>
            <div class="flex gap-6">
                <a href="#" class="text-white/50 text-sm hover:text-white transition-all duration-200">Mentions légales</a>
                <a href="#" class="text-white/50 text-sm hover:text-white transition-all duration-200">Confidentialité</a>
                <a href="#" class="text-white/50 text-sm hover:text-white transition-all duration-200">Support</a>
            </div>
        </div>
    </div>

</footer>