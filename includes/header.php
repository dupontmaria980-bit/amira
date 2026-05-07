<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- SEO Meta Tags -->
    <title><?= $pageTitle ?? 'Humanitarian Foundation 2026' ?> - Aide Humanitaire Internationale</title>
    <meta name="description" content="<?= $pageDescription ?? 'Fondation humanitaire internationale aidant les personnes démunies grâce à des donations financières, médicales, alimentaires et sociales.' ?>">
    <meta name="keywords" content="humanitaire, aide, donation, fondation, charitable, medical, food, social">
    <meta name="author" content="Humanitarian Foundation">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= APP_URL ?><?= $_SERVER['REQUEST_URI'] ?>">
    <meta property="og:title" content="<?= $pageTitle ?? 'Humanitarian Foundation 2026' ?>">
    <meta property="og:description" content="<?= $pageDescription ?? 'Aidez-nous à changer des vies' ?>">
    <meta property="og:image" content="<?= APP_URL ?>/assets/images/og-image.jpg">
    
    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $pageTitle ?? 'Humanitarian Foundation 2026' ?>">
    <meta name="twitter:description" content="<?= $pageDescription ?? 'Aidez-nous à changer des vies' ?>">
    <meta name="twitter:image" content="<?= APP_URL ?>/assets/images/og-image.jpg">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/apple-touch-icon.png">
    
    <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Custom Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                        'poppins': ['Poppins', 'sans-serif'],
                        'manrope': ['Manrope', 'sans-serif']
                    },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                            950: '#172554'
                        },
                        royal: {
                            blue: '#002366',
                            purple: '#6B4C9A',
                            gradient: 'linear-gradient(135deg, #002366 0%, #6B4C9A 100%)'
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out forwards',
                        'slide-up': 'slideUp 0.8s ease-out forwards',
                        'slide-down': 'slideDown 0.5s ease-out forwards',
                        'scale-in': 'scaleIn 0.5s ease-out forwards',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite'
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideDown: {
                            '0%': { opacity: '0', transform: 'translateY(-30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        scaleIn: {
                            '0%': { opacity: '0', transform: 'scale(0.9)' },
                            '100%': { opacity: '1', transform: 'scale(1)' }
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 20px rgba(59, 130, 246, 0.3)' },
                            '100%': { boxShadow: '0 0 40px rgba(59, 130, 246, 0.6)' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' }
                        }
                    },
                    backdropBlur: {
                        xs: '2px'
                    },
                    borderRadius: {
                        'xl': '1rem',
                        '2xl': '1.5rem',
                        '3xl': '2rem',
                        '4xl': '3rem'
                    }
                }
            }
        }
    </script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/custom.css">
    
    <?php if (isset($additionalCSS)): ?>
        <?php foreach ($additionalCSS as $css): ?>
            <link rel="stylesheet" href="<?= $css ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body class="font-inter antialiased bg-black text-white overflow-x-hidden">
    <!-- Loading Screen -->
    <div id="loading-screen" class="fixed inset-0 z-[100] bg-black flex items-center justify-center transition-opacity duration-500">
        <div class="text-center">
            <div class="w-20 h-20 border-4 border-primary-500/30 border-t-primary-500 rounded-full animate-spin mx-auto mb-4"></div>
            <p class="text-white/60 font-manrope text-sm">Chargement...</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-transparent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-purple-600 rounded-xl flex items-center justify-center transform group-hover:scale-105 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <span class="font-poppins font-bold text-xl tracking-tight">Humanitarian<span class="text-primary-400">2026</span></span>
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="nav-link text-white/80 hover:text-white transition-colors duration-200 font-medium">Accueil</a>
                    <a href="/about.php" class="nav-link text-white/80 hover:text-white transition-colors duration-200 font-medium">À Propos</a>
                    <a href="/testimonials.php" class="nav-link text-white/80 hover:text-white transition-colors duration-200 font-medium">Témoignages</a>
                    <a href="/gallery.php" class="nav-link text-white/80 hover:text-white transition-colors duration-200 font-medium">Galerie</a>
                    <a href="/contact.php" class="nav-link text-white/80 hover:text-white transition-colors duration-200 font-medium">Contact</a>
                    <a href="/request-help.php" class="btn-primary px-6 py-2.5 rounded-full font-semibold">Demander de l'Aide</a>
                </div>
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden absolute top-full left-0 right-0 bg-black/95 backdrop-blur-xl border-t border-white/10">
            <div class="px-4 py-6 space-y-4">
                <a href="/" class="block py-2 text-white/80 hover:text-white transition-colors font-medium">Accueil</a>
                <a href="/about.php" class="block py-2 text-white/80 hover:text-white transition-colors font-medium">À Propos</a>
                <a href="/testimonials.php" class="block py-2 text-white/80 hover:text-white transition-colors font-medium">Témoignages</a>
                <a href="/gallery.php" class="block py-2 text-white/80 hover:text-white transition-colors font-medium">Galerie</a>
                <a href="/contact.php" class="block py-2 text-white/80 hover:text-white transition-colors font-medium">Contact</a>
                <a href="/request-help.php" class="block w-full text-center btn-primary px-6 py-3 rounded-full font-semibold mt-4">Demander de l'Aide</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main id="main-content">
