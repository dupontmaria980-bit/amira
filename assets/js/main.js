/**
 * Main JavaScript File
 * Humanitarian Platform 2026
 */

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', () => {
    // Initialize all modules
    LoadingScreen.init();
    Navigation.init();
    Animations.init();
    ScrollEffects.init();
    Counters.init();
    ToastNotifications.init();
    Forms.init();
    VideoPlayer.init();
});

/**
 * Loading Screen Module
 */
const LoadingScreen = {
    init() {
        window.addEventListener('load', () => {
            const loadingScreen = document.getElementById('loading-screen');
            if (loadingScreen) {
                setTimeout(() => {
                    loadingScreen.style.opacity = '0';
                    setTimeout(() => {
                        loadingScreen.style.display = 'none';
                    }, 500);
                }, 800);
            }
        });
    }
};

/**
 * Navigation Module
 */
const Navigation = {
    init() {
        this.navbar = document.getElementById('navbar');
        this.mobileMenuBtn = document.getElementById('mobile-menu-btn');
        this.mobileMenu = document.getElementById('mobile-menu');
        
        if (!this.navbar) return;
        
        this.bindEvents();
        this.handleScroll();
    },
    
    bindEvents() {
        window.addEventListener('scroll', () => this.handleScroll());
        
        if (this.mobileMenuBtn && this.mobileMenu) {
            this.mobileMenuBtn.addEventListener('click', () => this.toggleMobileMenu());
        }
        
        // Close mobile menu on link click
        const mobileLinks = this.mobileMenu?.querySelectorAll('a');
        mobileLinks?.forEach(link => {
            link.addEventListener('click', () => this.closeMobileMenu());
        });
    },
    
    handleScroll() {
        const scrolled = window.scrollY > 50;
        this.navbar.classList.toggle('navbar-scrolled', scrolled);
    },
    
    toggleMobileMenu() {
        this.mobileMenu.classList.toggle('hidden');
    },
    
    closeMobileMenu() {
        this.mobileMenu?.classList.add('hidden');
    }
};

/**
 * GSAP Animations Module
 */
const Animations = {
    init() {
        if (typeof gsap === 'undefined') return;
        
        gsap.registerPlugin(ScrollTrigger);
        
        this.revealElements();
        this.heroAnimations();
        this.parallaxEffects();
    },
    
    revealElements() {
        const reveals = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
        
        reveals.forEach(element => {
            ScrollTrigger.create({
                trigger: element,
                start: 'top 85%',
                onEnter: () => element.classList.add('active'),
                once: true
            });
        });
    },
    
    heroAnimations() {
        const heroTitle = document.querySelector('.hero-title');
        const heroSubtitle = document.querySelector('.hero-subtitle');
        const heroCTA = document.querySelector('.hero-cta');
        
        if (heroTitle) {
            gsap.fromTo(heroTitle, 
                { opacity: 0, y: 50 },
                { opacity: 1, y: 0, duration: 1, delay: 0.5, ease: 'power3.out' }
            );
        }
        
        if (heroSubtitle) {
            gsap.fromTo(heroSubtitle,
                { opacity: 0, y: 30 },
                { opacity: 1, y: 0, duration: 1, delay: 0.7, ease: 'power3.out' }
            );
        }
        
        if (heroCTA) {
            gsap.fromTo(heroCTA,
                { opacity: 0, scale: 0.9 },
                { opacity: 1, scale: 1, duration: 0.8, delay: 0.9, ease: 'back.out(1.7)' }
            );
        }
    },
    
    parallaxEffects() {
        const parallaxElements = document.querySelectorAll('[data-parallax]');
        
        parallaxElements.forEach(element => {
            const speed = element.dataset.parallax || 0.5;
            
            ScrollTrigger.create({
                trigger: element,
                start: 'top bottom',
                end: 'bottom top',
                onUpdate: (self) => {
                    const yPos = self.progress * window.innerHeight * speed;
                    element.style.transform = `translateY(${yPos}px)`;
                }
            });
        });
    }
};

/**
 * Scroll Effects Module
 */
const ScrollEffects = {
    init() {
        this.smoothScroll();
        this.activeNavLinks();
    },
    
    smoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') return;
                
                e.preventDefault();
                const target = document.querySelector(href);
                
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    },
    
    activeNavLinks() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        
        window.addEventListener('scroll', () => {
            let current = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                const sectionHeight = section.offsetHeight;
                
                if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('text-primary-400');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('text-primary-400');
                }
            });
        });
    }
};

/**
 * Counter Animation Module
 */
const Counters = {
    init() {
        const counters = document.querySelectorAll('[data-counter]');
        
        if (counters.length === 0) return;
        
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        counters.forEach(counter => observer.observe(counter));
    },
    
    animateCounter(element) {
        const target = parseInt(element.dataset.counter);
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;
        
        const timer = setInterval(() => {
            current += step;
            
            if (current >= target) {
                element.textContent = this.formatNumber(target);
                clearInterval(timer);
            } else {
                element.textContent = this.formatNumber(Math.floor(current));
            }
        }, 16);
    },
    
    formatNumber(num) {
        if (num >= 1000000) {
            return (num / 1000000).toFixed(1) + 'M';
        } else if (num >= 1000) {
            return num.toLocaleString('fr-FR');
        }
        return num.toString();
    }
};

/**
 * Toast Notifications Module
 */
const ToastNotifications = {
    container: null,
    
    init() {
        this.container = document.getElementById('toast-container');
    },
    
    show(message, type = 'info', duration = 5000) {
        if (!this.container) {
            this.container = document.createElement('div');
            this.container.id = 'toast-container';
            this.container.className = 'fixed bottom-4 right-4 z-[100] space-y-2';
            document.body.appendChild(this.container);
        }
        
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.innerHTML = `
            <div class="flex items-center space-x-3">
                ${this.getIcon(type)}
                <span class="text-sm font-medium">${message}</span>
            </div>
        `;
        
        this.container.appendChild(toast);
        
        setTimeout(() => {
            toast.style.animation = 'slideInRight 0.3s ease-out reverse forwards';
            setTimeout(() => toast.remove(), 300);
        }, duration);
    },
    
    getIcon(type) {
        const icons = {
            success: '<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>',
            error: '<svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>',
            warning: '<svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
            info: '<svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
        };
        return icons[type] || icons.info;
    }
};

/**
 * Forms Module
 */
const Forms = {
    init() {
        this.initMultiStepForms();
        this.initFormValidation();
        this.initFileUpload();
    },
    
    initMultiStepForms() {
        const multiStepForms = document.querySelectorAll('[data-multistep]');
        
        multiStepForms.forEach(form => {
            const steps = form.querySelectorAll('.form-step');
            const progressBars = form.querySelectorAll('.progress-bar');
            const nextButtons = form.querySelectorAll('[data-next]');
            const prevButtons = form.querySelectorAll('[data-prev]');
            
            let currentStep = 0;
            
            const updateProgress = () => {
                const progress = ((currentStep + 1) / steps.length) * 100;
                progressBars.forEach(bar => {
                    bar.style.width = `${progress}%`;
                });
            };
            
            const showStep = (index) => {
                steps.forEach((step, i) => {
                    step.classList.toggle('hidden', i !== index);
                });
                updateProgress();
            };
            
            nextButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const currentStepEl = steps[currentStep];
                    
                    if (this.validateStep(currentStepEl)) {
                        currentStep = Math.min(currentStep + 1, steps.length - 1);
                        showStep(currentStep);
                    }
                });
            });
            
            prevButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    currentStep = Math.max(currentStep - 1, 0);
                    showStep(currentStep);
                });
            });
            
            showStep(0);
        });
    },
    
    validateStep(step) {
        const inputs = step.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;
        
        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('border-red-500');
                isValid = false;
            } else {
                input.classList.remove('border-red-500');
            }
        });
        
        return isValid;
    },
    
    initFormValidation() {
        const forms = document.querySelectorAll('form[data-validate]');
        
        forms.forEach(form => {
            form.addEventListener('submit', (e) => {
                if (!this.validateForm(form)) {
                    e.preventDefault();
                }
            });
        });
    },
    
    validateForm(form) {
        let isValid = true;
        
        const emailInputs = form.querySelectorAll('input[type="email"]');
        emailInputs.forEach(input => {
            const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!pattern.test(input.value)) {
                input.classList.add('border-red-500');
                isValid = false;
            }
        });
        
        return isValid;
    },
    
    initFileUpload() {
        const dropZones = document.querySelectorAll('[data-dropzone]');
        
        dropZones.forEach(zone => {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                zone.addEventListener(eventName, preventDefaults, false);
            });
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            zone.addEventListener('dragenter', () => zone.classList.add('border-primary-500'));
            zone.addEventListener('dragleave', () => zone.classList.remove('border-primary-500'));
            
            zone.addEventListener('drop', (e) => {
                zone.classList.remove('border-primary-500');
                const files = e.dataTransfer.files;
                handleFiles(files, zone);
            });
            
            const fileInput = zone.querySelector('input[type="file"]');
            if (fileInput) {
                fileInput.addEventListener('change', (e) => {
                    handleFiles(e.target.files, zone);
                });
            }
        });
        
        function handleFiles(files, zone) {
            const preview = zone.querySelector('.file-preview');
            if (preview && files.length > 0) {
                preview.innerHTML = `<p class="text-sm text-white/60">${files.length} fichier(s) sélectionné(s)</p>`;
            }
        }
    }
};

/**
 * Video Player Module (for testimonials)
 */
const VideoPlayer = {
    init() {
        this.initVideoScroll();
        this.initVideoControls();
    },
    
    initVideoScroll() {
        const videoContainer = document.querySelector('[data-video-scroll]');
        if (!videoContainer) return;
        
        const videos = videoContainer.querySelectorAll('.video-card');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const video = entry.target.querySelector('video');
                if (!video) return;
                
                if (entry.isIntersecting) {
                    video.play().catch(() => {});
                } else {
                    video.pause();
                    video.currentTime = 0;
                }
            });
        }, { threshold: 0.6 });
        
        videos.forEach(video => observer.observe(video));
    },
    
    initVideoControls() {
        const videoCards = document.querySelectorAll('.video-card');
        
        videoCards.forEach(card => {
            const video = card.querySelector('video');
            const playBtn = card.querySelector('.play-btn');
            const muteBtn = card.querySelector('.mute-btn');
            
            if (!video) return;
            
            playBtn?.addEventListener('click', () => {
                if (video.paused) {
                    video.play();
                    playBtn.classList.add('hidden');
                } else {
                    video.pause();
                    playBtn.classList.remove('hidden');
                }
            });
            
            muteBtn?.addEventListener('click', () => {
                video.muted = !video.muted;
                muteBtn.classList.toggle('muted', video.muted);
            });
        });
    }
};

// Global utility functions
window.showToast = (message, type = 'info') => {
    ToastNotifications.show(message, type);
};

window.formatCurrency = (amount, currency = '€') => {
    return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: currency
    }).format(amount);
};
