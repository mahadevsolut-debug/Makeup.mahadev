<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <div class="text-center space-y-4" data-aos="fade-up">
        <span class="text-brand-500 font-bold text-xs uppercase tracking-widest">Bridal & Celebrity Portfolio</span>
        <h1 class="font-serif text-4xl sm:text-5xl font-extrabold text-white">Our Masterpiece Lookbook</h1>
        <p class="text-zinc-400 text-sm max-w-2xl mx-auto">Explore high-resolution captures of our royal brides and high-fashion makeover clients.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($items as $item): ?>
            <div class="dark-glass-panel rounded-3xl overflow-hidden border border-zinc-800 group hover:scale-[1.02] transition duration-300" data-aos="fade-up" data-aos-delay="100">
                <div class="h-72 bg-zinc-900 overflow-hidden relative flex items-center justify-center text-zinc-650">
                    <i class="fa-solid fa-camera text-4xl"></i>
                    <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-transparent to-transparent opacity-80"></div>
                    <span class="absolute bottom-4 left-4 text-xs font-bold px-3 py-1 rounded-full bg-brand-500 text-white">
                        <?= htmlspecialchars($item['category']) ?>
                    </span>
                </div>
                <div class="p-6 space-y-2">
                    <h3 class="font-serif text-xl font-bold text-white"><?= htmlspecialchars($item['title']) ?></h3>
                    <?php if ($item['client_name']): ?>
                        <p class="text-xs text-gold-400 font-medium">Client: <?= htmlspecialchars($item['client_name']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
