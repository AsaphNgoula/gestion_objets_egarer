// ================================================
// navbar.js — Menu utilisateur + Hamburger mobile
// DschangLost · Ville de Dschang
// ================================================

document.addEventListener('DOMContentLoaded', function () {

    // ── Dropdown utilisateur ──
    const btn      = document.getElementById('user-menu-btn');
    const dropdown = document.getElementById('user-dropdown');

    if (btn && dropdown) {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function () {
            dropdown.classList.add('hidden');
        });
    }

    // ── Hamburger mobile ──
    const hamburger   = document.getElementById('hamburger');
    const mobileMenu  = document.getElementById('mobile-menu');

    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', function (e) {
            e.stopPropagation();
            mobileMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function (e) {
            const navbar = document.querySelector('nav');
            if (navbar && !navbar.contains(e.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    }

});