<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <div class="text-center space-y-4">
        <span class="text-brand-500 font-bold text-xs uppercase tracking-widest">Before & After Magic</span>
        <h1 class="font-serif text-4xl sm:text-5xl font-extrabold text-white">Skin & Feature Transformation Gallery</h1>
        <p class="text-zinc-400 text-sm max-w-2xl mx-auto">Slide to explore natural skin texture preservation with full waterproof HD bridal coverages.</p>
    </div>

    <?php if (empty($items)): ?>
        <div class="p-12 rounded-3xl dark-glass-panel border border-zinc-800 text-center text-zinc-500">
            <i class="fa-solid fa-wand-magic-sparkles text-4xl text-zinc-700 mb-2"></i>
            <p>No transformations uploaded yet. Check back soon for beautiful makeover highlights!</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php foreach ($items as $item): ?>
                <div class="dark-glass-panel rounded-3xl p-6 border border-zinc-800 space-y-4 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                    <!-- Before/After Slider Container -->
                    <div x-data="{ sliderPos: 50 }" class="relative w-full h-[400px] overflow-hidden rounded-2xl border border-zinc-800 select-none">
                        
                        <!-- Before Image -->
                        <?php if ($item['before_image']): ?>
                            <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($item['before_image']) ?>" class="absolute inset-0 w-full h-full object-cover">
                            <span class="absolute top-4 left-4 z-10 text-[10px] font-bold uppercase tracking-wider bg-black/60 px-3 py-1 rounded-full text-white">Before</span>
                        <?php else: ?>
                            <div class="absolute inset-0 bg-zinc-900 flex items-center justify-center text-zinc-650 text-xs">No Before Image</div>
                        <?php endif; ?>
                        
                        <!-- After Image (clipped) -->
                        <div class="absolute inset-y-0 left-0 right-0 overflow-hidden" :style="'right: ' + (100 - sliderPos) + '%'">
                            <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($item['after_image']) ?>" class="absolute inset-0 w-full h-full object-cover" :style="'width: ' + $el.parentElement.offsetWidth + 'px; max-width: none;'">
                            <span class="absolute top-4 right-4 z-10 text-[10px] font-bold uppercase tracking-wider bg-brand-500/80 px-3 py-1 rounded-full text-white" :style="'transform: translateX(' + (100 - sliderPos) + '%)'">After Makeover</span>
                        </div>
                        
                        <!-- Slider Handle Line & Button -->
                        <div class="absolute inset-y-0 w-1 bg-white cursor-ew-resize flex items-center justify-center z-10" :style="'left: ' + sliderPos + '%'">
                            <div class="w-8 h-8 rounded-full bg-brand-500 text-white flex items-center justify-center shadow-lg border border-white text-xs hover:scale-110 transition duration-150">
                                <i class="fa-solid fa-arrows-left-right"></i>
                            </div>
                        </div>
                        
                        <!-- Invisible Range Input Overlay -->
                        <input type="range" min="0" max="100" x-model="sliderPos" class="absolute inset-0 w-full h-full opacity-0 cursor-ew-resize z-20">
                    </div>
                    
                    <div class="space-y-1">
                        <span class="text-[10px] text-brand-500 font-bold uppercase tracking-wider"><?= htmlspecialchars($item['category']) ?></span>
                        <h3 class="font-serif text-xl font-bold text-white"><?= htmlspecialchars($item['title']) ?></h3>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
