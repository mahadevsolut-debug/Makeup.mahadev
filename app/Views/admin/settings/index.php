<div class="max-w-4xl mx-auto space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-white">Website & SaaS Configuration Panel</h1>
        <p class="text-sm text-zinc-400">Manage shop credentials, studio phone, WhatsApp number, and email alert addresses.</p>
    </div>

    <form action="<?= BASE_URL ?>/admin/settings/save" method="POST" class="bg-zinc-950 p-8 rounded-2xl border border-zinc-800 space-y-6">
        <?= \App\Core\CSRF::field() ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Studio / Brand Name</label>
                <input type="text" name="settings[site_name]" value="<?= htmlspecialchars($settings['site_name'] ?? 'Makeup.mahadev') ?>" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
            </div>
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">WhatsApp Floating Number (With Country Code)</label>
                <input type="text" name="settings[whatsapp_number]" value="<?= htmlspecialchars($settings['whatsapp_number'] ?? '919876543210') ?>" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Contact Phone Number</label>
                <input type="text" name="settings[contact_phone]" value="<?= htmlspecialchars($settings['contact_phone'] ?? '+91 98765 43210') ?>" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
            </div>
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Studio Alert Email</label>
                <input type="email" name="settings[contact_email]" value="<?= htmlspecialchars($settings['contact_email'] ?? 'contact@makeupmahadev.com') ?>" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-zinc-400 mb-1">Studio Physical Address</label>
            <textarea name="settings[office_address]" rows="2" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white"><?= htmlspecialchars($settings['office_address'] ?? 'Studio Address') ?></textarea>
        </div>

        <button type="submit" class="w-full py-3.5 rounded-xl bg-rose-600 font-bold text-sm text-white hover:bg-rose-500 transition">Save Website Settings</button>
    </form>
</div>
