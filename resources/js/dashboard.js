// resources/js/dashboard.js
// Animation des compteurs (version vanilla si vous n'utilisez pas Alpine)
// Ici on peut laisser la logique Alpine dans la vue, mais pour plus de modularité,
// on peut déporter certaines fonctions.

export function initDashboardCounters() {
    const counters = document.querySelectorAll('.stat-number');
    counters.forEach(counter => {
        const target = parseInt(counter.dataset.target);
        const duration = 1000;
        let start = 0;
        const step = (timestamp) => {
            if (!start) start = timestamp;
            const progress = Math.min((timestamp - start) / duration, 1);
            counter.innerText = Math.floor(progress * target);
            if (progress < 1) requestAnimationFrame(step);
            else counter.innerText = target;
        };
        requestAnimationFrame(step);
    });
}

// Auto-execution si nécessaire
if (document.querySelector('.stat-number')) {
    window.addEventListener('load', initDashboardCounters);
}