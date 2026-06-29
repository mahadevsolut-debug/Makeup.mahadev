<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-white">Services & Pricing Manager</h1>
            <p class="text-sm text-zinc-400">Add or edit dynamically calculated services, tiered packages, and add-ons.</p>
        </div>
        <a href="<?= BASE_URL ?>/admin/services/create" class="px-4 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-bold text-xs transition flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Create New Service
        </a>
    </div>

    <div class="bg-zinc-950 rounded-2xl border border-zinc-800 p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-zinc-300">
                <thead class="bg-zinc-900 text-zinc-400 uppercase">
                    <tr>
                        <th class="p-3">Title</th>
                        <th class="p-3">Pricing Model</th>
                        <th class="p-3">Duration</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    <?php foreach ($services as $srv): ?>
                        <tr>
                            <td class="p-3 font-bold text-white"><?= htmlspecialchars($srv['title']) ?></td>
                            <td class="p-3 capitalize text-amber-400"><?= htmlspecialchars($srv['pricing_type']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($srv['duration']) ?></td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded-full text-[10px] uppercase font-bold bg-emerald-950 text-emerald-400 border border-emerald-800">
                                    <?= htmlspecialchars($srv['status']) ?>
                                </span>
                            </td>
                            <td class="p-3 flex gap-3">
                                <a href="<?= BASE_URL ?>/admin/services/edit/<?= $srv['id'] ?>" class="text-amber-400 hover:underline">Edit</a>
                                <a href="<?= BASE_URL ?>/admin/services/delete/<?= $srv['id'] ?>" onclick="return confirm('Are you sure?')" class="text-rose-400 hover:underline">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
