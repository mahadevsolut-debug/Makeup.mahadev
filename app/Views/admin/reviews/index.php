<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-white">Client Testimonials Moderation</h1>
            <p class="text-sm text-zinc-400">Moderate site reviews or manually publish verified feedback from Google and WhatsApp.</p>
        </div>
    </div>

    <!-- Manual Testimony Upload -->
    <form action="<?= BASE_URL ?>/admin/reviews/store" method="POST" class="bg-zinc-950 p-6 rounded-2xl border border-zinc-800 space-y-4">
        <?= \App\Core\CSRF::field() ?>
        <h3 class="font-bold text-white text-sm">Write Manual Testimonial</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <input type="text" name="client_name" placeholder="Client Name (e.g. Ananya Sen)" required class="bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-xs text-white">
            <input type="text" name="client_role" placeholder="Client Role (e.g. Sangeet Bride)" class="bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-xs text-white">
            <select name="rating" class="bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-xs text-white">
                <option value="5">⭐⭐⭐⭐⭐ (5 Stars)</option>
                <option value="4">⭐⭐⭐⭐ (4 Stars)</option>
                <option value="3">⭐⭐⭐ (3 Stars)</option>
            </select>
        </div>
        <div>
            <textarea name="review_text" rows="3" placeholder="Verify testimony feedback text..." required class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-xs text-white"></textarea>
        </div>
        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_featured" value="1" class="w-4 h-4 text-rose-600 rounded bg-zinc-900 border-zinc-700">
            <label class="text-xs text-zinc-400">Pin as Featured Testimonial on Homepage</label>
        </div>
        <button type="submit" class="px-5 py-2 bg-rose-600 hover:bg-rose-500 rounded-xl text-xs font-bold text-white transition">Publish Review</button>
    </form>

    <!-- Testimonials List Table -->
    <div class="bg-zinc-950 rounded-2xl border border-zinc-800 p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-zinc-300">
                <thead class="bg-zinc-900 text-zinc-400 uppercase">
                    <tr>
                        <th class="p-3">Client</th>
                        <th class="p-3">Role</th>
                        <th class="p-3">Rating</th>
                        <th class="p-3">Feedback</th>
                        <th class="p-3">Featured</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    <?php if (empty($reviews)): ?>
                        <tr>
                            <td colspan="7" class="p-6 text-center text-zinc-500">No testimonials found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($reviews as $rev): ?>
                            <tr>
                                <td class="p-3 font-bold text-white"><?= htmlspecialchars($rev['client_name']) ?></td>
                                <td class="p-3"><?= htmlspecialchars($rev['client_role']) ?></td>
                                <td class="p-3 text-amber-400"><?= str_repeat('⭐', $rev['rating']) ?></td>
                                <td class="p-3 max-w-xs truncate" title="<?= htmlspecialchars($rev['review_text']) ?>"><?= htmlspecialchars($rev['review_text']) ?></td>
                                <td class="p-3">
                                    <a href="<?= BASE_URL ?>/admin/reviews/toggle-featured/<?= $rev['id'] ?>" class="px-2 py-1 rounded text-[10px] font-bold 
                                        <?= $rev['is_featured'] ? 'bg-amber-950 text-amber-400 border border-amber-800' : 'bg-zinc-800 text-zinc-400' ?>">
                                        <?= $rev['is_featured'] ? 'Featured' : 'Standard' ?>
                                    </a>
                                </td>
                                <td class="p-3 font-bold uppercase <?= $rev['status'] === 'approved' ? 'text-emerald-400' : 'text-amber-500' ?>">
                                    <?= htmlspecialchars($rev['status']) ?>
                                </td>
                                <td class="p-3 flex gap-2">
                                    <?php if ($rev['status'] === 'pending'): ?>
                                        <a href="<?= BASE_URL ?>/admin/reviews/approve/<?= $rev['id'] ?>" class="text-emerald-400 hover:underline">Approve</a>
                                    <?php else: ?>
                                        <a href="<?= BASE_URL ?>/admin/reviews/disapprove/<?= $rev['id'] ?>" class="text-zinc-400 hover:underline">Unapprove</a>
                                    <?php endif; ?>
                                    <a href="<?= BASE_URL ?>/admin/reviews/delete/<?= $rev['id'] ?>" onclick="return confirm('Delete review?')" class="text-rose-400 hover:underline">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
