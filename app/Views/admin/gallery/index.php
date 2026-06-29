<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-white">Before & After Slider Manager</h1>
        <p class="text-sm text-zinc-400">Manage client makeover transformations with high-definition comparisons.</p>
    </div>

    <!-- Upload Form -->
    <form action="<?= BASE_URL ?>/admin/gallery/store" method="POST" enctype="multipart/form-data" class="bg-zinc-950 p-6 rounded-2xl border border-zinc-800 space-y-4">
        <?= \App\Core\CSRF::field() ?>
        <h3 class="font-bold text-white text-sm">Add New Transformation Pair</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <input type="text" name="title" placeholder="Transformation Title (e.g. Royal South Indian Bridal)" required class="bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2 text-xs text-white">
            <select name="category" class="bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2 text-xs text-white">
                <option value="Bridal Makeup">Bridal Makeup</option>
                <option value="Sangeet & Party">Sangeet & Party</option>
                <option value="Celebrity Look">Celebrity Look</option>
            </select>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs text-zinc-400 mb-1">Before Makeover (Optional)</label>
                <input type="file" name="before_image" class="text-xs text-zinc-400 block">
            </div>
            <div>
                <label class="block text-xs text-zinc-400 mb-1">After Makeover *</label>
                <input type="file" name="after_image" required class="text-xs text-zinc-400 block">
            </div>
        </div>
        <button type="submit" class="px-5 py-2.5 bg-rose-600 hover:bg-rose-500 rounded-xl text-xs font-bold text-white transition">Upload Pair</button>
    </form>

    <!-- Grid List -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($items as $item): ?>
            <div class="bg-zinc-950 p-4 rounded-2xl border border-zinc-800 space-y-3 flex flex-col justify-between">
                <div class="space-y-2">
                    <div class="grid grid-cols-2 gap-2 h-32">
                        <!-- Before image preview -->
                        <div class="bg-zinc-900 rounded overflow-hidden flex items-center justify-center text-[10px] text-zinc-500 border border-zinc-850">
                            <?php if ($item['before_image']): ?>
                                <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($item['before_image']) ?>" class="object-cover w-full h-full">
                            <?php else: ?>
                                <span>No Before Pic</span>
                            <?php endif; ?>
                        </div>
                        <!-- After image preview -->
                        <div class="bg-zinc-900 rounded overflow-hidden flex items-center justify-center text-[10px] text-zinc-500 border border-zinc-850">
                            <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($item['after_image']) ?>" class="object-cover w-full h-full">
                        </div>
                    </div>
                    <div>
                        <h4 class="font-bold text-white text-xs truncate"><?= htmlspecialchars($item['title']) ?></h4>
                        <span class="text-[10px] text-rose-400 block"><?= htmlspecialchars($item['category']) ?></span>
                    </div>
                </div>
                <a href="<?= BASE_URL ?>/admin/gallery/delete/<?= $item['id'] ?>" onclick="return confirm('Delete this transformation pair?')" class="text-xs text-rose-500 hover:underline">Delete Pair</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
