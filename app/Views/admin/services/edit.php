<div class="max-w-4xl mx-auto space-y-6" x-data="{ pricingType: '<?= $service['pricing_type'] ?>', packages: <?= htmlspecialchars(json_encode(!empty($service['packages']) ? $service['packages'] : [['name' => '', 'price' => 0, 'description' => '']]), ENT_QUOTES, 'UTF-8') ?> }">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-white">Edit Service: <?= htmlspecialchars($service['title']) ?></h1>
        <a href="<?= BASE_URL ?>/admin/services" class="text-xs text-zinc-400 hover:underline">&larr; Back to Services</a>
    </div>

    <form action="<?= BASE_URL ?>/admin/services/update/<?= $service['id'] ?>" method="POST" enctype="multipart/form-data" class="bg-zinc-950 p-8 rounded-2xl border border-zinc-800 space-y-6">
        <?= \App\Core\CSRF::field() ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Service Title *</label>
                <input type="text" name="title" required value="<?= htmlspecialchars($service['title']) ?>" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
            </div>
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Duration</label>
                <input type="text" name="duration" value="<?= htmlspecialchars($service['duration']) ?>" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-zinc-400 mb-1">Description *</label>
            <textarea name="description" rows="3" required class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white"><?= htmlspecialchars($service['description']) ?></textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Pricing Model *</label>
                <select name="pricing_type" x-model="pricingType" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
                    <option value="package">Tiered Packages (Basic, Silver, Gold, Premium)</option>
                    <option value="simple">Fixed Simple Price</option>
                </select>
            </div>
            <div x-show="pricingType === 'simple'">
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Fixed Price (₹)</label>
                <input type="number" name="simple_price" step="0.01" value="<?= htmlspecialchars($service['simple_price']) ?>" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
            </div>
        </div>

        <!-- Dynamic Package Tier Builder -->
        <div x-show="pricingType === 'package'" class="space-y-4 pt-4 border-t border-zinc-800">
            <div class="flex justify-between items-center">
                <h4 class="font-bold text-white text-sm">Package Tiers Builder</h4>
                <button type="button" @click="packages.push({name: '', price: 0, description: ''})" class="text-xs text-rose-400 font-bold hover:underline">+ Add Tier</button>
            </div>

            <template x-for="(pkg, idx) in packages" :key="idx">
                <div class="p-4 rounded-xl bg-zinc-900 border border-zinc-800 space-y-3">
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" :name="'package_name['+idx+']'" x-model="pkg.name" placeholder="Tier Name (e.g. Gold Royal)" class="bg-zinc-950 border border-zinc-700 rounded-lg px-3 py-2 text-xs text-white">
                        <input type="number" :name="'package_price['+idx+']'" x-model="pkg.price" placeholder="Price" class="bg-zinc-950 border border-zinc-700 rounded-lg px-3 py-2 text-xs text-white">
                    </div>
                    <input type="text" :name="'package_desc['+idx+']'" x-model="pkg.description" placeholder="Tier Package Features & Descriptions" class="w-full bg-zinc-950 border border-zinc-700 rounded-lg px-3 py-2 text-xs text-white">
                </div>
            </template>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-zinc-800">
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Status</label>
                <select name="status" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
                    <option value="active" <?= $service['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="hidden" <?= $service['status'] === 'hidden' ? 'selected' : '' ?>>Hidden</option>
                </select>
            </div>
            <div class="flex items-center gap-3 pt-6">
                <input type="checkbox" name="is_featured" value="1" <?= $service['is_featured'] ? 'checked' : '' ?> class="w-4 h-4 text-rose-600 rounded bg-zinc-900 border-zinc-700 focus:ring-rose-500">
                <label class="text-xs font-semibold text-zinc-400">Featured Service on Homepage</label>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-zinc-400 mb-1">Update Cover Image</label>
            <input type="file" name="cover_image" class="text-xs text-zinc-400 block mb-2">
            <?php if (!empty($service['cover_image'])): ?>
                <div class="w-32 h-20 bg-zinc-900 rounded overflow-hidden border border-zinc-800">
                    <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($service['cover_image']) ?>" class="object-cover w-full h-full">
                </div>
            <?php endif; ?>
        </div>

        <button type="submit" class="w-full py-3.5 rounded-xl bg-rose-600 font-bold text-sm text-white hover:bg-rose-500 transition">Update Service Details</button>
    </form>
</div>
