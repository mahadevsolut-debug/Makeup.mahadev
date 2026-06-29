<section class="py-16 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <div class="text-center space-y-4">
        <span class="text-rose-500 font-bold text-xs uppercase tracking-widest">Get In Touch</span>
        <h1 class="font-serif text-4xl sm:text-5xl font-extrabold text-white">Contact Our Studio</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="dark-glass-panel p-8 rounded-3xl border border-zinc-800 space-y-6">
            <h3 class="font-serif text-2xl font-bold text-white">Studio Coordinates</h3>
            <div class="space-y-4 text-sm text-zinc-300">
                <p><i class="fa-solid fa-location-dot text-rose-500 mr-2"></i> <?= htmlspecialchars($globalSettings['office_address'] ?? 'Studio Address') ?></p>
                <p><i class="fa-solid fa-phone text-rose-500 mr-2"></i> <?= htmlspecialchars($globalSettings['contact_phone'] ?? '+91 98765 43210') ?></p>
                <p><i class="fa-solid fa-envelope text-rose-500 mr-2"></i> <?= htmlspecialchars($globalSettings['contact_email'] ?? 'contact@makeupmahadev.com') ?></p>
            </div>
        </div>

        <div class="dark-glass-panel p-8 rounded-3xl border border-zinc-800">
            <form action="<?= BASE_URL ?>/contact/submit" method="POST" class="space-y-4">
                <?= \App\Core\CSRF::field() ?>
                <div>
                    <label class="block text-xs font-semibold text-zinc-400 mb-1">Your Name</label>
                    <input type="text" name="name" required class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-400 mb-1">Your Email</label>
                    <input type="email" name="email" required class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-400 mb-1">Message</label>
                    <textarea name="message" rows="4" required class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white"></textarea>
                </div>
                <button type="submit" class="w-full py-3 rounded-xl bg-rose-600 font-bold text-sm text-white hover:bg-rose-500 transition">Send Message</button>
            </form>
        </div>
    </div>
</section>
