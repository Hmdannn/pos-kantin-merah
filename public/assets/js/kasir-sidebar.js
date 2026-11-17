(() => {
    const layout = document.querySelector('.kasir-layout');
    if (!layout) {
        return;
    }

    const menuButton = layout.querySelector('.kasir-menu-toggle');
    const backdrop = layout.querySelector('.kasir-nav-backdrop');

    function setMenuOpen(open) {
        layout.classList.toggle('is-nav-open', open);
        document.body.classList.toggle('kasir-nav-open', open);
        if (menuButton) {
            menuButton.setAttribute('aria-expanded', String(open));
        }
    }

    if (menuButton && backdrop) {
        menuButton.addEventListener('click', () => {
            setMenuOpen(!layout.classList.contains('is-nav-open'));
        });

        backdrop.addEventListener('click', () => setMenuOpen(false));
        layout.querySelectorAll('.kasir-nav-link').forEach(link => {
            link.addEventListener('click', () => setMenuOpen(false));
        });

        document.addEventListener('keydown', event => {
            if (event.key === 'Escape') {
                setMenuOpen(false);
            }
        });
    }
})();
