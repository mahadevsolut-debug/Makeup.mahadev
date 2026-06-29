<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Makeup.mahadev</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-zinc-950 text-zinc-100 font-sans min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-zinc-900 border border-zinc-800 rounded-3xl p-8 space-y-6 shadow-2xl">
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-2xl bg-rose-600 font-bold text-2xl text-white mx-auto flex items-center justify-center">M</div>
            <h1 class="text-2xl font-bold text-white">Admin Console</h1>
            <p class="text-xs text-zinc-400">Sign in to control services, bookings, and website content.</p>
        </div>

        <?php if ($err = \App\Core\Session::flash('error')): ?>
            <div class="p-3 rounded-xl bg-rose-950 border border-rose-800 text-rose-300 text-xs text-center">
                <?= htmlspecialchars($err) ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/admin/login" method="POST" class="space-y-4">
            <?= \App\Core\CSRF::field() ?>
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Email Address</label>
                <input type="email" name="email" required value="admin@makeupmahadev.com" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-rose-500">
            </div>
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Password</label>
                <input type="password" name="password" required value="admin123" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-rose-500">
            </div>
            <button type="submit" class="w-full py-3.5 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-bold text-sm transition">Sign In</button>
        </form>
    </div>
</body>
</html>
