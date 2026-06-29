<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <div class="text-center space-y-4">
        <span class="text-gold-400 font-bold text-xs uppercase tracking-widest">Client Love</span>
        <h1 class="font-serif text-4xl sm:text-5xl font-extrabold text-white">Loved By Hundreds Of Happy Brides</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <?php foreach ($reviews as $rev): ?>
            <div class="dark-glass-panel rounded-3xl p-8 border border-zinc-800 space-y-4" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center gap-1 text-gold-400">
                    <?php for ($i=0; $i<$rev['rating']; $i++): ?>
                        <i class="fa-solid fa-star text-sm"></i>
                    <?php endfor; ?>
                </div>
                <p class="text-zinc-300 text-sm leading-relaxed font-serif italic">"<?= htmlspecialchars($rev['review_text']) ?>"</p>
                <div class="pt-4 border-t border-zinc-800 flex justify-between items-center text-xs">
                    <span class="font-bold text-white"><?= htmlspecialchars($rev['client_name']) ?></span>
                    <span class="text-zinc-500"><?= htmlspecialchars($rev['client_role']) ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
