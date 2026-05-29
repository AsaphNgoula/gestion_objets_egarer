<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Inscription — DschangLost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen relative overflow-hidden">

    {{-- IMAGE DE FOND --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/dschang2.jpg') }}"
             alt="Dschang"
             class="w-full h-full object-cover"/>
        <div class="absolute inset-0 bg-gradient-to-br from-[#1B3A6B]/90 via-[#1B3A6B]/75 to-[#0f2244]/90"></div>
    </div>

    {{-- NAVBAR MINIMALE --}}
    <nav class="relative z-10 px-8 py-5 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div class="w-10 h-10 bg-[#C8992A] rounded-xl flex items-center justify-center text-white text-lg shadow-lg">
                🛡
            </div>
            <div>
                <span class="text-white font-black text-[15px] block leading-tight">Objets Égarés</span>
                <span class="text-[#93B8E8] text-[10px] uppercase tracking-widest">Dschang</span>
            </div>
        </a>
        <a href="{{ route('home') }}"
           class="text-white/70 text-[13px] hover:text-white transition flex items-center gap-2">
            ← Retour à l'accueil
        </a>
    </nav>

    {{-- CONTENU --}}
    <div class="relative z-10 flex items-center justify-center
                min-h-[calc(100vh-80px)] px-4 py-8">

        <div class="w-full max-w-[460px]">

            {{-- TITRE --}}
            <div class="text-center mb-8">
                <h1 class="text-white font-black text-4xl mb-2" style="font-family:Georgia,serif">
                    Créer un compte
                </h1>
                <p class="text-white/65 text-[14px]">
                    Inscrivez-vous pour déclarer vos pertes<br>
                    et recevoir des alertes par email
                </p>
            </div>

            {{-- CARD --}}
            <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl overflow-hidden border border-white/20">

                {{-- BANDE --}}
                <div class="h-1.5 bg-gradient-to-r from-[#C8992A] via-[#2D5FA8] to-[#1B3A6B]"></div>

                <div class="px-8 py-8">

                    {{-- ERREURS --}}
                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-xl px-4 py-3 mb-5">
                            @foreach ($errors->all() as $error)
                                <p class="text-red-600 text-[13px] flex items-center gap-2">
                                    ⚠️ {{ $error }}
                                </p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
                        @csrf

                        {{-- NOM COMPLET --}}
                        <div>
                            <label class="block text-[12.5px] font-bold text-gray-600 uppercase tracking-wide mb-2">
                                Nom complet
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-[15px]">
                                    👤
                                </span>
                                <input type="text"
                                       name="name"
                                       value="{{ old('name') }}"
                                       required
                                       placeholder="Votre nom complet"
                                       class="w-full pl-10 pr-4 py-3 border-2 rounded-xl text-[14px]
                                              text-gray-800 bg-gray-50 outline-none transition-all
                                              focus:border-[#2D5FA8] focus:bg-white focus:shadow-sm
                                              @error('name') border-red-400 bg-red-50 @else border-gray-200 @enderror"/>
                            </div>
                        </div>

                        {{-- TÉLÉPHONE --}}
                        <div>
                            <label class="block text-[12.5px] font-bold text-gray-600 uppercase tracking-wide mb-2">
                                Téléphone
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-[15px]">
                                    📞
                                </span>
                                <input type="tel"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       placeholder="Ex : 6XX XX XX XX"
                                       class="w-full pl-10 pr-4 py-3 border-2 rounded-xl text-[14px]
                                              text-gray-800 bg-gray-50 outline-none transition-all
                                              focus:border-[#2D5FA8] focus:bg-white focus:shadow-sm
                                              @error('phone') border-red-400 bg-red-50 @else border-gray-200 @enderror"/>
                            </div>
                        </div>

                        {{-- EMAIL --}}
                        <div>
                            <label class="block text-[12.5px] font-bold text-gray-600 uppercase tracking-wide mb-2">
                                Email Gmail
                                <span class="text-[#C8992A] normal-case font-normal ml-1">
                                    (pour recevoir les notifications)
                                </span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-[15px]">
                                    ✉️
                                </span>
                                <input type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       placeholder="exemple@gmail.com"
                                       class="w-full pl-10 pr-4 py-3 border-2 rounded-xl text-[14px]
                                              text-gray-800 bg-gray-50 outline-none transition-all
                                              focus:border-[#2D5FA8] focus:bg-white focus:shadow-sm
                                              @error('email') border-red-400 bg-red-50 @else border-gray-200 @enderror"/>
                            </div>
                        </div>

                        {{-- MOT DE PASSE --}}
                        <div>
                            <label class="block text-[12.5px] font-bold text-gray-600 uppercase tracking-wide mb-2">
                                Mot de passe
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-[15px]">
                                    🔒
                                </span>
                                <input type="password"
                                       name="password"
                                       required
                                       placeholder="Minimum 8 caractères"
                                       class="w-full pl-10 pr-4 py-3 border-2 rounded-xl text-[14px]
                                              text-gray-800 bg-gray-50 outline-none transition-all
                                              focus:border-[#2D5FA8] focus:bg-white focus:shadow-sm
                                              @error('password') border-red-400 bg-red-50 @else border-gray-200 @enderror"/>
                            </div>
                        </div>

                        {{-- CONFIRMER MOT DE PASSE --}}
                        <div>
                            <label class="block text-[12.5px] font-bold text-gray-600 uppercase tracking-wide mb-2">
                                Confirmer le mot de passe
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-[15px]">
                                    🔐
                                </span>
                                <input type="password"
                                       name="password_confirmation"
                                       required
                                       placeholder="Répétez le mot de passe"
                                       class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl
                                              text-[14px] text-gray-800 bg-gray-50 outline-none transition-all
                                              focus:border-[#2D5FA8] focus:bg-white focus:shadow-sm"/>
                            </div>
                        </div>

                        {{-- CONDITIONS --}}
                        <div class="flex items-start gap-3">
                            <input type="checkbox" id="terms" required
                                   class="w-4 h-4 accent-[#1B3A6B] cursor-pointer mt-0.5 flex-shrink-0"/>
                            <label for="terms" class="text-[12.5px] text-gray-500 cursor-pointer leading-relaxed">
                                J'accepte les
                                <a href="#" class="text-[#2D5FA8] font-semibold hover:underline">conditions d'utilisation</a>
                                et la
                                <a href="#" class="text-[#2D5FA8] font-semibold hover:underline">politique de confidentialité</a>
                            </label>
                        </div>

                        {{-- BOUTON --}}
                        <button type="submit"
                                class="w-full bg-[#C8992A] text-white font-black text-[15px] py-3.5
                                       rounded-xl shadow-lg transition-all duration-200
                                       hover:bg-[#b8861e] hover:-translate-y-0.5 hover:shadow-xl
                                       active:translate-y-0 flex items-center justify-center gap-2">
                            ✅ Créer mon compte
                        </button>

                    </form>

                    {{-- SÉPARATEUR --}}
                    <div class="flex items-center gap-3 my-5">
                        <div class="flex-1 h-px bg-gray-200"></div>
                        <span class="text-gray-400 text-[12px] font-medium">déjà inscrit ?</span>
                        <div class="flex-1 h-px bg-gray-200"></div>
                    </div>

                    {{-- LIEN CONNEXION --}}
                    <a href="{{ route('login') }}"
                       class="w-full border-2 border-[#1B3A6B] text-[#1B3A6B] font-bold text-[14px]
                              py-3 rounded-xl transition-all duration-200
                              hover:bg-[#1B3A6B] hover:text-white
                              flex items-center justify-center gap-2">
                        🔑 Se connecter
                    </a>

                </div>
            </div>

            {{-- NOTE --}}
            <p class="text-center text-white/40 text-[12px] mt-5 flex items-center justify-center gap-2">
                🔒 Inscription sécurisée — DschangLost · Ville de Dschang
            </p>

        </div>
    </div>

</body>
</html>