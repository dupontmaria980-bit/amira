<?php
/**
 * Contact Page - Humanitarian Platform 2026
 */


require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/Database.php';

$pageTitle = "Contact";
$pageDescription = "Contactez notre fondation humanitaire pour toute question ou demande d'information.";

include __DIR__ . '/includes/header.php';
?>

<!-- Contact Section -->
<section class="min-h-screen bg-gradient-to-b from-black via-primary-950/20 to-black py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16 reveal">
            <h1 class="font-poppins text-4xl md:text-5xl font-bold mb-4">
                Contactez-<span class="gradient-text">Nous</span>
            </h1>
            <p class="text-white/60 text-lg max-w-2xl mx-auto">
                Une question ? Une suggestion ? N'hésitez pas à nous contacter, notre équipe vous répondra dans les plus brefs délais.
            </p>
        </div>
        
        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Contact Info -->
            <div class="space-y-8 reveal">
                <div class="glass-card rounded-3xl p-8">
                    <h2 class="font-poppins text-2xl font-semibold mb-6">Informations de Contact</h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white mb-1">Email</h3>
                                <a href="mailto:contact@humanitarian.org" class="text-white/60 hover:text-white transition-colors">contact@humanitarian.org</a>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white mb-1">Téléphone</h3>
                                <a href="tel:+33123456789" class="text-white/60 hover:text-white transition-colors">+33 1 23 45 67 89</a>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white mb-1">Adresse</h3>
                                <p class="text-white/60">123 Avenue de l'Humanité<br>75001 Paris, France</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Links -->
                    <div class="mt-8 pt-8 border-t border-white/10">
                        <h3 class="font-semibold text-white mb-4">Suivez-nous</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 hover:bg-primary-500 flex items-center justify-center transition-all duration-300 hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 hover:bg-primary-500 flex items-center justify-center transition-all duration-300 hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 hover:bg-primary-500 flex items-center justify-center transition-all duration-300 hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 hover:bg-primary-500 flex items-center justify-center transition-all duration-300 hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- FAQ Preview -->
                <div class="glass-card rounded-3xl p-8">
                    <h2 class="font-poppins text-xl font-semibold mb-4">Questions Fréquentes</h2>
                    <div class="space-y-4">
                        <a href="/faq.php" class="block p-4 bg-white/5 rounded-xl hover:bg-white/10 transition-colors">
                            <p class="text-white/80 text-sm">Comment faire un don ? →</p>
                        </a>
                        <a href="/faq.php" class="block p-4 bg-white/5 rounded-xl hover:bg-white/10 transition-colors">
                            <p class="text-white/80 text-sm">Qui peut bénéficier de l'aide ? →</p>
                        </a>
                        <a href="/faq.php" class="block p-4 bg-white/5 rounded-xl hover:bg-white/10 transition-colors">
                            <p class="text-white/80 text-sm">Comment devenir bénévole ? →</p>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="reveal">
                <div class="glass-card rounded-3xl p-8">
                    <h2 class="font-poppins text-2xl font-semibold mb-6">Envoyez-nous un message</h2>
                    
                    <form class="space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-white/80 mb-2">Nom</label>
                                <input type="text" class="input-modern w-full px-4 py-3 rounded-xl" placeholder="Votre nom">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-white/80 mb-2">Email</label>
                                <input type="email" class="input-modern w-full px-4 py-3 rounded-xl" placeholder="votre@email.com">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-white/80 mb-2">Sujet</label>
                            <select class="input-modern w-full px-4 py-3 rounded-xl">
                                <option value="">Sélectionnez un sujet</option>
                                <option value="general">Question générale</option>
                                <option value="donation">Faire un don</option>
                                <option value="help">Demander de l'aide</option>
                                <option value="partnership">Partenariat</option>
                                <option value="volunteer">Devenir bénévole</option>
                                <option value="press">Presse</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-white/80 mb-2">Message</label>
                            <textarea rows="6" class="input-modern w-full px-4 py-3 rounded-xl resize-none" placeholder="Votre message..."></textarea>
                        </div>
                        
                        <button type="submit" class="w-full btn-primary py-4 rounded-xl font-semibold">
                            Envoyer le message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
