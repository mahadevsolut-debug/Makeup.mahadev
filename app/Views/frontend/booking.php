<section class="py-16 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="text-center space-y-4 mb-12">
        <span class="text-rose-500 font-bold text-xs uppercase tracking-widest">Reserve Your Slot</span>
        <h1 class="font-serif text-4xl sm:text-5xl font-extrabold text-white">Service Request & Instant Pricing</h1>
        <p class="text-zinc-400 text-sm max-w-2xl mx-auto">Select your desired makeup service, tiered package, and optional add-ons to build your custom makeover quote.</p>
    </div>

    <?php if ($bookingSuccess = \App\Core\Session::flash('success_booking')): ?>
        <div class="p-8 rounded-3xl bg-emerald-950/90 border border-emerald-500 text-center space-y-6 mb-12 shadow-2xl">
            <div class="w-16 h-16 rounded-full bg-emerald-500/20 text-emerald-400 mx-auto flex items-center justify-center text-3xl">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="space-y-2">
                <h2 class="font-serif text-3xl font-bold text-white">Booking Submitted Successfully!</h2>
                <p class="text-emerald-200 text-sm">Your booking confirmation reference code is <strong class="text-amber-300 font-mono text-base"><?= htmlspecialchars($bookingSuccess['code']) ?></strong>.</p>
            </div>
            <p class="text-xs text-emerald-400">Our senior studio manager will call you shortly to verify venue arrival logistics.</p>
        </div>
    <?php endif; ?>

    <div x-data="bookingCalculator()" x-init="initCalculator()" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Booking Form -->
        <div class="lg:col-span-2 dark-glass-panel p-8 rounded-3xl border border-zinc-800 space-y-6">
            <form action="<?= BASE_URL ?>/booking/submit" method="POST" class="space-y-6">
                <?= \App\Core\CSRF::field() ?>

                <div class="space-y-4">
                    <h3 class="font-serif text-xl font-bold text-white border-b border-zinc-800 pb-3">1. Select Makeup Service</h3>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-2">Service Category / Type *</label>
                        <select name="service_id" x-model="selectedServiceId" @change="fetchServiceDetails()" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-rose-500">
                            <option value="">-- Choose Service --</option>
                            <?php foreach ($services as $srv): ?>
                                <option value="<?= $srv['id'] ?>" <?= ($preselected_service == $srv['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($srv['title']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Package Selection Tier -->
                <div x-show="serviceDetails && serviceDetails.pricing_type === 'package'" class="space-y-4" x-transition>
                    <h3 class="font-serif text-xl font-bold text-white border-b border-zinc-800 pb-3">2. Choose Tier Package</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <template x-for="pkg in serviceDetails.packages" :key="pkg.id">
                            <label class="relative border rounded-2xl p-4 cursor-pointer transition flex flex-col justify-between"
                                   :class="selectedPackageId == pkg.id ? 'border-rose-500 bg-rose-950/20' : 'border-zinc-800 bg-zinc-900/50 hover:border-zinc-700'">
                                <div class="space-y-2">
                                    <div class="flex justify-between items-start">
                                        <span class="font-bold text-white text-base" x-text="pkg.name"></span>
                                        <input type="radio" name="package_id" :value="pkg.id" x-model="selectedPackageId" @change="recalculate()" class="text-rose-600 focus:ring-rose-500">
                                    </div>
                                    <p class="text-xs text-zinc-400" x-text="pkg.description"></p>
                                </div>
                                <div class="mt-4 pt-2 border-t border-zinc-800/60 font-bold text-amber-400 text-sm">
                                    <?= htmlspecialchars($globalSettings['currency_symbol'] ?? '₹') ?><span x-text="Number(pkg.price).toLocaleString()"></span>
                                </div>
                            </label>
                        </template>
                    </div>
                </div>

                <!-- Add-ons Selection Tier -->
                <div x-show="serviceDetails && serviceDetails.addons && serviceDetails.addons.length > 0" class="space-y-4" x-transition>
                    <h3 class="font-serif text-xl font-bold text-white border-b border-zinc-800 pb-3">3. Optional Service Add-ons</h3>
                    <div class="space-y-3">
                        <template x-for="addon in serviceDetails.addons" :key="addon.id">
                            <label class="flex items-center justify-between p-4 rounded-2xl border border-zinc-800 bg-zinc-900/40 hover:bg-zinc-900 cursor-pointer transition">
                                <div class="flex items-center gap-3">
                                    <input type="checkbox" name="addons[]" :value="addon.id" x-model="selectedAddons" @change="recalculate()" class="w-4 h-4 text-rose-600 rounded focus:ring-rose-500">
                                    <div>
                                        <span class="font-semibold text-sm text-white block" x-text="addon.name"></span>
                                        <span class="text-xs text-zinc-400" x-text="addon.description"></span>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-amber-400">+<?= htmlspecialchars($globalSettings['currency_symbol'] ?? '₹') ?><span x-text="Number(addon.price).toLocaleString()"></span></span>
                            </label>
                        </template>
                    </div>
                </div>

                <!-- Contact & Event Logistics -->
                <div class="space-y-4">
                    <h3 class="font-serif text-xl font-bold text-white border-b border-zinc-800 pb-3">4. Client Details & Event Location</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-zinc-400 mb-1">Full Name *</label>
                            <input type="text" name="customer_name" required class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-zinc-400 mb-1">Phone / WhatsApp *</label>
                            <input type="tel" name="customer_phone" required class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1">Email Address *</label>
                        <input type="email" name="customer_email" required class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-zinc-400 mb-1">Event Date *</label>
                            <input type="date" name="event_date" required class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-zinc-400 mb-1">Ready Time *</label>
                            <input type="time" name="event_time" required class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-zinc-400 mb-1">Venue Address / City *</label>
                        <textarea name="location" rows="2" required placeholder="Hotel / Resort / Home address" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white"></textarea>
                    </div>
                </div>

                <button type="submit" class="w-full py-4 rounded-2xl bg-gradient-to-r from-rose-600 to-rose-700 hover:from-rose-500 hover:to-rose-600 text-white font-bold text-base shadow-xl shadow-rose-900/50 transition">
                    Submit Service Request
                </button>
            </form>
        </div>

        <!-- Summary Card Panel -->
        <div class="dark-glass-panel p-6 rounded-3xl border border-zinc-800 h-fit sticky top-28 space-y-6">
            <h3 class="font-serif text-xl font-bold text-white border-b border-zinc-800 pb-3">Price Summary</h3>
            
            <div class="space-y-3 text-sm">
                <div class="flex justify-between text-zinc-400">
                    <span>Base Package Price:</span>
                    <span class="text-white font-semibold"><?= htmlspecialchars($globalSettings['currency_symbol'] ?? '₹') ?><span x-text="Number(calculation.base_price).toLocaleString()"></span></span>
                </div>
                <div class="flex justify-between text-zinc-400">
                    <span>Selected Add-ons:</span>
                    <span class="text-white font-semibold">+<?= htmlspecialchars($globalSettings['currency_symbol'] ?? '₹') ?><span x-text="Number(calculation.addons_total).toLocaleString()"></span></span>
                </div>
                <div class="pt-4 border-t border-zinc-800 flex justify-between items-center">
                    <span class="text-white font-bold text-base">Estimated Total:</span>
                    <span class="text-2xl font-extrabold text-amber-400"><?= htmlspecialchars($globalSettings['currency_symbol'] ?? '₹') ?><span x-text="Number(calculation.total_price).toLocaleString()"></span></span>
                </div>
            </div>

            <div class="p-4 rounded-xl bg-zinc-900 text-xs text-zinc-400 space-y-2">
                <p><i class="fa-solid fa-shield-halved text-rose-500 mr-1"></i> <strong>Zero Hidden Fees:</strong> Pricing includes standard trial session consultation.</p>
            </div>
        </div>

    </div>
</section>

<script>
function bookingCalculator() {
    return {
        selectedServiceId: '<?= $preselected_service ?? "" ?>',
        serviceDetails: null,
        selectedPackageId: null,
        selectedAddons: [],
        calculation: {
            base_price: 0,
            addons_total: 0,
            total_price: 0
        },
        initCalculator() {
            if (this.selectedServiceId) {
                this.fetchServiceDetails();
            }
        },
        async fetchServiceDetails() {
            if (!this.selectedServiceId) return;
            // Fetch service details from API or endpoint
            const res = await fetch(`<?= BASE_URL ?>/booking/calculate`, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({service_id: this.selectedServiceId})
            });
            const data = await res.json();
            if (data.status) {
                this.calculation = data;
            }
        },
        recalculate() {
            fetch(`<?= BASE_URL ?>/booking/calculate`, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    service_id: this.selectedServiceId,
                    package_id: this.selectedPackageId,
                    addons: this.selectedAddons
                })
            }).then(r => r.json()).then(data => {
                if (data.status) {
                    this.calculation = data;
                }
            });
        }
    }
}
</script>
