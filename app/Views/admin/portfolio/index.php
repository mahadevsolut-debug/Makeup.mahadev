<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-white">Portfolio Manager</h1>
    </div>

    <form action="<?= BASE_URL ?>/admin/portfolio/store" method="POST" enctype="multipart/form-data" class="bg-zinc-950 p-6 rounded-2xl border border-zinc-800 space-y-4">
        <?= \App\Core\CSRF::field() ?>
        <h3 class="font-bold text-white text-sm">Upload New Lookbook Media</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <input type="text" name="title" placeholder="Look Title" required class="bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2 text-xs text-white">
            <input type="text" name="client_name" placeholder="Client Name (Optional)" class="bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2 text-xs text-white">
            <select name="category" class="bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2 text-xs text-white">
                <option value="Bridal">Bridal</option>
                <option value="Party">Party</option>
                <option value="Editorial">Editorial</option>
            </select>
        </div>
        <input type="file" name="cover_image" required class="text-xs text-zinc-400">
        <button type="submit" class="px-4 py-2 bg-rose-600 rounded-xl text-xs font-bold text-white">Upload Look</button>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <?php foreach ($portfolio as $p): ?>
            <div class="bg-zinc-950 p-4 rounded-2xl border border-zinc-800 space-y-2">
                <h4 class="font-bold text-white text-sm"><?= htmlspecialchars($p['title']) ?></h4>
                <p class="text-xs text-rose-400"><?= htmlspecialchars($p['category']) ?></p>
                <a href="<?= BASE_URL ?>/admin/portfolio/delete/<?= $p['id'] ?>" onclick="return confirm('Delete item?')" class="text-xs text-rose-500 hover:underline">Delete</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
