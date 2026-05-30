// Toggle visibilité mot de passe
function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    const eyeOpen = btn.querySelector('.eye-open');
    const eyeClosed = btn.querySelector('.eye-closed');

    if (input.type === 'password') {
        input.type = 'text';
        eyeOpen.classList.add('hidden');
        eyeClosed.classList.remove('hidden');
    } else {
        input.type = 'password';
        eyeOpen.classList.remove('hidden');
        eyeClosed.classList.add('hidden');
    }
}

// Indicateur de force du mot de passe
function checkStrength(password) {
    const bar = document.getElementById('strength-bar');
    const text = document.getElementById('strength-text');
    let strength = 0;

    if (password.length >= 8) strength++;
    if (password.length >= 12) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;

    const levels = [
        { width: '0%',   color: 'bg-white/30',    label: '--',       textColor: 'text-white/50' },
        { width: '25%',  color: 'bg-red-400/70',  label: 'Faible',   textColor: 'text-red-300' },
        { width: '50%',  color: 'bg-orange-400/70', label: 'Moyen',  textColor: 'text-orange-300' },
        { width: '75%',  color: 'bg-yellow-400/70', label: 'Bon',    textColor: 'text-yellow-300' },
        { width: '90%',  color: 'bg-[#C8992A]',   label: 'Excellent', textColor: 'text-[#C8992A]' },
        { width: '100%', color: 'bg-emerald-400', label: 'Parfait', textColor: 'text-emerald-300' }
    ];

    const level = levels[strength];
    bar.style.width = level.width;
    bar.className = 'strength-bar h-full rounded-full ' + level.color;
    text.textContent = level.label;
    text.className = 'text-xs font-bold min-w-[70px] text-right ' + level.textColor;
}
