<?php
/**
 * Script pour réinitialiser le mot de passe admin
 * Accédez à cette page via votre navigateur: http://localhost:8000/reset-admin-password.php
 */

// Désactiver l'affichage des erreurs pour la production
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<!DOCTYPE html>\n";
echo "<html lang='fr'>\n<head>\n    <meta charset='UTF-8'>\n    <meta name='viewport' content='width=device-width, initial-scale=1.0'>\n    <title>Réinitialisation Mot de Passe Admin</title>\n    <style>\n        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; background: #1a1a2e; color: #fff; }\n        .success { background: #10b981; padding: 15px; border-radius: 8px; margin: 10px 0; }\n        .error { background: #ef4444; padding: 15px; border-radius: 8px; margin: 10px 0; }\n        .info { background: #3b82f6; padding: 15px; border-radius: 8px; margin: 10px 0; }\n        pre { background: #0f0f23; padding: 15px; border-radius: 8px; overflow-x: auto; }\n        h1 { color: #60a5fa; }\n        code { background: #0f0f23; padding: 2px 6px; border-radius: 4px; }\n    </style>\n</head>\n<body>\n<h1>🔧 Réinitialisation du Mot de Passe Admin</h1>\n";

try {
    // Charger la configuration
    require_once __DIR__ . '/config/config.php';
    require_once __DIR__ . '/includes/Database.php';
    
    echo "<div class='info'>✅ Configuration chargée avec succès</div>\n";
    
    // Générer le hash pour 'admin123'
    $password = 'admin123';
    $hash = password_hash($password, PASSWORD_BCRYPT);
    
    echo "<div class='info'>\n";
    echo "<strong>Nouveau hash généré:</strong><br>\n";
    echo "<pre>" . htmlspecialchars($hash) . "</pre>\n";
    echo "</div>\n";
    
    // Mettre à jour la base de données
    $db = getDB();
    
    echo "<div class='info'>✅ Connexion à la base de données réussie</div>\n";
    
    // Vérifier si la table admins existe
    $stmt = $db->query("SHOW TABLES LIKE 'admins'");
    if ($stmt->rowCount() === 0) {
        throw new Exception("La table 'admins' n'existe pas. Importez d'abord le schema.sql");
    }
    
    // Mettre à jour le mot de passe
    $stmt = $db->prepare("UPDATE admins SET password_hash = ? WHERE username = 'admin'");
    $stmt->execute([$hash]);
    
    if ($stmt->rowCount() > 0) {
        echo "<div class='success'>\n";
        echo "<strong>✅ Mot de passe admin mis à jour avec succès!</strong><br>\n";
        echo "Vous pouvez maintenant vous connecter avec:<br>\n";
        echo "<code>Login: admin</code><br>\n";
        echo "<code>Password: admin123</code>\n";
        echo "</div>\n";
        
        // Vérifier que ça marche
        $stmt = $db->prepare("SELECT password_hash FROM admins WHERE username = 'admin'");
        $stmt->execute();
        $admin = $stmt->fetch();
        
        if ($admin && password_verify('admin123', $admin['password_hash'])) {
            echo "<div class='success'>✅ Vérification réussie! Le mot de passe fonctionne correctement.</div>\n";
        } else {
            echo "<div class='error'>❌ Échec de la vérification. Contactez le support.</div>\n";
        }
    } else {
        echo "<div class='error'>\n";
        echo "<strong>❌ Aucun utilisateur 'admin' trouvé dans la base de données.</strong><br>\n";
        echo "Vérifiez que le schéma a été importé correctement.<br>\n";
        echo "Exécutez: <code>mysql -u root -p &lt; database/schema.sql</code>\n";
        echo "</div>\n";
    }
    
} catch (Exception $e) {
    echo "<div class='error'>\n";
    echo "<strong>❌ Erreur:</strong> " . htmlspecialchars($e->getMessage()) . "\n";
    echo "</div>\n";
    echo "<div class='info'>\n";
    echo "<strong>Solution:</strong><br>\n";
    echo "1. Vérifiez que MySQL est en cours d'exécution<br>\n";
    echo "2. Importez le schéma: <code>mysql -u root -p &lt; database/schema.sql</code><br>\n";
    echo "3. Actualisez cette page\n";
    echo "</div>\n";
}

echo "<hr style='border-color: #374151; margin: 30px 0;'>\n";
echo "<p><a href='/admin/login.php' style='color: #60a5fa; text-decoration: none;'>← Retour à la page de connexion admin</a></p>\n";
echo "</body></html>\n";
?>
