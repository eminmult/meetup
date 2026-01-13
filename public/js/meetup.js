// Preloader
window.addEventListener('load', () => {
    setTimeout(() => {
        const preloader = document.querySelector('.preloader');
        if (preloader) {
            preloader.classList.add('loaded');
        }
    }, 1500);
});

// Hero Title Line Coloring (alternating white/red lines)
function initHeroTitleLines() {
    const titles = document.querySelectorAll('.hero-title--lines');

    titles.forEach(title => {
        // Check if already has span children
        const existingSpans = title.querySelectorAll(':scope > span');
        if (existingSpans.length === 0) {
            // No spans - split text into words
            const text = title.textContent.trim();
            const words = text.split(/\s+/);
            title.innerHTML = words.map(word => `<span>${word}</span>`).join(' ');
        }
    });

    function colorTitleLines() {
        const titles = document.querySelectorAll('.hero-title--lines');

        titles.forEach(title => {
            const spans = title.querySelectorAll(':scope > span');
            if (spans.length === 0) return;

            let currentLine = 0;
            let lastTop = spans[0].offsetTop;

            spans.forEach(span => {
                span.classList.remove('line-odd', 'line-even');

                if (span.offsetTop > lastTop) {
                    currentLine++;
                    lastTop = span.offsetTop;
                }

                if (currentLine % 2 === 0) {
                    span.classList.add('line-odd');
                } else {
                    span.classList.add('line-even');
                }
            });
        });
    }

    colorTitleLines();
    window.addEventListener('resize', colorTitleLines);
}

document.addEventListener('DOMContentLoaded', initHeroTitleLines);

// Custom Cursor
const cursor = document.querySelector('.cursor');
const cursorDot = document.querySelector('.cursor-dot');

if (cursor && cursorDot) {
    document.addEventListener('mousemove', (e) => {
        cursor.style.left = e.clientX - 10 + 'px';
        cursor.style.top = e.clientY - 10 + 'px';
        cursorDot.style.left = e.clientX - 3 + 'px';
        cursorDot.style.top = e.clientY - 3 + 'px';
    });

    document.querySelectorAll('a, button').forEach(el => {
        el.addEventListener('mouseenter', () => cursor.classList.add('hover'));
        el.addEventListener('mouseleave', () => cursor.classList.remove('hover'));
    });
}

// Navbar scroll effect
window.addEventListener('scroll', () => {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 100) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Hero Slider
if (typeof Swiper !== 'undefined' && document.querySelector('.hero-slider')) {
    new Swiper('.hero-slider', {
        effect: 'fade',
        fadeEffect: { crossFade: true },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        loop: true,
        speed: 1000,
    });
}

// Portfolio Slider
if (typeof Swiper !== 'undefined' && document.querySelector('.portfolio-slider')) {
    new Swiper('.portfolio-slider', {
        slidesPerView: 1.2,
        spaceBetween: 30,
        centeredSlides: false,
        loop: true,
        navigation: {
            nextEl: '.portfolio-next',
            prevEl: '.portfolio-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2.2,
            },
            1024: {
                slidesPerView: 3.2,
            },
        },
    });
}

// Team Slider
if (typeof Swiper !== 'undefined' && document.querySelector('.team-slider')) {
    new Swiper('.team-slider', {
        slidesPerView: 1.2,
        spaceBetween: 20,
        loop: true,
        navigation: {
            nextEl: '.team-next',
            prevEl: '.team-prev',
        },
        breakpoints: {
            640: {
                slidesPerView: 2.2,
            },
            1024: {
                slidesPerView: 3.5,
            },
            1400: {
                slidesPerView: 4.2,
            },
        },
    });
}

// Testimonials Slider
if (typeof Swiper !== 'undefined' && document.querySelector('.testimonials-slider')) {
    new Swiper('.testimonials-slider', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.testimonials-pagination',
            clickable: true,
        },
    });
}

// Counter Animation
const counters = document.querySelectorAll('.counter');
const speed = 200;

const animateCounter = (counter) => {
    const target = +counter.getAttribute('data-target');
    const count = +counter.innerText;
    const inc = target / speed;

    if (count < target) {
        counter.innerText = Math.ceil(count + inc);
        setTimeout(() => animateCounter(counter), 10);
    } else {
        counter.innerText = target;
    }
};

// Intersection Observer for counters
const observerOptions = {
    threshold: 0.5
};

const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const counters = entry.target.querySelectorAll('.counter');
            counters.forEach(counter => animateCounter(counter));
            counterObserver.unobserve(entry.target);
        }
    });
}, observerOptions);

const statsSection = document.querySelector('.stats');
if (statsSection) {
    counterObserver.observe(statsSection);
}

// Initialize AOS
AOS.init({
    duration: 800,
    easing: 'ease-out-cubic',
    once: true,
    offset: 100,
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Language Switcher (mobile support)
const langSwitcher = document.querySelector('.lang-switcher');
const langCurrent = document.querySelector('.lang-current');

if (langCurrent && langSwitcher) {
    langCurrent.addEventListener('click', (e) => {
        e.stopPropagation();
        langSwitcher.classList.toggle('active');
    });

    document.addEventListener('click', (e) => {
        if (!langSwitcher.contains(e.target)) {
            langSwitcher.classList.remove('active');
        }
    });

    document.querySelectorAll('.lang-option').forEach(option => {
        option.addEventListener('click', () => {
            langSwitcher.classList.remove('active');
        });
    });
}

// Mobile Menu
const menuToggle = document.querySelector('.menu-toggle');
const mobileMenu = document.querySelector('.mobile-menu');
const mobileMenuLinks = document.querySelectorAll('.mobile-menu-links a, .mobile-menu-cta a');

if (menuToggle && mobileMenu) {
    menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('active');
        mobileMenu.classList.toggle('active');
        document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
    });

    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', () => {
            menuToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
            document.body.style.overflow = '';
        });
    });
}

// Form submission
const contactForm = document.querySelector('.contact-form form');
if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
        e.preventDefault();
        alert('Спасибо за заявку! Мы свяжемся с вами в ближайшее время.');
    });
}

// Mobile menu (alternative selector for different page structures)
const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener('click', () => {
        mobileMenuBtn.classList.toggle('active');
        const mobileMenu = document.querySelector('.mobile-menu');
        if (mobileMenu) {
            mobileMenu.classList.toggle('active');
            document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
        }
    });

    document.querySelectorAll('.mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenuBtn.classList.remove('active');
            const mobileMenu = document.querySelector('.mobile-menu');
            if (mobileMenu) {
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });
}

// FAQ Accordion
document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
        const item = button.parentElement;
        const isActive = item.classList.contains('active');

        // Close all items
        document.querySelectorAll('.faq-item').forEach(faq => {
            faq.classList.remove('active');
        });

        // Open clicked item if it wasn't active
        if (!isActive) {
            item.classList.add('active');
        }
    });
});

// Video Modal
const videoPlayBtn = document.querySelector('.video-play-btn');
const videoModal = document.querySelector('.video-modal');
const videoModalClose = document.querySelector('.video-modal-close');

if (videoPlayBtn && videoModal) {
    videoPlayBtn.addEventListener('click', () => {
        videoModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    });
}

if (videoModalClose && videoModal) {
    videoModalClose.addEventListener('click', () => {
        videoModal.classList.remove('active');
        document.body.style.overflow = '';
        const iframe = videoModal.querySelector('iframe');
        if (iframe) {
            iframe.src = iframe.src; // Reset video
        }
    });
}

if (videoModal) {
    videoModal.addEventListener('click', (e) => {
        if (e.target === videoModal) {
            videoModal.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
}

// Lightbox Gallery
const lightbox = document.querySelector('.lightbox');
const lightboxImg = lightbox ? lightbox.querySelector('img') : null;
const lightboxClose = document.querySelector('.lightbox-close');
const lightboxPrev = document.querySelector('.lightbox-prev');
const lightboxNext = document.querySelector('.lightbox-next');
let currentImageIndex = 0;
let galleryImages = [];

// Initialize gallery items
document.querySelectorAll('.gallery-item').forEach((item, index) => {
    const img = item.querySelector('img');
    if (img) {
        galleryImages.push(img.src);
        item.addEventListener('click', () => {
            currentImageIndex = index;
            openLightbox(img.src);
        });
    }
});

function openLightbox(src) {
    if (lightbox && lightboxImg) {
        lightboxImg.src = src;
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeLightbox() {
    if (lightbox) {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }
}

if (lightboxClose) {
    lightboxClose.addEventListener('click', closeLightbox);
}

if (lightbox) {
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });
}

if (lightboxPrev) {
    lightboxPrev.addEventListener('click', () => {
        currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
        if (lightboxImg) lightboxImg.src = galleryImages[currentImageIndex];
    });
}

if (lightboxNext) {
    lightboxNext.addEventListener('click', () => {
        currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
        if (lightboxImg) lightboxImg.src = galleryImages[currentImageIndex];
    });
}

// Keyboard navigation for lightbox
document.addEventListener('keydown', (e) => {
    if (lightbox && lightbox.classList.contains('active')) {
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft' && lightboxPrev) lightboxPrev.click();
        if (e.key === 'ArrowRight' && lightboxNext) lightboxNext.click();
    }
});
