<div class="max-w-4xl mx-auto space-y-6" x-data="settingsForm()">
    <div>
        <h1 class="text-3xl font-bold text-white">Website & SaaS Configuration Panel</h1>
        <p class="text-sm text-zinc-400">Manage brand identity, theme configurations, contact coordinates, and email credentials.</p>
    </div>

    <form action="<?= BASE_URL ?>/admin/settings/save" method="POST" enctype="multipart/form-data" class="bg-zinc-950 p-8 rounded-2xl border border-zinc-800 space-y-8">
        <?= \App\Core\CSRF::field() ?>

        <!-- Brand Identity: Name & Tagline -->
        <div class="space-y-4">
            <h3 class="font-serif text-lg font-bold text-white border-b border-zinc-800 pb-2">1. Brand Identity</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-zinc-400 mb-1">Studio / Brand Name</label>
                    <input type="text" name="settings[site_name]" value="<?= htmlspecialchars($settings['site_name'] ?? 'Makeup.mahadev') ?>" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white focus:border-rose-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-400 mb-1">Website Title (SEO)</label>
                    <input type="text" name="settings[site_title]" value="<?= htmlspecialchars($settings['site_title'] ?? '') ?>" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white focus:border-rose-500 focus:outline-none">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Brand Tagline</label>
                <input type="text" name="settings[site_tagline]" value="<?= htmlspecialchars($settings['site_tagline'] ?? '') ?>" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white focus:border-rose-500 focus:outline-none">
            </div>
        </div>

        <!-- Custom Styling & Theme Colors -->
        <div class="space-y-4">
            <h3 class="font-serif text-lg font-bold text-white border-b border-zinc-800 pb-2">2. Color Theme Settings</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-zinc-400 mb-2">Primary Color (Hex)</label>
                    <div class="flex gap-2">
                        <input type="color" x-model="colors.primary" class="w-10 h-10 border-0 bg-transparent cursor-pointer rounded-lg">
                        <input type="text" name="settings[primary_color]" x-model="colors.primary" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-3 py-2 text-sm text-white focus:border-rose-500 focus:outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-400 mb-2">Secondary Color (Hex)</label>
                    <div class="flex gap-2">
                        <input type="color" x-model="colors.secondary" class="w-10 h-10 border-0 bg-transparent cursor-pointer rounded-lg">
                        <input type="text" name="settings[secondary_color]" x-model="colors.secondary" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-3 py-2 text-sm text-white focus:border-rose-500 focus:outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-400 mb-2">Accent Highlight (Hex)</label>
                    <div class="flex gap-2">
                        <input type="color" x-model="colors.accent" class="w-10 h-10 border-0 bg-transparent cursor-pointer rounded-lg">
                        <input type="text" name="settings[accent_color]" x-model="colors.accent" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-3 py-2 text-sm text-white focus:border-rose-500 focus:outline-none">
                    </div>
                </div>
            </div>
        </div>

        <!-- Branding Assets (Logo & Hero) -->
        <div class="space-y-4">
            <h3 class="font-serif text-lg font-bold text-white border-b border-zinc-800 pb-2">3. Branding Media Assets</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Site Logo -->
                <div class="space-y-3">
                    <label class="block text-xs font-semibold text-zinc-400 mb-1">Studio Logo File</label>
                    <div class="p-4 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-between gap-4">
                        <div class="w-20 h-20 rounded bg-zinc-950 flex items-center justify-center overflow-hidden border border-zinc-800">
                            <template x-if="logoPreview">
                                <img :src="logoPreview" class="object-contain w-full h-full">
                            </template>
                            <template x-if="!logoPreview">
                                <span class="text-[10px] text-zinc-600">No Logo</span>
                            </template>
                        </div>
                        <div class="flex-1">
                            <input type="file" name="site_logo" @change="logoChange" class="text-xs text-zinc-400 block w-full">
                            <span class="text-[10px] text-zinc-500 mt-1 block">Preferred: PNG/WEBP with transparent bg.</span>
                        </div>
                    </div>
                </div>
                <!-- Hero Image -->
                <div class="space-y-3">
                    <label class="block text-xs font-semibold text-zinc-400 mb-1">Homepage Hero/Cover Image</label>
                    <div class="p-4 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-between gap-4">
                        <div class="w-20 h-20 rounded bg-zinc-950 flex items-center justify-center overflow-hidden border border-zinc-800">
                            <template x-if="heroPreview">
                                <img :src="heroPreview" class="object-cover w-full h-full">
                            </template>
                            <template x-if="!heroPreview">
                                <span class="text-[10px] text-zinc-600">No Image</span>
                            </template>
                        </div>
                        <div class="flex-1">
                            <input type="file" name="hero_image" @change="heroChange" class="text-xs text-zinc-400 block w-full">
                            <span class="text-[10px] text-zinc-500 mt-1 block">Preferred: high-res horizontal landscape.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Homepage Hero Content -->
        <div class="space-y-4">
            <h3 class="font-serif text-lg font-bold text-white border-b border-zinc-800 pb-2">4. Hero Settings</h3>
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Hero Title Heading</label>
                <input type="text" name="settings[hero_heading]" value="<?= htmlspecialchars($settings['hero_heading'] ?? '') ?>" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white focus:border-rose-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Hero Subheading</label>
                <textarea name="settings[hero_subheading]" rows="2" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white focus:border-rose-500 focus:outline-none"><?= htmlspecialchars($settings['hero_subheading'] ?? '') ?></textarea>
            </div>
        </div>

        <!-- Contact & Locations -->
        <div class="space-y-4">
            <h3 class="font-serif text-lg font-bold text-white border-b border-zinc-800 pb-2">5. Contact Coordinates</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-zinc-400 mb-1">Studio Alert Email</label>
                    <input type="email" name="settings[contact_email]" value="<?= htmlspecialchars($settings['contact_email'] ?? 'contact@makeupmahadev.com') ?>" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white focus:border-rose-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-400 mb-1">WhatsApp Senders Number</label>
                    <input type="text" name="settings[whatsapp_number]" value="<?= htmlspecialchars($settings['whatsapp_number'] ?? '919876543210') ?>" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white focus:border-rose-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-zinc-400 mb-1">Phone Number</label>
                    <input type="text" name="settings[contact_phone]" value="<?= htmlspecialchars($settings['contact_phone'] ?? '+91 98765 43210') ?>" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white focus:border-rose-500 focus:outline-none">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Studio Physical Address</label>
                <textarea name="settings[office_address]" rows="2" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white focus:border-rose-500 focus:outline-none"><?= htmlspecialchars($settings['office_address'] ?? 'Studio Address') ?></textarea>
            </div>
        </div>

        <button type="submit" class="w-full py-4 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-bold text-sm shadow-xl shadow-rose-900/40 transition">
            Save Customizations
        </button>
    </form>
</div>

<script>
function settingsForm() {
    return {
        colors: {
            primary: '<?= htmlspecialchars($settings['primary_color'] ?? "#e11d48") ?>',
            secondary: '<?= htmlspecialchars($settings['secondary_color'] ?? "#881337") ?>',
            accent: '<?= htmlspecialchars($settings['accent_color'] ?? "#fbbf24") ?>'
        },
        logoPreview: '<?= !empty($settings['site_logo']) ? BASE_URL . "/uploads/" . htmlspecialchars($settings['site_logo']) : "" ?>',
        heroPreview: '<?= !empty($settings['hero_image']) ? BASE_URL . "/uploads/" . htmlspecialchars($settings['hero_image']) : "" ?>',
        logoChange(e) {
            const file = e.target.files[0];
            if (file) {
                this.logoPreview = URL.createObjectURL(file);
            }
        },
        heroChange(e) {
            const file = e.target.files[0];
            if (file) {
                this.heroPreview = URL.createObjectURL(file);
            }
        }
    }
}
</script>
