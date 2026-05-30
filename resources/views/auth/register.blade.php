<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Inscription — DschangLost</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ===== ANIMATIONS (gardées) ===== */
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInLeft { from { opacity: 0; transform: translateX(-50px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes fadeInRight { from { opacity: 0; transform: translateX(50px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.85); } to { opacity: 1; transform: scale(1); } }
        @keyframes float { 0%,100% { transform: translateY(0px); } 50% { transform: translateY(-12px); } }
        @keyframes glow { 0%,100% { box-shadow: 0 0 20px rgba(45, 95, 168, 0.3); } 50% { box-shadow: 0 0 40px rgba(45, 95, 168, 0.5); } }
        @keyframes slideInUp { from { opacity: 0; transform: translateY(60px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in-up    { animation: fadeInUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; opacity: 0; }
        .animate-fade-in-left  { animation: fadeInLeft 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; opacity: 0; }
        .animate-fade-in-right { animation: fadeInRight 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; opacity: 0; }
        .animate-slide-down    { animation: slideDown 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; opacity: 0; }
        .animate-scale-in      { animation: scaleIn 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; opacity: 0; }
        .animate-float         { animation: float 4s ease-in-out infinite; }
        .animate-glow          { animation: glow 3s ease-in-out infinite; }
        .animate-slide-in-up   { animation: slideInUp 0.9s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; opacity: 0; }
        .delay-100 { animation-delay: 0.1s; } .delay-200 { animation-delay: 0.2s; } .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; } .delay-500 { animation-delay: 0.5s; } .delay-600 { animation-delay: 0.6s; }
        .delay-700 { animation-delay: 0.7s; } .delay-800 { animation-delay: 0.8s; } .delay-900 { animation-delay: 0.9s; }
        .delay-1000 { animation-delay: 1.0s; } .delay-1100 { animation-delay: 1.1s; } .delay-1200 { animation-delay: 1.2s; }
        .input-glow:focus { box-shadow: 0 0 0 4px rgba(45, 95, 168, 0.12), 0 4px 12px rgba(45, 95, 168, 0.15), inset 0 0 0 1px rgba(45, 95, 168, 0.1); }
        .input-group { transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
        .input-group:focus-within { transform: translateY(-2px); }
        .input-group:focus-within label { color: #2D5FA8; transform: scale(0.95); }
        .input-group:focus-within .icon-wrapper { color: #2D5FA8; transform: scale(1.1); }
        .icon-wrapper { transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
        .strength-bar { transition: width 0.5s cubic-bezier(0.34, 1.56, 0.64, 1), background-color 0.5s; }
        .badge-pro { position: relative; overflow: hidden; transition: all 0.4s; }
        .badge-pro:hover { background: rgba(200, 153, 42, 0.2); border-color: rgba(200, 153, 42, 0.4); }
        .btn-shine { position: relative; overflow: hidden; }
        .btn-shine::before { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent); animation: shimmer 3s infinite; }
        @keyframes shimmer { 0% { left: -100%; } 100% { left: 100%; } }
        .pattern-overlay { background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
        body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; }
        .font-display { font-family: 'Playfair Display', Georgia, serif; letter-spacing: -0.02em; }
        .stat-item { transition: all 0.4s; }
        .stat-item:hover { transform: translateY(-4px); }
        .link-premium { position: relative; transition: all 0.3s ease; }
        .link-premium::after { content: ''; position: absolute; bottom: -2px; left: 0; width: 0; height: 2px; background: linear-gradient(90deg, #2D5FA8, #1B3A6B); transition: width 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); }
        .link-premium:hover::after { width: 100%; }
    </style>
</head>

<body class="bg-white">

<div class="flex min-h-screen">

    {{-- PARTIE GAUCHE (image) — inchangée --}}
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('images/connec.jpeg') }}" alt="Dschang" class="w-full h-full object-cover animate-fade-in" loading="lazy"/>
        </div>
        <div class="absolute inset-0 bg-gradient-to-br from-[#1B3A6B]/88 via-[#1B3A6B]/85 to-[#0f2244]/92 backdrop-blur-[1px]"></div>
        <div class="absolute inset-0 pattern-overlay"></div>
        <div class="absolute -bottom-1/2 -right-1/4 w-96 h-96 bg-[#2D5FA8]/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute -top-1/3 -left-1/4 w-80 h-80 bg-[#C8992A]/5 rounded-full blur-3xl animate-float" style="animation-delay: 1s;"></div>
        <div class="relative z-10 flex flex-col justify-between w-full px-12 xl:px-16 py-12">
            <div class="animate-slide-down delay-100">
                <a href="{{ route('home') }}" class="flex items-center gap-3.5 group w-fit">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#C8992A] to-[#e0ad35] rounded-2xl flex items-center justify-center shadow-xl group-hover:shadow-2xl transition-all duration-300 group-hover:scale-110 group-hover:-rotate-6">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1C6.48 1 2 5.48 2 11s4.48 10 10 10 10-4.48 10-10S17.52 1 12 1zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                    </div>
                    <div><span class="text-white font-black text-lg block leading-tight tracking-tight">Objets Égarés</span><span class="text-[#93B8E8] text-xs uppercase tracking-widest font-bold">Dschang</span></div>
                </a>
            </div>
            <div class="flex-1 flex flex-col justify-center">
                <div class="animate-fade-in-left delay-300"><div class="badge-pro inline-flex items-center gap-2.5 bg-white/8 backdrop-blur-md rounded-full px-5 py-2.5 border border-white/15 mb-8 w-fit"><div class="w-2.5 h-2.5 bg-[#C8992A] rounded-full animate-pulse"></div><span class="text-white/85 text-xs font-semibold tracking-wide">Plateforme sécurisée</span></div></div>
                <h2 class="font-display text-white text-5xl xl:text-6xl font-black leading-tight mb-6 animate-fade-in-left delay-400">Rejoignez la<br/><span class="text-transparent bg-clip-text bg-gradient-to-r from-[#C8992A] via-[#e0ad35] to-[#C8992A]">communauté</span></h2>
                <p class="text-white/60 text-base leading-relaxed max-w-md mb-12 animate-fade-in-left delay-500 font-light">Signalez vos objets perdus, trouvez vos affaires égarées et restez connecté avec la communauté de Dschang.</p>
                <div class="flex items-center gap-8 animate-fade-in-up delay-600"><div class="stat-item flex items-baseline gap-2"><div class="text-[#C8992A] font-black text-4xl">500</div><div class="text-[#C8992A] font-black text-2xl">+</div></div><div class="w-px h-12 bg-white/10"></div><div class="stat-item flex items-baseline gap-2"><div class="text-[#C8992A] font-black text-4xl">1.2</div><div class="text-[#C8992A] font-black text-2xl">k</div></div><div class="w-px h-12 bg-white/10"></div><div class="stat-item flex items-baseline gap-2"><div class="text-[#C8992A] font-black text-4xl">98</div><div class="text-[#C8992A] font-black text-2xl">%</div></div></div>
                <div class="flex items-center gap-8 animate-fade-in-up delay-700 text-white/40 text-xs font-semibold uppercase tracking-wide"><div>Objets retrouvés</div><div class="invisible">.</div><div>Utilisateurs</div><div class="invisible">.</div><div>Satisfaction</div></div>
            </div>
            <div class="animate-fade-in-up delay-800 flex items-center gap-3 text-white/30 text-xs font-medium"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg><span>Données chiffrées de bout en bout</span></div>
        </div>
    </div>

    {{-- PARTIE DROITE — FORMULAIRE COMPACT SANS SCROLL --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-gradient-to-br from-[#1B3A6B] to-[#2D5FA8] relative overflow-y-auto lg:overflow-visible min-h-screen lg:min-h-screen">
        <div class="absolute inset-0 overflow-hidden pointer-events-none"><div class="absolute -top-20 -right-20 w-96 h-96 bg-[#2D5FA8]/20 rounded-full blur-3xl animate-float"></div><div class="absolute -bottom-32 -left-32 w-80 h-80 bg-[#C8992A]/10 rounded-full blur-3xl animate-float" style="animation-delay: 1.5s;"></div></div>

        <a href="{{ route('home') }}" class="absolute top-6 right-6 flex items-center gap-2.5 text-white/70 hover:text-white text-sm font-semibold transition-all duration-300 group z-20 animate-slide-down px-4 py-2.5 rounded-xl hover:bg-white/10 backdrop-blur-sm border border-white/10 hover:border-white/20"><svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>Accueil</a>

        <div class="relative z-10 w-full max-w-md px-6 py-6 lg:py-8 sm:px-8"> {{-- Padding réduit pour éviter le scroll --}}
            <div class="flex items-center gap-3 mb-6 lg:hidden animate-fade-in-up delay-100"><div class="w-11 h-11 bg-gradient-to-br from-[#C8992A] to-[#e0ad35] rounded-xl flex items-center justify-center shadow-lg"><svg class="w-5.5 h-5.5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1C6.48 1 2 5.48 2 11s4.48 10 10 10 10-4.48 10-10S17.52 1 12 1zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg></div><div><span class="text-white font-black text-base block leading-tight">Objets Égarés</span><span class="text-[#93B8E8] text-xs uppercase tracking-widest font-bold">Dschang</span></div></div>

            <div class="mb-6 animate-fade-in-up delay-200"> {{-- Réduction de marge --}}
                <h1 class="font-display text-white text-3xl font-black mb-2 leading-tight">Créer un compte</h1>
                <p class="text-white/70 text-sm font-light">Rejoignez notre plateforme en moins d'une minute</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-500/15 border border-red-500/30 rounded-2xl px-4 py-2.5 mb-5 backdrop-blur-sm animate-scale-in">
                    @foreach ($errors->all() as $error)
                        <p class="text-red-200 text-xs flex items-center gap-2 font-medium"><svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4"> {{-- Espacement réduit entre champs --}}
                @csrf

                {{-- NOM COMPLET --}}
                <div class="input-group animate-fade-in-up delay-300">
                    <label class="block text-[10px] font-bold text-white/80 uppercase tracking-widest mb-1.5">Nom complet</label>
                    <div class="relative group">
                        <span class="icon-wrapper absolute left-3 top-1/2 -translate-y-1/2 text-white/40"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></span>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Votre nom complet" class="input-glow w-full pl-9 pr-3 py-2 border-2 border-white/20 rounded-xl text-sm text-white bg-white/10 backdrop-blur-sm outline-none transition-all focus:border-white/40 focus:bg-white/20 placeholder:text-white/40">
                    </div>
                </div>

                {{-- TÉLÉPHONE --}}
                <div class="input-group animate-fade-in-up delay-400">
                    <label class="block text-[10px] font-bold text-white/80 uppercase tracking-widest mb-1.5">Téléphone</label>
                    <div class="relative group">
                        <span class="icon-wrapper absolute left-3 top-1/2 -translate-y-1/2 text-white/40"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 00.948.684l1.498 4.493a1 1 0 00.502.756l2.048 1.029a2.582 2.582 0 102.969 2.969l1.029-2.048a1 1 0 00.756-.502l4.493-1.498a1 1 0 00.684-.948V7a2 2 0 00-2-2h-1C9.716 5 3 5.82 3 10.501V19a2 2 0 002 2h14a2 2 0 002-2v-5"/></svg></span>
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="6XX XXX XXX" class="input-glow w-full pl-9 pr-3 py-2 border-2 border-white/20 rounded-xl text-sm text-white bg-white/10 backdrop-blur-sm outline-none transition-all focus:border-white/40 focus:bg-white/20 placeholder:text-white/40">
                    </div>
                </div>

                {{-- EMAIL --}}
                <div class="input-group animate-fade-in-up delay-500">
                    <label class="block text-[10px] font-bold text-white/80 uppercase tracking-widest mb-1.5">Email</label>
                    <div class="relative group">
                        <span class="icon-wrapper absolute left-3 top-1/2 -translate-y-1/2 text-white/40"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></span>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="exemple@gmail.com" class="input-glow w-full pl-9 pr-3 py-2 border-2 border-white/20 rounded-xl text-sm text-white bg-white/10 backdrop-blur-sm outline-none transition-all focus:border-white/40 focus:bg-white/20 placeholder:text-white/40">
                    </div>
                </div>

                {{-- MOT DE PASSE --}}
                <div class="input-group animate-fade-in-up delay-600">
                    <label class="block text-[10px] font-bold text-white/80 uppercase tracking-widest mb-1.5">Mot de passe</label>
                    <div class="relative group">
                        <span class="icon-wrapper absolute left-3 top-1/2 -translate-y-1/2 text-white/40"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg></span>
                        <input type="password" name="password" id="password" required placeholder="8 caractères min" oninput="checkStrength(this.value)" class="input-glow w-full pl-9 pr-9 py-2 border-2 border-white/20 rounded-xl text-sm text-white bg-white/10 backdrop-blur-sm outline-none transition-all focus:border-white/40 focus:bg-white/20 placeholder:text-white/40">
                        <button type="button" onclick="togglePassword('password', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-white/40 hover:text-white/70"><svg class="w-4 h-4 eye-open" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg><svg class="w-4 h-4 eye-closed hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg></button>
                    </div>
                    <div class="mt-2 flex items-center gap-2"><div class="flex-1 h-1 bg-white/10 rounded-full overflow-hidden"><div id="strength-bar" class="strength-bar h-full rounded-full w-0 bg-white/30"></div></div><span id="strength-text" class="text-[10px] font-bold text-white/50 min-w-[65px] text-right">--</span></div>
                </div>

                {{-- CONFIRMER --}}
                <div class="input-group animate-fade-in-up delay-700">
                    <label class="block text-[10px] font-bold text-white/80 uppercase tracking-widest mb-1.5">Confirmer le mot de passe</label>
                    <div class="relative group">
                        <span class="icon-wrapper absolute left-3 top-1/2 -translate-y-1/2 text-white/40"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></span>
                        <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Répétez le mot de passe" class="input-glow w-full pl-9 pr-9 py-2 border-2 border-white/20 rounded-xl text-sm text-white bg-white/10 backdrop-blur-sm outline-none transition-all focus:border-white/40 focus:bg-white/20 placeholder:text-white/40">
                        <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-white/40 hover:text-white/70"><svg class="w-4 h-4 eye-open" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg><svg class="w-4 h-4 eye-closed hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg></button>
                    </div>
                </div>

                {{-- CONDITIONS --}}
                <div class="flex items-start gap-2 animate-fade-in-up delay-800 pt-1">
                    <input type="checkbox" id="terms" required class="w-4 h-4 accent-[#C8992A] cursor-pointer mt-0.5 flex-shrink-0 rounded border border-white/20 bg-white/10"/>
                    <label for="terms" class="text-xs text-white/70 cursor-pointer leading-relaxed font-light">J'accepte les <a href="#" class="link-premium text-[#C8992A] font-semibold">conditions</a> et la <a href="#" class="link-premium text-[#C8992A] font-semibold">confidentialité</a></label>
                </div>

                {{-- BOUTON --}}
                <button type="submit" class="animate-fade-in-up delay-900 group w-full bg-gradient-to-r from-white via-white/95 to-white text-[#1B3A6B] font-black text-sm py-2.5 rounded-xl shadow-2xl transition-all duration-300 hover:shadow-3xl hover:scale-105 hover:from-[#C8992A] hover:via-[#e0ad35] hover:to-[#C8992A] hover:text-white active:scale-95 flex items-center justify-center gap-2 relative overflow-hidden btn-shine"><span class="relative z-10 flex items-center gap-2 font-black">Créer mon compte <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg></span></button>
            </form>

            <div class="flex items-center gap-4 my-5 animate-fade-in delay-1000"><div class="flex-1 h-px bg-white/15"></div><span class="text-white/50 text-[10px] font-bold uppercase tracking-wider">OU</span><div class="flex-1 h-px bg-white/15"></div></div>

            <a href="{{ route('login') }}" class="animate-fade-in-up delay-1100 group w-full border-2 border-white/30 text-white font-bold text-sm py-2.5 rounded-xl transition-all duration-300 hover:border-white hover:bg-white/10 hover:shadow-lg flex items-center justify-center gap-2"><svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14.5M3 12a9 9 0 1118 0 9 9 0 01-18 0z"/></svg>Se connecter</a>

            <p class="text-center text-white/50 text-[10px] mt-5 flex items-center justify-center gap-1 animate-fade-in delay-1200 font-light"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg><span>Données sécurisées — DschangLost</span></p>
        </div>
    </div>
</div>
    <script src="{{ asset('js/register.js') }}"></script>

</body>
</html>