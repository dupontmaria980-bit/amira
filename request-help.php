<?php
/**
 * Donation Request Form - Multi-step
 * Humanitarian Platform 2026
 */

session_start();
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/Database.php';

$pageTitle = "Demander de l'Aide";
$pageDescription = "Formulaire de demande d'aide humanitaire - aide financière, médicale, alimentaire ou sociale.";

// Handle form submission
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $errors[] = "Token de sécurité invalide";
    }
    
    // Rate limiting
    if (!rate_limit('donation_request_' . get_client_ip(), 3, 3600)) {
        $errors[] = "Trop de tentatives. Veuillez réessayer plus tard.";
    }
    
    // Anti-spam check
    if (check_spam($_POST)) {
        $errors[] = "Demande suspecte détectée";
    }
    
    // Validate required fields
    $required_fields = ['full_name', 'email', 'country', 'city', 'situation', 'help_type', 'description', 'gdpr_consent'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "Le champ {$field} est requis";
        }
    }
    
    // Validate email
    if (!empty($_POST['email']) && !validate_email($_POST['email'])) {
        $errors[] = "Email invalide";
    }
    
    // Validate GDPR consent
    if (empty($_POST['gdpr_consent'])) {
        $errors[] = "Vous devez accepter la politique de confidentialité";
    }
    
    if (empty($errors)) {
        try {
            $db = getDB();
            
            $stmt = $db->prepare("
                INSERT INTO donation_requests 
                (full_name, email, whatsapp, country, city, situation, help_type, amount_requested, description, ip_address, gdpr_consent)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            
            $stmt->execute([
                sanitize($_POST['full_name']),
                sanitize($_POST['email']),
                sanitize($_POST['whatsapp'] ?? ''),
                sanitize($_POST['country']),
                sanitize($_POST['city']),
                sanitize($_POST['situation']),
                $_POST['help_type'],
                !empty($_POST['amount_requested']) ? floatval($_POST['amount_requested']) : null,
                sanitize($_POST['description']),
                get_client_ip(),
                1
            ]);
            
            $request_id = $db->lastInsertId();
            
            // Log activity
            log_activity('donation_request_submitted', ['request_id' => $request_id]);
            
            $success = true;
            
            // Send notification email (placeholder)
            // send_email('admin@humanitarian.org', 'Nouvelle demande d\'aide', "Une nouvelle demande a été soumise (ID: {$request_id})");
            
        } catch (Exception $e) {
            log_activity('db_error', ['error' => $e->getMessage()]);
            $errors[] = "Erreur lors de l'envoi de la demande. Veuillez réessayer.";
        }
    }
}

include __DIR__ . '/includes/header.php';
?>

<!-- Request Help Section -->
<section class="min-h-screen bg-gradient-to-b from-black via-primary-950/20 to-black py-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12 reveal">
            <h1 class="font-poppins text-4xl md:text-5xl font-bold mb-4">
                Demander de <span class="gradient-text">l'Aide</span>
            </h1>
            <p class="text-white/60 text-lg">
                Remplissez ce formulaire pour soumettre votre demande d'aide humanitaire
            </p>
        </div>
        
        <?php if ($success): ?>
        <!-- Success Message -->
        <div class="glass-card rounded-3xl p-8 text-center reveal animate-fade-in">
            <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-green-500/20 flex items-center justify-center">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-white mb-4">Demande envoyée avec succès!</h2>
            <p class="text-white/60 mb-6">
                Votre demande a été soumise avec succès. Notre équipe l'examinera dans les plus brefs délais et vous contactera.
            </p>
            <a href="/" class="btn-primary inline-block px-8 py-3 rounded-full font-semibold">
                Retour à l'accueil
            </a>
        </div>
        <?php else: ?>
        
        <?php if (!empty($errors)): ?>
        <!-- Error Messages -->
        <div class="mb-8 space-y-2">
            <?php foreach ($errors as $error): ?>
            <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 text-red-400 text-sm">
                <?= sanitize($error) ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <!-- Multi-step Form -->
        <form data-multistep data-validate method="POST" action="" class="glass-card rounded-3xl p-8 reveal">
            <!-- CSRF Token -->
            <input type="hidden" name="csrf_token" value="<?= generate_csrf_token() ?>">
            
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex justify-between text-xs text-white/60 mb-2">
                    <span>Étape 1</span>
                    <span>Étape 2</span>
                    <span>Étape 3</span>
                </div>
                <div class="h-2 bg-white/10 rounded-full overflow-hidden">
                    <div class="progress-bar h-full bg-gradient-to-r from-primary-500 to-purple-600 rounded-full transition-all duration-500" style="width: 33%;"></div>
                </div>
            </div>
            
            <!-- Step 1: Personal Information -->
            <div class="form-step">
                <h3 class="text-xl font-semibold mb-6">Informations Personnelles</h3>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-white/80 mb-2">Nom Complet *</label>
                        <input type="text" name="full_name" required 
                            class="input-modern w-full px-4 py-3 rounded-xl"
                            placeholder="Votre nom complet">
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-white/80 mb-2">Email *</label>
                            <input type="email" name="email" required 
                                class="input-modern w-full px-4 py-3 rounded-xl"
                                placeholder="votre@email.com">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-white/80 mb-2">WhatsApp (optionnel)</label>
                            <input type="tel" name="whatsapp" 
                                class="input-modern w-full px-4 py-3 rounded-xl"
                                placeholder="+33 6 12 34 56 78">
                        </div>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-white/80 mb-2">Pays *</label>
                            <select name="country" required class="input-modern w-full px-4 py-3 rounded-xl">
                                <option value="">Sélectionnez un pays</option>
                                <option value="France">France</option>
                                <option value="Belgique">Belgique</option>
                                <option value="Suisse">Suisse</option>
                                <option value="Canada">Canada</option>
                                <option value="Maroc">Maroc</option>
                                <option value="Algérie">Algérie</option>
                                <option value="Tunisie">Tunisie</option>
                                <option value="Sénégal">Sénégal</option>
                                <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                <option value="Cameroun">Cameroun</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-white/80 mb-2">Ville *</label>
                            <input type="text" name="city" required 
                                class="input-modern w-full px-4 py-3 rounded-xl"
                                placeholder="Votre ville">
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-end">
                    <button type="button" data-next class="btn-primary px-8 py-3 rounded-full font-semibold">
                        Suivant
                    </button>
                </div>
            </div>
            
            <!-- Step 2: Help Details -->
            <div class="form-step hidden">
                <h3 class="text-xl font-semibold mb-6">Détails de l'Aide Demandée</h3>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-white/80 mb-2">Type d'Aide *</label>
                        <select name="help_type" required class="input-modern w-full px-4 py-3 rounded-xl">
                            <option value="">Sélectionnez un type d'aide</option>
                            <option value="financial">Aide Financière</option>
                            <option value="medical">Aide Médicale</option>
                            <option value="food">Aide Alimentaire</option>
                            <option value="social">Soutien Social</option>
                            <option value="other">Autre</option>
                        </select>
                    </div>
                    
                    <div id="amount-field" class="hidden">
                        <label class="block text-sm font-medium text-white/80 mb-2">Montant Demandé (€)</label>
                        <input type="number" name="amount_requested" step="0.01" min="0"
                            class="input-modern w-full px-4 py-3 rounded-xl"
                            placeholder="Ex: 500.00">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-white/80 mb-2">Situation Actuelle *</label>
                        <textarea name="situation" required rows="4"
                            class="input-modern w-full px-4 py-3 rounded-xl resize-none"
                            placeholder="Décrivez votre situation actuelle..."></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-white/80 mb-2">Description Détaillée *</label>
                        <textarea name="description" required rows="6"
                            class="input-modern w-full px-4 py-3 rounded-xl resize-none"
                            placeholder="Expliquez en détail votre demande et comment l'aide peut vous aider..."></textarea>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-between">
                    <button type="button" data-prev class="btn-secondary px-8 py-3 rounded-full font-semibold">
                        Retour
                    </button>
                    <button type="button" data-next class="btn-primary px-8 py-3 rounded-full font-semibold">
                        Suivant
                    </button>
                </div>
            </div>
            
            <!-- Step 3: Review & Submit -->
            <div class="form-step hidden">
                <h3 class="text-xl font-semibold mb-6">Vérification et Envoi</h3>
                
                <div class="space-y-6">
                    <div class="bg-white/5 rounded-xl p-6 space-y-4">
                        <h4 class="font-semibold text-white/80">Récapitulatif de votre demande</h4>
                        <div class="text-sm text-white/60 space-y-2">
                            <p><span class="text-white/80">Nom:</span> <span data-review="full_name"></span></p>
                            <p><span class="text-white/80">Email:</span> <span data-review="email"></span></p>
                            <p><span class="text-white/80">Pays:</span> <span data-review="country"></span></p>
                            <p><span class="text-white/80">Type d'aide:</span> <span data-review="help_type"></span></p>
                        </div>
                    </div>
                    
                    <!-- Honeypot field (anti-spam) -->
                    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">
                    <input type="text" name="honeypot" class="hidden" tabindex="-1" autocomplete="off">
                    
                    <div class="flex items-start space-x-3">
                        <input type="checkbox" name="gdpr_consent" id="gdpr_consent" required 
                            class="mt-1 w-4 h-4 rounded border-white/20 bg-white/10 text-primary-500 focus:ring-primary-500">
                        <label for="gdpr_consent" class="text-sm text-white/60">
                            J'accepte la <a href="/privacy.php" class="text-primary-400 hover:underline">politique de confidentialité</a> et le traitement de mes données personnelles conformément au RGPD. *
                        </label>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-between">
                    <button type="button" data-prev class="btn-secondary px-8 py-3 rounded-full font-semibold">
                        Retour
                    </button>
                    <button type="submit" class="btn-primary px-8 py-3 rounded-full font-semibold">
                        Envoyer la demande
                    </button>
                </div>
            </div>
        </form>
        <?php endif; ?>
    </div>
</section>

<script>
// Show/hide amount field based on help type
document.addEventListener('DOMContentLoaded', function() {
    const helpTypeSelect = document.querySelector('select[name="help_type"]');
    const amountField = document.getElementById('amount-field');
    
    if (helpTypeSelect) {
        helpTypeSelect.addEventListener('change', function() {
            if (this.value === 'financial') {
                amountField.classList.remove('hidden');
            } else {
                amountField.classList.add('hidden');
            }
        });
    }
    
    // Update review section
    const form = document.querySelector('form[data-multistep]');
    if (form) {
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                const reviewEl = document.querySelector(`[data-review="${this.name}"]`);
                if (reviewEl) {
                    reviewEl.textContent = this.value || '-';
                }
            });
        });
    }
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
