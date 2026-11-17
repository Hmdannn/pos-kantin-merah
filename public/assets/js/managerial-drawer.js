(() => {
    const drawer = document.getElementById('managerialSidebar');
    const trigger = document.querySelector('.managerial-menu-toggle');
    const closeButton = document.querySelector('.managerial-menu-close');
    const backdrop = document.querySelector('.managerial-nav-backdrop');
    const layout = document.querySelector('.managerial-layout');
    const main = document.querySelector('.managerial-layout > .main');

    if (!drawer || !trigger || !closeButton || !backdrop || !layout || !main) {
        return;
    }

    const mobileQuery = window.matchMedia('(max-width: 860px)');
    const focusableSelector = 'a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])';

    function setDrawerOpen(open, restoreFocus) {
        if (!mobileQuery.matches) {
            open = false;
        }

        drawer.classList.toggle('is-open', open);
        backdrop.classList.toggle('is-open', open);
        layout.classList.toggle('is-nav-open', open);
        trigger.setAttribute('aria-expanded', String(open));
        drawer.setAttribute('aria-hidden', String(!open && mobileQuery.matches));
        drawer.inert = !open && mobileQuery.matches;
        main.inert = open;
        document.body.classList.toggle('managerial-drawer-open', open);

        if (open) {
            closeButton.focus();
        } else if (restoreFocus && mobileQuery.matches) {
            trigger.focus();
        }
    }

    function getFocusableItems() {
        return Array.from(drawer.querySelectorAll(focusableSelector))
            .filter(element => !element.hasAttribute('disabled') && element.getClientRects().length > 0);
    }

    trigger.addEventListener('click', () => {
        setDrawerOpen(!drawer.classList.contains('is-open'), false);
    });

    closeButton.addEventListener('click', () => setDrawerOpen(false, true));
    backdrop.addEventListener('click', () => setDrawerOpen(false, true));

    document.addEventListener('keydown', event => {
        if (!mobileQuery.matches || !drawer.classList.contains('is-open')) {
            return;
        }

        if (event.key === 'Escape') {
            event.preventDefault();
            setDrawerOpen(false, true);
            return;
        }

        if (event.key !== 'Tab') {
            return;
        }

        const focusableItems = getFocusableItems();
        if (!focusableItems.length) {
            event.preventDefault();
            closeButton.focus();
            return;
        }

        const firstItem = focusableItems[0];
        const lastItem = focusableItems[focusableItems.length - 1];

        if (event.shiftKey && document.activeElement === firstItem) {
            event.preventDefault();
            lastItem.focus();
        } else if (!event.shiftKey && document.activeElement === lastItem) {
            event.preventDefault();
            firstItem.focus();
        }
    });

    function syncViewport() {
        const focusWasInDrawer = drawer.contains(document.activeElement);
        drawer.classList.remove('is-open');
        backdrop.classList.remove('is-open');
        layout.classList.remove('is-nav-open');
        trigger.setAttribute('aria-expanded', 'false');
        drawer.setAttribute('aria-hidden', String(mobileQuery.matches));
        drawer.inert = mobileQuery.matches;
        main.inert = false;
        document.body.classList.remove('managerial-drawer-open');

        if (focusWasInDrawer) {
            (mobileQuery.matches ? trigger : drawer.querySelector('a[href]')).focus();
        }
    }

    if (mobileQuery.addEventListener) {
        mobileQuery.addEventListener('change', syncViewport);
    } else {
        mobileQuery.addListener(syncViewport);
    }

    syncViewport();
})();
