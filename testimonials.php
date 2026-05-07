<?php
/**
 * Testimonials Page - TikTok/Reels Style
 * Humanitarian Platform 2026
 */


require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/Database.php';

$pageTitle = "Témoignages";
$pageDescription = "Découvrez les histoires inspirantes des personnes que nous avons aidées.";

include __DIR__ . '/includes/header.php';
?>

<!-- Testimonials Section - TikTok Style -->
<section class="min-h-screen bg-black pt-20">
    <div class="max-w-md mx-auto h-[calc(100vh-80px)] relative">
        <!-- Video Scroll Container -->
        <div data-video-scroll class="h-full overflow-y-scroll snap-y snap-mandatory scroll-smooth no-scrollbar">
            <?php
            try {
                $db = getDB();
                $stmt = $db->query("SELECT * FROM testimonials WHERE is_active = 1 ORDER BY created_at DESC");
                $testimonials = $stmt->fetchAll();
                
                foreach ($testimonials as $testimonial):
            ?>
            <!-- Video Card -->
            <div class="video-card h-full snap-start relative flex items-center justify-center">
                <!-- Video Background -->
                <div class="absolute inset-0 bg-gradient-to-b from-primary-500/30 to-purple-600/30">
                    <video 
                        src="<?= sanitize($testimonial['video_path']) ?>" 
                        class="w-full h-full object-cover"
                        loop
                        playsinline
                        muted
                    ></video>
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                </div>
                
                <!-- Play Button Overlay -->
                <button class="play-btn absolute z-20 w-20 h-20 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                </button>
                
                <!-- Mute Button -->
                <button class="mute-btn absolute top-24 right-4 z-20 w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center hover:bg-white/20 transition-colors">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/>
                    </svg>
                </button>
                
                <!-- Right Side Actions -->
                <div class="absolute right-4 bottom-32 z-20 space-y-6">
                    <!-- Like Button -->
                    <button class="flex flex-col items-center group">
                        <div class="w-12 h-12 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center group-hover:bg-white/20 transition-colors">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <span class="text-white text-xs mt-1 font-medium"><?= format_number($testimonial['likes_count']) ?></span>
                    </button>
                    
                    <!-- Comment Button -->
                    <button class="flex flex-col items-center group">
                        <div class="w-12 h-12 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center group-hover:bg-white/20 transition-colors">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <span class="text-white text-xs mt-1 font-medium"><?= format_number($testimonial['comments_count']) ?></span>
                    </button>
                    
                    <!-- Share Button -->
                    <button class="flex flex-col items-center group">
                        <div class="w-12 h-12 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center group-hover:bg-white/20 transition-colors">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                            </svg>
                        </div>
                        <span class="text-white text-xs mt-1 font-medium">Partager</span>
                    </button>
                </div>
                
                <!-- Bottom Info -->
                <div class="absolute left-0 right-0 bottom-0 p-6 z-10">
                    <div class="mb-4">
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-500 to-purple-600 flex items-center justify-center">
                                <span class="text-white font-bold text-sm"><?= strtoupper(substr($testimonial['first_name'], 0, 1)) ?></span>
                            </div>
                            <div>
                                <p class="text-white font-semibold"><?= sanitize($testimonial['first_name']) ?></p>
                                <p class="text-white/60 text-xs"><?= sanitize($testimonial['country']) ?></p>
                            </div>
                        </div>
                        
                        <p class="text-white/90 text-sm leading-relaxed line-clamp-3">
                            <?= sanitize($testimonial['description']) ?>
                        </p>
                        
                        <div class="mt-3 flex items-center space-x-2">
                            <span class="px-3 py-1 bg-white/10 backdrop-blur-sm rounded-full text-xs text-white/80">
                                <?= get_help_type_label($testimonial['help_type']) ?>
                            </span>
                        </div>
                    </div>
                    
                    <!-- Views Counter -->
                    <div class="flex items-center space-x-2 text-white/60 text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span><?= format_number($testimonial['views_count']) ?> vues</span>
                    </div>
                </div>
            </div>
            <?php
                endforeach;
                
                if (empty($testimonials)):
            ?>
            <!-- Empty State -->
            <div class="h-full flex items-center justify-center p-8 text-center">
                <div>
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-white/10 flex items-center justify-center">
                        <svg class="w-10 h-10 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Aucun témoignage</h3>
                    <p class="text-white/60">Les témoignages vidéo apparaîtront ici bientôt.</p>
                </div>
            </div>
            <?php
                endif;
            } catch (Exception $e) {
            ?>
            <!-- Demo Content if DB fails -->
            <div class="video-card h-full snap-start relative flex items-center justify-center">
                <div class="absolute inset-0 bg-gradient-to-b from-blue-600/40 to-purple-600/40"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-center p-8">
                        <p class="text-white/60">Démo - Contenu vidéo</p>
                    </div>
                </div>
                <div class="absolute left-0 right-0 bottom-0 p-6">
                    <p class="text-white font-semibold">Marie</p>
                    <p class="text-white/60 text-sm">France</p>
                    <p class="text-white/90 text-sm mt-2">Grâce à cette fondation, j'ai pu recevoir les soins médicaux dont j'avais besoin.</p>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        
        <!-- Progress Indicators -->
        <div class="absolute top-4 right-4 z-20 space-y-2">
            <div class="w-1 h-12 bg-white/20 rounded-full overflow-hidden">
                <div class="w-full h-full bg-white rounded-full" style="width: 100%;"></div>
            </div>
        </div>
    </div>
</section>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<?php include __DIR__ . '/includes/footer.php'; ?>
