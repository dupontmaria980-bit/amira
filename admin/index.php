<?php
/**
 * Admin Dashboard - Humanitarian Platform 2026
 */

session_start();
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/Database.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin/login.php');
    exit;
}

// Get statistics
try {
    $db = getDB();
    
    // Total requests
    $stmt = $db->query("SELECT COUNT(*) as total FROM donation_requests");
    $total_requests = $stmt->fetch()['total'];
    
    // Pending requests
    $stmt = $db->query("SELECT COUNT(*) as total FROM donation_requests WHERE status = 'pending'");
    $pending_requests = $stmt->fetch()['total'];
    
    // Approved requests
    $stmt = $db->query("SELECT COUNT(*) as total FROM donation_requests WHERE status = 'approved'");
    $approved_requests = $stmt->fetch()['total'];
    
    // Total testimonials
    $stmt = $db->query("SELECT COUNT(*) as total FROM testimonials WHERE is_active = 1");
    $total_testimonials = $stmt->fetch()['total'];
    
    // Recent requests
    $stmt = $db->query("SELECT * FROM donation_requests ORDER BY created_at DESC LIMIT 10");
    $recent_requests = $stmt->fetchAll();
    
} catch (Exception $e) {
    $error = "Erreur de connexion à la base de données";
}

$pageTitle = "Dashboard Admin";
?>
<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - Humanitarian 2026</title>
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
<body class="bg-gray-900 text-white font-inter">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 border-r border-gray-700 hidden lg:block">
            <div class="p-6">
                <a href="/" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <span class="font-poppins font-bold text-lg">Admin Panel</span>
                </a>
            </div>
            
            <nav class="mt-6 px-4 space-y-2">
                <a href="/admin/index.php" class="flex items-center space-x-3 px-4 py-3 bg-blue-600 rounded-xl text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="/admin/requests.php" class="flex items-center space-x-3 px-4 py-3 text-gray-400 hover:bg-gray-700 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Demandes</span>
                </a>
                <a href="/admin/testimonials.php" class="flex items-center space-x-3 px-4 py-3 text-gray-400 hover:bg-gray-700 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    <span>Témoignages</span>
                </a>
                <a href="/admin/logout.php" class="flex items-center space-x-3 px-4 py-3 text-red-400 hover:bg-red-900/20 rounded-xl transition-colors mt-8">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Déconnexion</span>
                </a>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-gray-800 border-b border-gray-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-poppins font-semibold">Dashboard</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-400">Bonjour, <?= sanitize($_SESSION['admin_name']) ?></span>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <span class="font-semibold"><?= strtoupper(substr($_SESSION['admin_name'], 0, 1)) ?></span>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Dashboard Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <?php if (isset($error)): ?>
                <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 text-red-400 mb-6">
                    <?= sanitize($error) ?>
                </div>
                <?php endif; ?>
                
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-gray-400 text-sm font-medium">Total Demandes</h3>
                            <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold"><?= format_number($total_requests) ?></p>
                    </div>
                    
                    <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-gray-400 text-sm font-medium">En Attente</h3>
                            <div class="w-10 h-10 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold"><?= format_number($pending_requests) ?></p>
                    </div>
                    
                    <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-gray-400 text-sm font-medium">Approuvées</h3>
                            <div class="w-10 h-10 bg-green-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold"><?= format_number($approved_requests) ?></p>
                    </div>
                    
                    <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-gray-400 text-sm font-medium">Témoignages</h3>
                            <div class="w-10 h-10 bg-purple-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold"><?= format_number($total_testimonials) ?></p>
                    </div>
                </div>
                
                <!-- Recent Requests Table -->
                <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-700">
                        <h2 class="text-lg font-semibold">Demandes Récentes</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-900">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Nom</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Pays</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                <?php foreach ($recent_requests as $request): ?>
                                <tr class="hover:bg-gray-700/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">#<?= $request['id'] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><?= sanitize($request['full_name']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400"><?= get_help_type_label($request['help_type']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400"><?= sanitize($request['country']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium
                                            <?= $request['status'] === 'pending' ? 'bg-yellow-500/20 text-yellow-500' : '' ?>
                                            <?= $request['status'] === 'approved' ? 'bg-green-500/20 text-green-500' : '' ?>
                                            <?= $request['status'] === 'rejected' ? 'bg-red-500/20 text-red-500' : '' ?>
                                            <?= $request['status'] === 'completed' ? 'bg-blue-500/20 text-blue-500' : '' ?>
                                        ">
                                            <?= ucfirst($request['status']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400"><?= format_date($request['created_at'], 'd/m/Y') ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="/admin/request-detail.php?id=<?= $request['id'] ?>" class="text-blue-400 hover:text-blue-300">Voir</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
