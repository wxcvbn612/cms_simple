/*
 * CMS Simple — Shared landing page interactions (LTR + RTL)
 * Imported by app.js and app_rtl.js
 */

document.addEventListener('DOMContentLoaded', () => {

    /* ---------------------------------------------------------
       1. SCROLL ANIMATIONS (IntersectionObserver)
       --------------------------------------------------------- */
    const animatedElements = document.querySelectorAll('.animate-on-scroll');

    if (animatedElements.length > 0 && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
        );
        animatedElements.forEach((el) => observer.observe(el));
    } else {
        animatedElements.forEach((el) => el.classList.add('is-visible'));
    }

    /* ---------------------------------------------------------
       2. NAVBAR SCROLL EFFECT (shrink + shadow)
       --------------------------------------------------------- */
    const navbar = document.querySelector('.navbar');

    if (navbar) {
        const onScroll = () => {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    /* ---------------------------------------------------------
       3. NAVBAR ACTIVE LINK (scroll spy)
       Handles both pure anchors (#id) and same-page full URLs (/fr/#id)
       --------------------------------------------------------- */
    const navLinks = document.querySelectorAll('.navbar .nav-link[href*="#"]');
    const sections = [];

    navLinks.forEach((link) => {
        const href = link.getAttribute('href');
        const hashIndex = href.indexOf('#');
        if (hashIndex === -1) return;

        // Skip links that point to a different page
        const isAnchorOnly = href.startsWith('#');
        const isSamePage =
            !isAnchorOnly &&
            link.origin === window.location.origin &&
            link.pathname === window.location.pathname;

        if (!isAnchorOnly && !isSamePage) return;

        const id = href.substring(hashIndex + 1);
        if (!id) return;
        const section = document.getElementById(id);
        if (section) sections.push({ link, section });
    });

    if (sections.length > 0) {
        const highlightNav = () => {
            const scrollPos = window.scrollY + 120;
            let current = null;

            sections.forEach(({ link, section }) => {
                if (section.offsetTop <= scrollPos) {
                    current = link;
                }
                link.classList.remove('active');
            });

            if (current) current.classList.add('active');
        };

        window.addEventListener('scroll', highlightNav, { passive: true });
        highlightNav();
    }

    /* ---------------------------------------------------------
       4. SCROLL-TO-TOP BUTTON
       aria-label auto-detected from document direction
       --------------------------------------------------------- */
    const scrollBtn = document.createElement('button');
    scrollBtn.className = 'scroll-to-top';
    scrollBtn.setAttribute(
        'aria-label',
        document.documentElement.dir === 'rtl' ? 'العودة إلى الأعلى' : 'Retour en haut'
    );
    scrollBtn.innerHTML = '<i class="bi bi-chevron-up"></i>';
    document.body.appendChild(scrollBtn);

    const toggleScrollBtn = () => {
        scrollBtn.classList.toggle('visible', window.scrollY > 400);
    };

    window.addEventListener('scroll', toggleScrollBtn, { passive: true });
    toggleScrollBtn();

    scrollBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    /* ---------------------------------------------------------
       5. SMOOTH SCROLL FOR ANCHOR LINKS
       Handles both pure anchors (#id) and same-page full URLs (/fr/#id)
       --------------------------------------------------------- */
    document.querySelectorAll('a[href*="#"]').forEach((anchor) => {
        anchor.addEventListener('click', (e) => {
            const href = anchor.getAttribute('href');
            const hashIndex = href.indexOf('#');
            if (hashIndex === -1) return;

            // Skip links that point to a different page
            const isAnchorOnly = href.startsWith('#');
            const isSamePage =
                !isAnchorOnly &&
                anchor.origin === window.location.origin &&
                anchor.pathname === window.location.pathname;

            if (!isAnchorOnly && !isSamePage) return;

            const targetId = href.substring(hashIndex);
            if (targetId === '#') return;

            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });

                // Close mobile navbar if open
                const navCollapse = document.querySelector('.navbar-collapse.show');
                if (navCollapse) {
                    const bsCollapse = window.bootstrap.Collapse.getInstance(navCollapse);
                    if (bsCollapse) bsCollapse.hide();
                }
            }
        });
    });
});