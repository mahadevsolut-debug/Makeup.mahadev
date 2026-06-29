<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-white">Beauty Blog Manager</h1>
            <p class="text-sm text-zinc-400">Write, edit, publish skincare tips, and bridal trends.</p>
        </div>
        <a href="<?= BASE_URL ?>/admin/blogs/create" class="px-4 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-bold text-xs transition flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Write Article
        </a>
    </div>

    <div class="bg-zinc-950 rounded-2xl border border-zinc-800 p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-zinc-300">
                <thead class="bg-zinc-900 text-zinc-400 uppercase">
                    <tr>
                        <th class="p-3">Title</th>
                        <th class="p-3">Category</th>
                        <th class="p-3">Views</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Published Date</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    <?php if (empty($posts)): ?>
                        <tr>
                            <td colspan="6" class="p-6 text-center text-zinc-500">No blog posts found. Click "Write Article" to publish your first post.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($posts as $post): ?>
                            <tr>
                                <td class="p-3 font-bold text-white"><?= htmlspecialchars($post['title']) ?></td>
                                <td class="p-3"><?= htmlspecialchars($post['category_name'] ?? 'Uncategorized') ?></td>
                                <td class="p-3"><i class="fa-regular fa-eye mr-1"></i> <?= htmlspecialchars($post['views_count'] ?? 0) ?></td>
                                <td class="p-3">
                                    <span class="px-2 py-1 rounded-full text-[10px] uppercase font-bold 
                                        <?= $post['status'] === 'published' ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : 'bg-zinc-800 text-zinc-400' ?>">
                                        <?= htmlspecialchars($post['status']) ?>
                                    </span>
                                </td>
                                <td class="p-3"><?= date('F j, Y', strtotime($post['published_at'])) ?></td>
                                <td class="p-3 flex gap-3">
                                    <a href="<?= BASE_URL ?>/admin/blogs/edit/<?= $post['id'] ?>" class="text-amber-400 hover:underline">Edit</a>
                                    <a href="<?= BASE_URL ?>/admin/blogs/delete/<?= $post['id'] ?>" onclick="return confirm('Are you sure you want to delete this article?')" class="text-rose-400 hover:underline">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
