<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-bold text-white">Dashboard Overview</h1>
        <p class="text-sm text-zinc-400">Real-time telemetry and management modules for Makeup.mahadev SaaS.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-zinc-950 p-6 rounded-2xl border border-zinc-800 space-y-2">
            <span class="text-xs text-zinc-400 uppercase font-semibold">Total Bookings</span>
            <h3 class="text-3xl font-extrabold text-white"><?= $total_bookings ?></h3>
        </div>
        <div class="bg-zinc-950 p-6 rounded-2xl border border-zinc-800 space-y-2">
            <span class="text-xs text-zinc-400 uppercase font-semibold">Pending Approvals</span>
            <h3 class="text-3xl font-extrabold text-amber-400"><?= $pending_count ?></h3>
        </div>
        <div class="bg-zinc-950 p-6 rounded-2xl border border-zinc-800 space-y-2">
            <span class="text-xs text-zinc-400 uppercase font-semibold">Confirmed Revenue</span>
            <h3 class="text-3xl font-extrabold text-emerald-400">₹<?= number_format($total_revenue, 2) ?></h3>
        </div>
        <div class="bg-zinc-950 p-6 rounded-2xl border border-zinc-800 space-y-2">
            <span class="text-xs text-zinc-400 uppercase font-semibold">Active Services</span>
            <h3 class="text-3xl font-extrabold text-purple-400"><?= $total_services ?></h3>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="bg-zinc-950 rounded-2xl border border-zinc-800 p-6 space-y-4">
        <div class="flex justify-between items-center">
            <h3 class="text-xl font-bold text-white">Recent Booking Requests</h3>
            <a href="<?= BASE_URL ?>/admin/bookings" class="text-xs text-rose-400 hover:underline">View All</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-zinc-300">
                <thead class="bg-zinc-900 text-zinc-400 uppercase">
                    <tr>
                        <th class="p-3">Code</th>
                        <th class="p-3">Client</th>
                        <th class="p-3">Service</th>
                        <th class="p-3">Event Date</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    <?php foreach ($recent_bookings as $b): ?>
                        <tr>
                            <td class="p-3 font-mono text-amber-400 font-bold"><?= htmlspecialchars($b['booking_code']) ?></td>
                            <td class="p-3 font-semibold text-white"><?= htmlspecialchars($b['customer_name']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($b['service_title']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($b['event_date']) ?></td>
                            <td class="p-3 font-bold text-white">₹<?= number_format($b['total_price'], 2) ?></td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded-full text-[10px] uppercase font-bold 
                                    <?= $b['status'] === 'confirmed' ? 'bg-emerald-950 text-emerald-400 border border-emerald-800' : ($b['status'] === 'pending' ? 'bg-amber-950 text-amber-400 border border-amber-800' : 'bg-zinc-800 text-zinc-400') ?>">
                                    <?= htmlspecialchars($b['status']) ?>
                                </span>
                            </td>
                            <td class="p-3">
                                <a href="<?= BASE_URL ?>/admin/bookings/view/<?= $b['id'] ?>" class="text-rose-400 hover:underline">Details</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
