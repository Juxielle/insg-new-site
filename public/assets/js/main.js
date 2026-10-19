/**
 * UNIVERSITÉ JEAN MOULIN LYON 3 - MAIN JAVASCRIPT
 * Standalone, modern, vanilla JavaScript interactions.
 * Fully responsive: desktop mega-menus, mobile off-canvas drawer, hero carousel, dropdowns, back-to-top.
 */

document.addEventListener('DOMContentLoaded', function () {
    // 1. Safe mocks for CMS global variables
    window.orejime = window.orejime || {
        show: function () {},
        hide: function () {},
        isInitialized: true
    };

    // 2. Initialize Header Dropdowns (Accès directs, Vous êtes, Langues, Recherche)
    initHeaderToggles();

    // 3. Initialize Main Navigation & Mega-Menus (Desktop & Mobile)
    initMegaMenu();

    // 4. Initialize Mobile Navigation Drawer & Accordion
    initMobileDrawer();

    // 5. Initialize Hero Carousel
    initHeroCarousel();

    // 6. Initialize Back to Top Button
    initBackToTop();

    // 7. Initialize Secondary Navigation (#menu_secondaire)
    initSecondaryMenu();

    // 8. Initialize Fiche Actions & Share Popover (#actions-fiche)
    initFicheActions();

    // 9. Initialize Objets List Formatting (matching Lyon 3 scriptsFo formaterListe)
    initObjetsList();

    // 10. Initialize CKEditor Accordions (matching Lyon 3 scriptsFo)
    initCkeditorAccordions();
    initFlexslider();
});

/**
 * Header Dropdown Toggles (Accès directs: UFR, Disciplines, Outils; Profil; Version)
 */
function initHeaderToggles() {
    // Only target topbar dropdowns (not main navigation which is handled in initMegaMenu)
    const toggleButtons = document.querySelectorAll('.header_col2__ligne1 [data-toggle^="[data-toggle-id="]');

    toggleButtons.forEach(btn => {
        const toggleAttr = btn.getAttribute('data-toggle');
        const targetIdMatch = toggleAttr.match(/data-toggle-id=['"]([^'"]+)['"]/);
        if (!targetIdMatch) return;

        const targetId = targetIdMatch[1];
        const targetEl = document.querySelector(`[data-toggle-id="${targetId}"]`) || document.getElementById(targetId);
        if (!targetEl) return;

        const parentContainer = btn.closest('li, div.header_toogle');
        let hoverTimeout;

        const openDropdown = () => {
            if (window.innerWidth >= 800) {
                clearTimeout(hoverTimeout);
                closeAllHeaderDropdowns();
                closeAllMegaMenus();
                btn.classList.add('active');
                targetEl.classList.add('active');
                if (parentContainer) parentContainer.classList.add('open');
                btn.setAttribute('aria-expanded', 'true');
            }
        };

        const closeDropdown = () => {
            if (window.innerWidth >= 800) {
                hoverTimeout = setTimeout(() => {
                    btn.classList.remove('active');
                    targetEl.classList.remove('active');
                    if (parentContainer) parentContainer.classList.remove('open');
                    btn.setAttribute('aria-expanded', 'false');
                }, 200);
            }
        };

        // Desktop Hover triggers
        btn.addEventListener('mouseenter', openDropdown);
        btn.addEventListener('mouseleave', closeDropdown);
        targetEl.addEventListener('mouseenter', () => clearTimeout(hoverTimeout));
        targetEl.addEventListener('mouseleave', closeDropdown);

        // Click triggers (for touch and accessibility)
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const isCurrentlyActive = targetEl.classList.contains('active');
            closeAllHeaderDropdowns();
            closeAllMegaMenus();

            if (!isCurrentlyActive) {
                btn.classList.add('active');
                targetEl.classList.add('active');
                if (parentContainer) parentContainer.classList.add('open');
                btn.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // Close on click outside
    document.addEventListener('click', function (e) {
        if (!e.target.closest('header')) {
            closeAllHeaderDropdowns();
            closeAllMegaMenus();
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeAllHeaderDropdowns();
            closeAllMegaMenus();
        }
    });
}

function closeAllHeaderDropdowns() {
    document.querySelectorAll('.header_col2__ligne1 [data-toggle-id]').forEach(el => {
        el.classList.remove('active');
    });
    document.querySelectorAll('.header_col2__ligne1 .header_toogle__libelle.active, .header_col2__ligne1 .header_lien.active').forEach(btn => {
        btn.classList.remove('active');
        btn.setAttribute('aria-expanded', 'false');
    });
    document.querySelectorAll('.header_col2__ligne1 .header_toogle.open, .header_col2__ligne1 li.open').forEach(el => {
        el.classList.remove('open');
    });
}

/**
 * Desktop Mega-Menu Hover and Click Interactions
 */
function initMegaMenu() {
    const menuItems = document.querySelectorAll('#menu_principal > li');

    menuItems.forEach(item => {
        const button = item.querySelector('button.libelle, a.libelle, button, a');
        const megaMenu = item.querySelector('.menu__level');

        if (!button || !megaMenu) return;

        let hoverTimeout;

        // Desktop hover behavior
        item.addEventListener('mouseenter', function () {
            if (window.innerWidth >= 800) {
                clearTimeout(hoverTimeout);
                closeAllHeaderDropdowns();
                closeAllMegaMenus();
                item.classList.add('open');
                button.classList.add('active');
                megaMenu.classList.add('active');
            }
        });

        item.addEventListener('mouseleave', function () {
            if (window.innerWidth >= 800) {
                hoverTimeout = setTimeout(() => {
                    item.classList.remove('open');
                    button.classList.remove('active');
                    megaMenu.classList.remove('active');
                }, 150);
            }
        });

        megaMenu.addEventListener('mouseenter', function () {
            clearTimeout(hoverTimeout);
        });

        // Click behavior for accessibility and touch devices
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const isOpen = megaMenu.classList.contains('active');

            if (window.innerWidth >= 800) {
                closeAllHeaderDropdowns();
                closeAllMegaMenus();
                if (!isOpen) {
                    item.classList.add('open');
                    button.classList.add('active');
                    megaMenu.classList.add('active');
                }
            } else {
                // Mobile accordion toggle
                item.classList.toggle('open');
                megaMenu.classList.toggle('active');
            }
        });
    });

    // Close mega menus when clicking outside
    document.addEventListener('click', function (e) {
        if (!e.target.closest('#menu_principal')) {
            closeAllMegaMenus();
        }
    });
}

function closeAllMegaMenus() {
    document.querySelectorAll('#menu_principal > li').forEach(item => {
        item.classList.remove('open');
        const btn = item.querySelector('button.libelle, a.libelle, button, a');
        if (btn) btn.classList.remove('active');
        const menu = item.querySelector('.menu__level');
        if (menu) menu.classList.remove('active');
    });
}

/**
 * Mobile Navigation Drawer & Hamburger Toggle
 */
function initMobileDrawer() {
    const menuToggle = document.querySelector('.menu__toggle');
    const menuOverlay = document.querySelector('.menu__overlay') || createOverlay();
    const body = document.body;

    if (menuToggle) {
        menuToggle.addEventListener('click', function (e) {
            e.preventDefault();
            body.classList.toggle('show-menu');
            const expanded = body.classList.contains('show-menu');
            menuToggle.setAttribute('aria-expanded', expanded);
        });
    }

    if (menuOverlay) {
        menuOverlay.addEventListener('click', function () {
            body.classList.remove('show-menu');
            if (menuToggle) menuToggle.setAttribute('aria-expanded', 'false');
        });
    }

    // Mobile accordion toggler clicks for #menu_principal
    const mobileTogglers = document.querySelectorAll('#menu_principal .toggler');
    mobileTogglers.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const parentLi = btn.closest('li');
            btn.classList.toggle('active');
            if (parentLi) parentLi.classList.toggle('open');

            const toggleSelector = btn.getAttribute('data-toggle');
            if (toggleSelector) {
                try {
                    const target = document.querySelector(toggleSelector);
                    if (target) {
                        target.classList.toggle('active');
                    }
                } catch (err) {}
            } else {
                const siblingMenu = parentLi ? parentLi.querySelector('.menu__level') : null;
                if (siblingMenu) siblingMenu.classList.toggle('active');
            }
        });
    });
}

function createOverlay() {
    let overlay = document.querySelector('.menu__overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'menu__overlay';
        document.body.appendChild(overlay);
    }
    return overlay;
}

/**
 * Hero Banner Carousel (.carousellyon3Card)
 */
function initHeroCarousel() {
    const card = document.querySelector('.ficheaccueil .carousellyon3Card');
    if (!card) return;
    if (card.dataset.carouselInit) return;
    card.dataset.carouselInit = 'true';

    const carouselWrapper = card.querySelector('.carousellyon3Card_wrapper');
    if (!carouselWrapper) return;

    const slides = carouselWrapper.querySelectorAll('.carousellyon3__item__wrapper');
    if (slides.length === 0) return;

    let currentIndex = 0;
    slides.forEach((s, idx) => {
        if (s.classList.contains('active')) currentIndex = idx;
    });

    const intervalDuration = 6000; // 6 seconds per slide
    let timer = null;

    // Ensure initial slide is active
    slides.forEach((s, idx) => {
        if (idx === currentIndex) s.classList.add('active');
        else s.classList.remove('active');
    });

    // Remove legacy owl controls if present in DOM
    const legacyOwlControls = carouselWrapper.querySelectorAll('.owl-controls, .owl-nav, .nav_containter');
    legacyOwlControls.forEach(el => el.remove());

    // Create Navigation Arrows
    const navArrows = document.createElement('div');
    navArrows.className = 'carousel-nav-arrows';

    const prevBtn = document.createElement('div');
    prevBtn.className = 'carousel-btn-prev';
    prevBtn.setAttribute('aria-label', 'Précédent');
    prevBtn.setAttribute('role', 'button');
    prevBtn.setAttribute('tabindex', '0');
    prevBtn.innerHTML = '‹';

    const nextBtn = document.createElement('div');
    nextBtn.className = 'carousel-btn-next';
    nextBtn.setAttribute('aria-label', 'Suivant');
    nextBtn.setAttribute('role', 'button');
    nextBtn.setAttribute('tabindex', '0');
    nextBtn.innerHTML = '›';

    navArrows.appendChild(prevBtn);
    navArrows.appendChild(nextBtn);
    carouselWrapper.appendChild(navArrows);

    // Create Navigation Dots
    const dotsContainer = document.createElement('div');
    dotsContainer.className = 'carousel-dots-container';

    slides.forEach((_, idx) => {
        const dot = document.createElement('span');
        dot.className = `carousel-dot ${idx === currentIndex ? 'active' : ''}`;
        dot.setAttribute('aria-label', `Diapositive ${idx + 1}`);
        dot.setAttribute('role', 'button');
        dot.setAttribute('tabindex', '0');
        dot.addEventListener('click', (e) => {
            e.preventDefault();
            goToSlide(idx);
            resetTimer();
        });
        dotsContainer.appendChild(dot);
    });

    carouselWrapper.appendChild(dotsContainer);

    function goToSlide(index) {
        if (index === currentIndex) return;
        const previousIndex = currentIndex;
        currentIndex = (index + slides.length) % slides.length;

        slides[currentIndex].classList.add('active');
        slides[previousIndex].classList.remove('active');

        const dots = dotsContainer.querySelectorAll('.carousel-dot');
        if (dots[previousIndex]) dots[previousIndex].classList.remove('active');
        if (dots[currentIndex]) dots[currentIndex].classList.add('active');
    }

    function nextSlide() {
        goToSlide(currentIndex + 1);
    }

    function prevSlide() {
        goToSlide(currentIndex - 1);
    }

    const handlePrev = (e) => {
        e.preventDefault();
        prevSlide();
        resetTimer();
    };
    const handleNext = (e) => {
        e.preventDefault();
        nextSlide();
        resetTimer();
    };

    prevBtn.addEventListener('click', handlePrev);
    prevBtn.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') handlePrev(e);
    });

    nextBtn.addEventListener('click', handleNext);
    nextBtn.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') handleNext(e);
    });

    function startTimer() {
        if (timer) clearInterval(timer);
        timer = setInterval(nextSlide, intervalDuration);
    }

    function resetTimer() {
        if (timer) clearInterval(timer);
        startTimer();
    }

    carouselWrapper.addEventListener('mouseenter', () => clearInterval(timer));
    carouselWrapper.addEventListener('mouseleave', () => startTimer());

    startTimer();
}

/**
 * Back to Top Floating Button
 */
function initBackToTop() {
    const backToTopBtn = document.querySelector('#retour_haut_page a');
    if (!backToTopBtn) return;

    window.addEventListener('scroll', function () {
        if (window.scrollY > 350) {
            backToTopBtn.classList.add('visible');
        } else {
            backToTopBtn.classList.remove('visible');
        }
    });

    backToTopBtn.addEventListener('click', function (e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

/**
 * Secondary Navigation Sidebar Menu (#menu_secondaire)
 */
function initSecondaryMenu() {
    const toggleBtn = document.querySelector('#menu_secondaire .toggle__menu_secondaire');
    const menuList = document.querySelector('#menu_secondaire [data-toggle-id="menusecondaire"], #menu_secondaire .menu_toggle__menu');

    if (!toggleBtn || !menuList) return;

    toggleBtn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        const isOpen = menuList.classList.contains('active');
        if (isOpen) {
            menuList.classList.remove('active');
            toggleBtn.classList.remove('active');
        } else {
            menuList.classList.add('active');
            toggleBtn.classList.add('active');
        }
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('#menu_secondaire')) {
            menuList.classList.remove('active');
            toggleBtn.classList.remove('active');
        }
    });
}

/**
 * Share & Actions popover on subpages (#actions-fiche)
 */
function initFicheActions() {
    const shareBtns = document.querySelectorAll('.actions-fiche .plier-deplier__bouton');

    shareBtns.forEach(btn => {
        const popover = btn.closest('.plier-deplier').querySelector('.plier-deplier__contenu');
        if (!popover) return;

        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const isClosed = popover.classList.contains('plier-deplier__contenu--clos');
            if (isClosed) {
                popover.classList.remove('plier-deplier__contenu--clos');
                popover.classList.add('plier-deplier__contenu--ouvert');
                btn.setAttribute('aria-expanded', 'true');
            } else {
                popover.classList.remove('plier-deplier__contenu--ouvert');
                popover.classList.add('plier-deplier__contenu--clos');
                btn.setAttribute('aria-expanded', 'false');
            }
        });
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.plier-deplier')) {
            document.querySelectorAll('.actions-fiche .plier-deplier__contenu--ouvert').forEach(el => {
                el.classList.remove('plier-deplier__contenu--ouvert');
                el.classList.add('plier-deplier__contenu--clos');
            });
            document.querySelectorAll('.actions-fiche .plier-deplier__bouton[aria-expanded="true"]').forEach(b => {
                b.setAttribute('aria-expanded', 'false');
            });
        }
    });
}

/**
 * 9. Objets List Formatting (matching Lyon 3 scriptsFo formaterListe)
 * Moves vignette_deco inside vignette_deco2 after strong and wraps title in span
 */
function initObjetsList() {
    document.querySelectorAll('.objets .vignette_deco').forEach(function (deco) {
        if (deco.tagName.toLowerCase() === 'a') return;
        const liParent = deco.closest('li');
        if (!liParent) return;
        const strong = liParent.querySelector('strong');
        const strongLink = liParent.querySelector('strong a');
        const itemLinkUrl = strongLink ? (strongLink.getAttribute('href') || '#') : '#';
        const img = deco.querySelector('img');
        const vignetteSrc = img ? (img.getAttribute('src') || '') : '';

        deco.remove();

        if (strong) {
            const a = document.createElement('a');
            a.className = deco.className;
            a.href = itemLinkUrl;
            const span = document.createElement('span');
            if (vignetteSrc) {
                span.style.backgroundImage = 'url(' + vignetteSrc + ')';
            }
            a.appendChild(span);
            strong.insertAdjacentElement('afterend', a);
        }
    });

    document.querySelectorAll('.objets .vignette_deco2').forEach(function (deco2) {
        const link = deco2.querySelector('strong a');
        if (link && !link.querySelector('span')) {
            const span = document.createElement('span');
            while (link.firstChild) {
                span.appendChild(link.firstChild);
            }
            link.appendChild(span);
        }
    });
}

/**
 * 10. CKEditor Accordions (matching Lyon 3 scriptsFo)
 * Transforms <dl class="ckeditor-accordion"> into interactive accessible accordions
 */
function initCkeditorAccordions() {
    document.querySelectorAll('.ckeditor-accordion').forEach(function (accordion) {
        const dts = accordion.querySelectorAll(':scope > dt');
        dts.forEach(function (dt) {
            const dd = dt.nextElementSibling;
            if (!dd || dd.tagName.toLowerCase() !== 'dd') return;

            dt.classList.add('accordion_toggler');
            dd.classList.add('accordion_wrapper');

            if (!dt.querySelector('.accordion_toggler__btn')) {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'accordion_toggler__btn';
                btn.setAttribute('aria-expanded', 'false');
                while (dt.firstChild) {
                    btn.appendChild(dt.firstChild);
                }
                dt.appendChild(btn);

                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const isActive = dt.classList.contains('active');
                    if (isActive) {
                        dt.classList.remove('active');
                        dd.classList.remove('active');
                        btn.setAttribute('aria-expanded', 'false');
                    } else {
                        dt.classList.add('active');
                        dd.classList.add('active');
                        btn.setAttribute('aria-expanded', 'true');
                    }
                });
            }
        });
    });
}


/**
 * 11. Initialize Flexslider for Laboratories & Research Pages
 */
function initFlexslider() {
    const sliders = document.querySelectorAll('.flexslider');
    sliders.forEach(slider => {
        const slides = slider.querySelectorAll('.slides > li');
        if (slides.length === 0) return;

        let currentIndex = 0;
        slides.forEach((s, idx) => {
            if (idx === 0) {
                s.classList.add('active');
            } else {
                s.classList.remove('active');
            }
        });

        if (slides.length > 1) {
            // Build dots
            const dotsList = document.createElement('ul');
            dotsList.className = 'flexslider-dots';
            slides.forEach((_, idx) => {
                const dot = document.createElement('li');
                if (idx === 0) dot.classList.add('active');
                dot.addEventListener('click', () => {
                    goToSlide(idx);
                });
                dotsList.appendChild(dot);
            });
            slider.appendChild(dotsList);

            function goToSlide(idx) {
                slides[currentIndex].classList.remove('active');
                dotsList.children[currentIndex]?.classList.remove('active');
                currentIndex = (idx + slides.length) % slides.length;
                slides[currentIndex].classList.add('active');
                dotsList.children[currentIndex]?.classList.add('active');
            }

            let timer = setInterval(() => {
                goToSlide(currentIndex + 1);
            }, 6000);

            slider.addEventListener('mouseenter', () => clearInterval(timer));
            slider.addEventListener('mouseleave', () => {
                clearInterval(timer);
                timer = setInterval(() => goToSlide(currentIndex + 1), 6000);
            });
        }
    });
}
