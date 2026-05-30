// ================================================
// carousel.js — Hero Carousel
// DschangLost · Ville de Dschang
// ================================================

document.addEventListener('DOMContentLoaded', function () {

    const slides  = document.querySelectorAll('.carousel-slide');
    const dots    = document.querySelectorAll('.dot');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');

    // Si pas de carousel sur cette page → on arrête
    if (!slides.length) return;

    let current = 0;
    let timer   = null;

    /* ── Aller à un slide ── */
    function goTo(index) {
        // Désactiver ancien slide
        slides[current].style.opacity = '0';
        slides[current].querySelector('.slide-content').style.opacity  = '0';
        slides[current].querySelector('.slide-content').style.transform = 'translateY(24px)';
        dots[current].style.width      = '10px';
        dots[current].style.background = 'rgba(255,255,255,0.4)';

        // Calculer nouveau slide
        current = (index + slides.length) % slides.length;

        // Activer nouveau slide
        slides[current].style.opacity = '1';
        dots[current].style.width      = '28px';
        dots[current].style.background = '#C8992A';

        // Animer le contenu après 400ms
        setTimeout(function () {
            const content = slides[current].querySelector('.slide-content');
            if (content) {
                content.style.opacity   = '1';
                content.style.transform = 'translateY(0)';
            }
        }, 400);
    }

    /* ── Autoplay ── */
    function startAuto() {
        stopAuto();
        timer = setInterval(function () {
            goTo(current + 1);
        }, 5000);
    }

    function stopAuto() {
        if (timer) clearInterval(timer);
    }

    /* ── Boutons flèches ── */
    if (prevBtn) {
        prevBtn.addEventListener('click', function () {
            goTo(current - 1);
            startAuto();
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            goTo(current + 1);
            startAuto();
        });
    }

    /* ── Dots ── */
    dots.forEach(function (dot, i) {
        dot.addEventListener('click', function () {
            goTo(i);
            startAuto();
        });
    });

    /* ── Swipe mobile ── */
    let touchStartX = 0;
    const hero = document.getElementById('hero');

    if (hero) {
        hero.addEventListener('touchstart', function (e) {
            touchStartX = e.touches[0].clientX;
        });

        hero.addEventListener('touchend', function (e) {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 50) {
                diff > 0 ? goTo(current + 1) : goTo(current - 1);
                startAuto();
            }
        });

        /* ── Pause au survol ── */
        hero.addEventListener('mouseenter', stopAuto);
        hero.addEventListener('mouseleave', startAuto);
    }

    /* ── Scroll indicator ── */
    window.addEventListener('scroll', function () {
        const si = document.getElementById('scroll-indicator');
        if (si) {
            si.style.opacity     = window.scrollY > 80 ? '0' : '1';
            si.style.transition  = 'opacity 0.4s';
        }
    });

    /* ── Init ── */
    goTo(0);
    startAuto();

});