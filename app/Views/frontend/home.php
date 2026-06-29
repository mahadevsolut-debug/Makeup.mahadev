<!-- Hero Section -->
<section class="relative min-h-[85vh] flex items-center justify-center overflow-hidden py-20 px-4 bg-cover bg-center" style="background-image: url('<?= !empty($globalSettings['hero_image']) ? BASE_URL . '/uploads/' . htmlspecialchars($globalSettings['hero_image']) : '' ?>');">
    <div class="absolute inset-0 bg-gradient-to-br from-black/60 via-zinc-950/80 to-black/60 z-0"></div>
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-gold-500/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10 max-w-5xl mx-auto text-center space-y-8">
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-900/40 border border-brand-500/30 text-brand-300 text-xs tracking-widest uppercase font-semibold">
            <i class="fa-solid fa-crown text-gold-400"></i> Luxury Bridal Artistry
        </span>

        <h1 class="font-serif text-5xl sm:text-7xl font-extrabold text-white tracking-tight leading-tight">
            <?= htmlspecialchars($globalSettings['hero_heading'] ?? 'Timeless Beauty & Elegance Redefined') ?>
        </h1>

        <p class="text-zinc-400 text-lg sm:text-xl max-w-3xl mx-auto leading-relaxed">
            <?= htmlspecialchars($globalSettings['hero_subheading'] ?? 'Book award-winning bridal, party, and luxury HD makeup services crafted for your special moments.') ?>
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
            <a href="<?= BASE_URL ?>/booking" class="w-full sm:w-auto px-8 py-4 rounded-full bg-gradient-to-r from-brand-500 to-brand-700 hover:from-brand-600 hover:to-brand-700 text-white font-bold text-base shadow-xl shadow-brand-900/50 hover:shadow-brand-600/50 hover:-translate-y-1 transition duration-300 flex items-center justify-center gap-3">
                <span><?= htmlspecialchars($globalSettings['cta_booking_text'] ?? 'Reserve Your Date') ?></span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="<?= BASE_URL ?>/portfolio" class="w-full sm:w-auto px-8 py-4 rounded-full bg-zinc-900/80 hover:bg-zinc-800 text-zinc-200 border border-zinc-700 font-semibold text-base transition">
                Explore Lookbook
            </a>
        </div>
    </div>
</section>

<!-- Featured Services Section -->
<section class="py-24 bg-zinc-900/60 border-t border-b border-zinc-800/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        <div class="text-center space-y-4" data-aos="fade-up">
            <span class="text-brand-500 font-bold text-xs uppercase tracking-widest">Signature Packages</span>
            <h2 class="font-serif text-4xl font-bold text-white">Our Featured Makeover Experiences</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($featured_services as $service): ?>
                <div class="dark-glass-panel rounded-3xl overflow-hidden group hover:border-brand-500/40 transition duration-300 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-8 space-y-6">
                        <div class="flex justify-between items-start">
                            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-brand-900/50 text-brand-300 border border-brand-700/50">
                                <?= htmlspecialchars($service['category_name'] ?? 'Makeup') ?>
                            </span>
                            <span class="text-xs text-zinc-400 font-medium">
                                <i class="fa-regular fa-clock mr-1"></i> <?= htmlspecialchars($service['duration']) ?>
                            </span>
                        </div>

                        <h3 class="font-serif text-2xl font-bold text-white group-hover:text-brand-500 transition">
                            <?= htmlspecialchars($service['title']) ?>
                        </h3>

                        <p class="text-zinc-400 text-sm leading-relaxed line-clamp-3">
                            <?= htmlspecialchars($service['description']) ?>
                        </p>
                    </div>

                    <div class="p-8 pt-0 flex items-center justify-between border-t border-zinc-800/60 mt-6">
                        <div>
                            <span class="text-xs text-zinc-400 block">Starting From</span>
                            <span class="text-xl font-bold text-gold-400">
                                <?= htmlspecialchars($globalSettings['currency_symbol'] ?? '₹') ?><?= number_format($service['simple_price'] > 0 ? $service['simple_price'] : 15000) ?>
                            </span>
                        </div>
                        <a href="<?= BASE_URL ?>/booking?service=<?= $service['id'] ?>" class="px-4 py-2 rounded-xl bg-brand-500/20 hover:bg-brand-500 text-brand-300 hover:text-white text-xs font-bold transition">
                            Book Package
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Before/After & Transformation Section -->
<section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-6" data-aos="fade-right">
            <span class="text-gold-400 font-bold text-xs uppercase tracking-widest">Artistry in Action</span>
            <h2 class="font-serif text-4xl font-bold text-white leading-tight">Flawless HD Skin finish with tailored aesthetics.</h2>
            <p class="text-zinc-400 text-base leading-relaxed">
                We believe makeup should enhance your unique facial contours, not mask them. Every makeover starts with bespoke skin preparation followed by premium airbrush and high-definition techniques that stay radiant through 16+ hours of celebration.
            </p>
            <div class="pt-4 flex gap-6 text-zinc-300 text-sm">
                <div>
                    <h4 class="font-serif text-3xl font-bold text-white">500+</h4>
                    <p class="text-xs text-zinc-500">Happy Brides</p>
                </div>
                <div class="border-l border-zinc-800 pl-6">
                    <h4 class="font-serif text-3xl font-bold text-white">100%</h4>
                    <p class="text-xs text-zinc-500">HD Waterproof</p>
                </div>
            </div>
        </div>

        <div class="dark-glass-panel p-6 rounded-3xl border border-zinc-800 text-center space-y-4" data-aos="fade-left">
            <div class="w-full h-80 rounded-2xl bg-zinc-900 flex items-center justify-center border border-zinc-800 text-zinc-500">
                <div class="space-y-2">
                    <i class="fa-solid fa-wand-magic text-4xl text-brand-500"></i>
                    <p class="text-xs">Transformation Spotlight Gallery</p>
                </div>
            </div>
        </div>
    </div>
</section>
