<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-white">Booking Requests Manager</h1>
    </div>

    <div class="bg-zinc-950 rounded-2xl border border-zinc-800 p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-zinc-300">
                <thead class="bg-zinc-900 text-zinc-400 uppercase">
                    <tr>
                        <th class="p-3">Code</th>
                        <th class="p-3">Client</th>
                        <th class="p-3">Phone</th>
                        <th class="p-3">Event Date</th>
                        <th class="p-3">Total Estimated</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    <?php if (empty($bookings)): ?>
                        <tr>
                            <td colspan="7" class="p-6 text-center text-zinc-500">No booking requests found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($bookings as $b): ?>
                            <tr>
                                <td class="p-3 font-mono text-amber-400 font-bold"><?= htmlspecialchars($b['booking_code']) ?></td>
                                <td class="p-3 font-semibold text-white"><?= htmlspecialchars($b['customer_name']) ?></td>
                                <td class="p-3"><?= htmlspecialchars($b['customer_phone']) ?></td>
                                <td class="p-3"><?= htmlspecialchars($b['event_date']) ?></td>
                                <td class="p-3 font-bold text-white">₹<?= number_format($b['total_price'], 2) ?></td>
                                <td class="p-3 font-bold capitalize text-rose-400"><?= htmlspecialchars($b['status']) ?></td>
                                <td class="p-3"><a href="<?= BASE_URL ?>/admin/bookings/view/<?= $b['id'] ?>" class="text-xs text-rose-400 hover:underline">View Details</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
