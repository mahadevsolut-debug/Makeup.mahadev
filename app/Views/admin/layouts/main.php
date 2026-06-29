<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($meta_title ?? 'Admin Panel') ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CKEditor 5 CDN for blog/content management -->
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
</head>
<body class="bg-zinc-900 text-zinc-100 font-sans antialiased flex min-h-screen">

    <!-- Admin Sidebar -->
    <aside class="w-64 bg-zinc-950 border-r border-zinc-800 p-6 flex flex-col justify-between hidden md:flex">
        <div class="space-y-8">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-rose-600 flex items-center justify-center font-bold text-white">M</div>
                <span class="font-bold text-lg text-white">Admin Console</span>
            </div>

            <nav class="space-y-2 text-sm text-zinc-400">
                <a href="<?= BASE_URL ?>/admin/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-900 hover:text-white transition">
                    <i class="fa-solid fa-chart-line text-rose-500 w-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="<?= BASE_URL ?>/admin/bookings" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-900 hover:text-white transition">
                    <i class="fa-solid fa-calendar-check text-amber-500 w-5"></i>
                    <span>Bookings Manager</span>
                </a>
                <a href="<?= BASE_URL ?>/admin/services" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-900 hover:text-white transition">
                    <i class="fa-solid fa-wand-magic-sparkles text-purple-500 w-5"></i>
                    <span>Services & Pricing</span>
                </a>
                <a href="<?= BASE_URL ?>/admin/portfolio" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-900 hover:text-white transition">
                    <i class="fa-solid fa-images text-emerald-500 w-5"></i>
                    <span>Portfolio Uploads</span>
                </a>
                <a href="<?= BASE_URL ?>/admin/settings" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-zinc-900 hover:text-white transition">
                    <i class="fa-solid fa-sliders text-blue-500 w-5"></i>
                    <span>Website Settings</span>
                </a>
            </nav>
        </div>

        <div class="border-t border-zinc-800 pt-4 flex items-center justify-between">
            <div class="text-xs text-zinc-400">
                <p class="font-medium text-white"><?= htmlspecialchars(\App\Core\Session::get('admin_name', 'Admin')) ?></p>
                <p class="capitalize text-zinc-500"><?= htmlspecialchars(\App\Core\Session::get('admin_role', 'admin')) ?></p>
            </div>
            <a href="<?= BASE_URL ?>/admin/logout" class="text-zinc-500 hover:text-rose-400 text-sm" title="Logout">
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col">
        <header class="h-16 bg-zinc-950/50 border-b border-zinc-800 flex items-center justify-between px-8">
            <div class="flex items-center gap-4">
                <a href="<?= BASE_URL ?>" target="_blank" class="text-xs px-3 py-1.5 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-zinc-300 transition flex items-center gap-2">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> View Public Website
                </a>
            </div>
        </header>

        <main class="p-8 flex-1">
            <?php if ($msg = \App\Core\Session::flash('success')): ?>
                <div class="mb-6 p-4 rounded-xl bg-emerald-950 border border-emerald-600 text-emerald-200 flex items-center gap-3 text-sm">
                    <i class="fa-solid fa-check-circle text-emerald-400"></i>
                    <span><?= htmlspecialchars($msg) ?></span>
                </div>
            <?php endif; ?>

            <?= $content ?>
        </main>
    </div>

</body>
</html>
