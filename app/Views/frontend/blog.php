<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <div class="text-center space-y-4">
        <span class="text-rose-500 font-bold text-xs uppercase tracking-widest">Masterclass Journal</span>
        <h1 class="font-serif text-4xl sm:text-5xl font-extrabold text-white">Bridal Skincare & Beauty Tips</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($posts as $post): ?>
            <div class="dark-glass-panel rounded-3xl overflow-hidden border border-zinc-800 p-6 space-y-4 flex flex-col justify-between">
                <div class="space-y-3">
                    <span class="text-xs font-semibold text-rose-400 block"><?= htmlspecialchars($post['category_name'] ?? 'Beauty Tips') ?></span>
                    <h3 class="font-serif text-xl font-bold text-white"><?= htmlspecialchars($post['title']) ?></h3>
                    <p class="text-xs text-zinc-400 line-clamp-3"><?= strip_tags($post['content']) ?></p>
                </div>
                <a href="<?= BASE_URL ?>/blog/<?= $post['slug'] ?>" class="text-xs font-bold text-rose-500 hover:text-rose-400 transition flex items-center gap-2 pt-4 border-t border-zinc-800">
                    <span>Read Article</span> <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>
