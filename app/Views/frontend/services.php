<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <div class="text-center space-y-4">
        <span class="text-rose-500 font-bold text-xs uppercase tracking-widest">Pricing & Packages</span>
        <h1 class="font-serif text-4xl sm:text-5xl font-extrabold text-white">Bespoke Makeover Catalog</h1>
        <p class="text-zinc-400 text-sm max-w-2xl mx-auto">Discover our curated beauty offerings engineered for longevity, high definition photography, and effortless glamour.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($services as $srv): ?>
            <div class="dark-glass-panel rounded-3xl overflow-hidden border border-zinc-800 p-8 flex flex-col justify-between hover:border-rose-500/40 transition">
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-semibold px-3 py-1 rounded-full bg-rose-950 text-rose-300 border border-rose-800">
                            <?= htmlspecialchars($srv['category_name'] ?? 'General') ?>
                        </span>
                        <span class="text-xs text-zinc-400"><i class="fa-regular fa-clock"></i> <?= htmlspecialchars($srv['duration']) ?></span>
                    </div>

                    <h3 class="font-serif text-2xl font-bold text-white"><?= htmlspecialchars($srv['title']) ?></h3>
                    <p class="text-zinc-400 text-sm leading-relaxed"><?= htmlspecialchars($srv['description']) ?></p>
                </div>

                <div class="pt-6 mt-6 border-t border-zinc-800 flex items-center justify-between">
                    <span class="text-xs text-zinc-400 block">Starting From <strong class="text-amber-400 text-lg block font-bold"><?= htmlspecialchars($globalSettings['currency_symbol'] ?? '₹') ?><?= number_format($srv['simple_price'] > 0 ? $srv['simple_price'] : 15000) ?></strong></span>
                    <a href="<?= BASE_URL ?>/booking?service=<?= $srv['id'] ?>" class="px-5 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-bold text-xs transition">
                        Select & Customize
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
