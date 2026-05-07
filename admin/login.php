<?php
/**
 * Admin Login - Humanitarian Platform 2026
 */


require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/Database.php';

// Redirect if already logged in
if (isset($_SESSION['admin_id'])) {
    header('Location: /admin/index.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $errors[] = "Veuillez remplir tous les champs";
    } else {
        try {
            $db = getDB();
            
            $stmt = $db->prepare("SELECT * FROM admins WHERE username = ? AND is_active = 1");
            $stmt->execute([$username]);
            $admin = $stmt->fetch();
            
            if ($admin && password_verify($password, $admin['password_hash'])) {
                // Set session
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_name'] = $admin['full_name'];
                $_SESSION['admin_email'] = $admin['email'];
                
                // Update last login
                $stmt = $db->prepare("UPDATE admins SET last_login = NOW() WHERE id = ?");
                $stmt->execute([$admin['id']]);
                
                // Log activity
                log_activity('admin_login', ['admin_id' => $admin['id']]);
                
                header('Location: /admin/index.php');
                exit;
            } else {
                $errors[] = "Identifiants incorrects";
                log_activity('admin_login_failed', ['username' => $username]);
            }
        } catch (Exception $e) {
            $errors[] = "Erreur de connexion";
            log_activity('admin_login_error', ['error' => $e->getMessage()]);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Humanitarian 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                        'poppins': ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <h1 class="font-poppins text-2xl font-bold">Admin Panel</h1>
            <p class="text-gray-400 mt-2">Humanitarian Foundation 2026</p>
        </div>
        
        <!-- Login Form -->
        <div class="bg-gray-800 rounded-2xl p-8 border border-gray-700">
            <?php if (!empty($errors)): ?>
            <div class="mb-6 space-y-2">
                <?php foreach ($errors as $error): ?>
                <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-3 text-red-400 text-sm">
                    <?= sanitize($error) ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Nom d'utilisateur</label>
                        <input type="text" name="username" required 
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-xl focus:outline-none focus:border-blue-500 transition-colors"
                            placeholder="admin">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Mot de passe</label>
                        <input type="password" name="password" required 
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-xl focus:outline-none focus:border-blue-500 transition-colors"
                            placeholder="••••••••">
                    </div>
                    
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 py-3 rounded-xl font-semibold hover:opacity-90 transition-opacity">
                        Se connecter
                    </button>
                </div>
            </form>
            
            <div class="mt-6 text-center">
                <a href="/" class="text-gray-400 hover:text-white text-sm transition-colors">
                    ← Retour au site
                </a>
            </div>
        </div>
        
        <!-- Footer -->
        <p class="text-center text-gray-500 text-sm mt-8">
            &copy; <?= date('Y') ?> Humanitarian Foundation. Tous droits réservés.
        </p>
    </div>
</body>
</html>
