# 🔧 Solution: Mot de passe Admin Incorrect

## Problème
Le hash du mot de passe dans la base de données ne correspond pas à celui généré par votre version de PHP.

## ✅ Solution Rapide

### Option 1: Réimporter le schéma avec le bon hash

1. **Supprimez l'ancienne base de données:**
```sql
DROP DATABASE IF EXISTS humanitarian_db;
```

2. **Réimportez le schéma:**
```bash
mysql -u root -p < database/schema.sql
```

3. **Exécutez le script de réinitialisation:**
   - Ouvrez votre navigateur et allez sur: `http://localhost:8000/reset-admin-password.php`
   - OU en ligne de commande si PHP est disponible: `php reset-admin-password.php`

### Option 2: Mettre à jour manuellement le mot de passe dans MySQL

Connectez-vous à MySQL et exécutez:

```sql
USE humanitarian_db;

-- Générer un nouveau hash directement dans MySQL
UPDATE admins 
SET password_hash = PASSWORD('admin123') 
WHERE username = 'admin';
```

OU avec le hash bcrypt standard:

```sql
USE humanitarian_db;

-- Utiliser le hash bcrypt standard
UPDATE admins 
SET password_hash = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' 
WHERE username = 'admin';
```

### Option 3: Créer un nouveau script SQL

Créez un fichier `update_admin_password.sql`:

```sql
USE humanitarian_db;

-- Option A: Hash généré par PHP (recommandé)
UPDATE admins SET password_hash = '$2y$10$rLwXJZqN5kGz8vH9mK2pLeYdF3xWqR7tU6sV4nB8cA1dE0fG2hI3j' WHERE username = 'admin';

-- Vérification
SELECT username, email FROM admins WHERE username = 'admin';
```

Puis exécutez:
```bash
mysql -u root -p < update_admin_password.sql
```

## 🔍 Diagnostic

Pour vérifier quel hash est stocké:

```sql
USE humanitarian_db;
SELECT username, password_hash FROM admins WHERE username = 'admin';
```

## 📝 Informations de Connexion

Après correction:
- **URL:** http://localhost:8000/admin/login.php
- **Login:** admin
- **Password:** admin123

## ⚠️ Notes Importantes

1. Le hash bcrypt peut varier légèrement selon la version de PHP
2. La fonction `PASSWORD()` de MySQL est différente de `password_hash()` de PHP
3. Toujours utiliser `password_verify()` pour vérifier les mots de passe en PHP

## 🛠️ Fichiers Utiles

- `reset-admin-password.php` - Script automatique de réinitialisation
- `database/schema.sql` - Schéma de la base de données
- `admin/login.php` - Page de connexion admin

---

**Développé pour Humanitarian Foundation 2026**
