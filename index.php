<?php
/**
 * Homepage - Humanitarian Platform 2026
 */


require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/Database.php';

$pageTitle = "Accueil";
$pageDescription = "Fondation humanitaire internationale aidant les personnes démunies grâce à des donations financières, médicales, alimentaires et sociales.";

include __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Video Background -->
    <div class="absolute inset-0 z-0">
        <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-40">
            <source src="https://videos.pexels.com/video-files/5896373/5896373-hd_1920_1080_25fps.mp4" type="video/mp4">
        </video>
        <div class="absolute inset-0 overlay-gradient"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-transparent to-black"></div>
    </div>
    
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-primary-500/20 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-600/20 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20">
        <h1 class="hero-title font-poppins text-5xl md:text-7xl lg:text-8xl font-bold leading-tight mb-6">
            Changer des vies,<br>
            <span class="gradient-text">un geste à la fois</span>
        </h1>
        
        <p class="hero-subtitle text-lg md:text-xl lg:text-2xl text-white/80 max-w-3xl mx-auto mb-10 leading-relaxed">
            Nous apportons espoir et soutien aux personnes démunies grâce à l'aide médicale, alimentaire, financière et sociale. Rejoignez notre mission humanitaire.
        </p>
        
        <div class="hero-cta flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="/request-help.php" class="btn-primary px-8 py-4 rounded-full font-semibold text-lg hover:scale-105 transition-transform duration-300 glow">
                Demander de l'aide
            </a>
            <a href="/testimonials.php" class="btn-secondary px-8 py-4 rounded-full font-semibold text-lg hover:scale-105 transition-transform duration-300">
                Voir les témoignages
            </a>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-20 bg-gradient-to-b from-black to-primary-950/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center reveal">
                <div class="text-4xl md:text-5xl lg:text-6xl font-bold gradient-text mb-2">
                    <span data-counter="50000">0</span>+
                </div>
                <p class="text-white/60 font-manrope">Vies touchées</p>
            </div>
            <div class="text-center reveal" style="transition-delay: 0.1s;">
                <div class="text-4xl md:text-5xl lg:text-6xl font-bold gradient-text mb-2">
                    <span data-counter="120">0</span>+
                </div>
                <p class="text-white/60 font-manrope">Projets réalisés</p>
            </div>
            <div class="text-center reveal" style="transition-delay: 0.2s;">
                <div class="text-4xl md:text-5xl lg:text-6xl font-bold gradient-text mb-2">
                    <span data-counter="5000">0</span>+
                </div>
                <p class="text-white/60 font-manrope">Bénévoles</p>
            </div>
            <div class="text-center reveal" style="transition-delay: 0.3s;">
                <div class="text-4xl md:text-5xl lg:text-6xl font-bold gradient-text mb-2">
                    <span data-counter="25">0</span>
                </div>
                <p class="text-white/60 font-manrope">Pays aidés</p>
            </div>
        </div>
    </div>
</section>

<!-- Mission Section -->
<section class="py-24 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-primary-950/20 to-black"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 reveal">
            <h2 class="font-poppins text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                Notre <span class="gradient-text">Mission</span>
            </h2>
            <p class="text-white/60 text-lg max-w-3xl mx-auto">
                Nous croyons que chaque personne mérite une vie digne, avec accès aux soins, à la nourriture et au soutien nécessaire.
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div class="glass-card rounded-3xl p-8 card-hover reveal">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-poppins text-xl font-semibold mb-3">Aide Financière</h3>
                <p class="text-white/60 leading-relaxed">
                    Soutien financier direct pour aider les familles à surmonter les difficultés économiques et reconstruire leur vie.
                </p>
            </div>
            
            <!-- Card 2 -->
            <div class="glass-card rounded-3xl p-8 card-hover reveal" style="transition-delay: 0.1s;">
                <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-pink-500 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="font-poppins text-xl font-semibold mb-3">Aide Médicale</h3>
                <p class="text-white/60 leading-relaxed">
                    Accès aux soins médicaux essentiels, médicaments et traitements pour ceux qui ne peuvent pas se les offrir.
                </p>
            </div>
            
            <!-- Card 3 -->
            <div class="glass-card rounded-3xl p-8 card-hover reveal" style="transition-delay: 0.2s;">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="font-poppins text-xl font-semibold mb-3">Aide Alimentaire</h3>
                <p class="text-white/60 leading-relaxed">
                    Distribution de nourriture et de repas chauds aux personnes dans le besoin, lutte contre la faim.
                </p>
            </div>
            
            <!-- Card 4 -->
            <div class="glass-card rounded-3xl p-8 card-hover reveal" style="transition-delay: 0.3s;">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-violet-500 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="font-poppins text-xl font-semibold mb-3">Soutien Social</h3>
                <p class="text-white/60 leading-relaxed">
                    Accompagnement psychologique, réinsertion professionnelle et aide au logement pour un avenir meilleur.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Testimonials Preview -->
<section class="py-24 bg-gradient-to-b from-black to-primary-950/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <h2 class="font-poppins text-4xl md:text-5xl font-bold mb-6">
                Témoignages <span class="gradient-text">Inspirants</span>
            </h2>
            <p class="text-white/60 text-lg max-w-3xl mx-auto">
                Découvrez les histoires de celles et ceux dont nous avons pu changer la vie grâce à votre générosité.
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-6 mb-12">
            <?php
            try {
                $db = getDB();
                $stmt = $db->query("SELECT * FROM testimonials WHERE is_active = 1 AND is_featured = 1 ORDER BY created_at DESC LIMIT 3");
                $testimonials = $stmt->fetchAll();
                
                foreach ($testimonials as $testimonial):
            ?>
            <div class="glass-card rounded-3xl overflow-hidden card-hover reveal">
                <div class="aspect-[9/16] relative bg-gradient-to-b from-primary-500/20 to-purple-600/20">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/80 to-transparent">
                        <p class="text-white font-semibold"><?= sanitize($testimonial['first_name']) ?></p>
                        <p class="text-white/60 text-sm"><?= sanitize($testimonial['country']) ?></p>
                    </div>
                </div>
            </div>
            <?php
                endforeach;
            } catch (Exception $e) {
                // Sample testimonials if DB fails
            }
            ?>
        </div>
        
        <div class="text-center reveal">
            <a href="/testimonials.php" class="btn-primary inline-block px-8 py-4 rounded-full font-semibold">
                Voir tous les témoignages
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-24 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-primary-600/20 to-purple-600/20"></div>
    <div class="absolute inset-0">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary-500/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-500/30 rounded-full blur-3xl"></div>
    </div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 reveal">
        <h2 class="font-poppins text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
            Prêt à faire la <span class="gradient-text">différence</span>?
        </h2>
        <p class="text-xl text-white/80 mb-10 leading-relaxed">
            Votre contribution peut transformer des vies. Rejoignez notre communauté de donateurs et devenez acteur du changement.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/request-help.php" class="btn-primary px-8 py-4 rounded-full font-semibold text-lg hover:scale-105 transition-transform duration-300">
                Faire un don
            </a>
            <a href="/contact.php" class="btn-secondary px-8 py-4 rounded-full font-semibold text-lg hover:scale-105 transition-transform duration-300">
                Nous contacter
            </a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
