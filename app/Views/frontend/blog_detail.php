<article class="py-16 max-w-4xl mx-auto px-4 space-y-8">
    <div class="space-y-4">
        <span class="text-xs font-bold px-3 py-1 rounded-full bg-rose-950 text-rose-300 border border-rose-800">
            <?= htmlspecialchars($post['category_name'] ?? 'Journal') ?>
        </span>
        <h1 class="font-serif text-4xl sm:text-5xl font-extrabold text-white leading-tight"><?= htmlspecialchars($post['title']) ?></h1>
        <p class="text-xs text-zinc-500">Published on <?= date('F j, Y', strtotime($post['published_at'])) ?></p>
    </div>

    <div class="prose prose-invert max-w-none text-zinc-300 leading-relaxed space-y-6 pt-6 border-t border-zinc-800">
        <?= $post['content'] ?>
    </div>
</article>
