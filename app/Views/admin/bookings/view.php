<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-white">Booking #<?= htmlspecialchars($booking['booking_code']) ?></h1>
        <a href="<?= BASE_URL ?>/admin/bookings" class="text-xs text-zinc-400 hover:underline">&larr; Back to Requests</a>
    </div>

    <div class="bg-zinc-950 p-8 rounded-2xl border border-zinc-800 space-y-6 text-sm">
        <div class="grid grid-cols-2 gap-4 border-b border-zinc-800 pb-4">
            <div>
                <span class="text-xs text-zinc-500 block">Customer Name</span>
                <strong class="text-white text-base"><?= htmlspecialchars($booking['customer_name']) ?></strong>
            </div>
            <div>
                <span class="text-xs text-zinc-500 block">Contact</span>
                <span class="text-zinc-300"><?= htmlspecialchars($booking['customer_phone']) ?> | <?= htmlspecialchars($booking['customer_email']) ?></span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 border-b border-zinc-800 pb-4">
            <div>
                <span class="text-xs text-zinc-500 block">Event Date & Time</span>
                <span class="text-zinc-300 font-bold"><?= htmlspecialchars($booking['event_date']) ?> at <?= htmlspecialchars($booking['event_time']) ?></span>
            </div>
            <div>
                <span class="text-xs text-zinc-500 block">Location</span>
                <span class="text-zinc-300"><?= htmlspecialchars($booking['location']) ?></span>
            </div>
        </div>

        <div class="space-y-2">
            <span class="text-xs text-zinc-500 block">Service & Package</span>
            <p class="font-bold text-white"><?= htmlspecialchars($booking['service_title']) ?> (<?= htmlspecialchars($booking['package_name'] ?? 'Simple Pricing') ?>)</p>
        </div>

        <?php if (!empty($booking['addons'])): ?>
            <div class="space-y-2 border-t border-zinc-800 pt-4">
                <span class="text-xs text-zinc-500 block">Selected Add-ons</span>
                <ul class="list-disc list-inside text-xs text-zinc-300">
                    <?php foreach ($booking['addons'] as $ad): ?>
                        <li><?= htmlspecialchars($ad['name']) ?> (+₹<?= number_format($ad['price_at_booking'], 2) ?>)</li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="border-t border-zinc-800 pt-4 flex justify-between items-center">
            <span class="font-bold text-white text-lg">Total Amount:</span>
            <span class="text-2xl font-extrabold text-amber-400">₹<?= number_format($booking['total_price'], 2) ?></span>
        </div>

        <!-- Status Update Form -->
        <form action="<?= BASE_URL ?>/admin/bookings/update-status/<?= $booking['id'] ?>" method="POST" class="border-t border-zinc-800 pt-6 flex items-center gap-4">
            <?= \App\Core\CSRF::field() ?>
            <label class="text-xs font-bold text-zinc-400">Update Status:</label>
            <select name="status" class="bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2 text-xs text-white">
                <option value="pending" <?= $booking['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="confirmed" <?= $booking['status'] === 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                <option value="completed" <?= $booking['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                <option value="cancelled" <?= $booking['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
            </select>
            <button type="submit" class="px-4 py-2 rounded-xl bg-rose-600 font-bold text-xs text-white hover:bg-rose-500 transition">Update</button>
        </form>
    </div>
</div>
