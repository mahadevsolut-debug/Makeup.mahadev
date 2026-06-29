<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($meta_title ?? ($globalSettings['site_title'] ?? 'Makeup.mahadev')) ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#fff1f2',
                            100: '#ffe4e6',
                            300: 'color-mix(in srgb, var(--color-primary) 60%, white)',
                            500: 'var(--color-primary)',
                            600: 'var(--color-primary-dark)',
                            700: 'var(--color-secondary)',
                            900: 'var(--color-secondary-dark)',
                        },
                        gold: {
                            400: 'var(--color-accent)',
                            500: 'var(--color-accent)',
                            600: 'var(--color-accent)',
                        }
                    },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS Animate On Scroll CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

    <style>
        :root {
            --color-primary: <?= htmlspecialchars($globalSettings['primary_color'] ?? '#e11d48') ?>;
            --color-primary-dark: <?= htmlspecialchars($globalSettings['secondary_color'] ?? '#be123c') ?>;
            --color-secondary: <?= htmlspecialchars($globalSettings['secondary_color'] ?? '#be123c') ?>;
            --color-secondary-dark: <?= htmlspecialchars($globalSettings['secondary_color'] ?? '#881337') ?>;
            --color-accent: <?= htmlspecialchars($globalSettings['accent_color'] ?? '#fbbf24') ?>;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .dark-glass-panel {
            background: rgba(24, 24, 27, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        /* Preloader */
        #preloader {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #09090b;
            transition: opacity 0.6s ease, visibility 0.6s ease;
        }
        #preloader.loaded {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }
        .preloader-spinner {
            width: 48px;
            height: 48px;
            border: 4px solid rgba(255,255,255,0.08);
            border-top-color: var(--color-primary);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .preloader-brand {
            animation: pulse-brand 1.5s ease-in-out infinite;
        }
        @keyframes pulse-brand {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }
    </style>
</head>
<body class="bg-zinc-950 text-zinc-100 font-sans antialiased selection:bg-brand-500 selection:text-white">

    <!-- Preloader Overlay -->
    <div id="preloader">
        <div class="text-center space-y-4">
            <div class="preloader-spinner mx-auto"></div>
            <p class="preloader-brand text-sm font-serif font-bold text-zinc-400 tracking-widest uppercase"><?= htmlspecialchars($globalSettings['site_name'] ?? 'Makeup.mahadev') ?></p>
        </div>
    </div>

    <!-- Top Announcement Bar -->
    <div class="bg-gradient-to-r from-brand-700 via-brand-500 to-brand-700 text-white text-xs py-2 px-4 text-center tracking-wide font-medium">
        ✨ Direct Booking Special Offer: Complimentary Hydration Pre-Makeup Prep for all online bookings!
    </div>

    <!-- Header Navigation -->
    <header x-data="{ mobileOpen: false }" class="sticky top-0 z-50 dark-glass-panel border-b border-zinc-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Brand Logo -->
            <a href="<?= BASE_URL ?>" class="flex items-center gap-3 group">
                <?php if (!empty($globalSettings['site_logo'])): ?>
                    <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($globalSettings['site_logo']) ?>" alt="<?= htmlspecialchars($globalSettings['site_name'] ?? 'Logo') ?>" class="h-12 w-auto object-contain">
                <?php else: ?>
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-brand-500 to-gold-500 flex items-center justify-center text-white font-serif text-xl font-bold shadow-lg shadow-brand-900/40 group-hover:scale-105 transition">
                        M
                    </div>
                <?php endif; ?>
                <div class="flex flex-col">
                    <span class="font-serif text-2xl font-bold tracking-tight bg-gradient-to-r from-white via-zinc-200 to-gold-400 bg-clip-text text-transparent">
                        <?= htmlspecialchars($globalSettings['site_name'] ?? 'Makeup.mahadev') ?>
                    </span>
                    <span class="text-[10px] uppercase tracking-widest text-zinc-400 font-semibold">Luxury Bridal & Makeup</span>
                </div>
            </a>

            <!-- Desktop Nav Items -->
            <nav class="hidden md:flex items-center gap-8 font-medium text-sm text-zinc-300">
                <a href="<?= BASE_URL ?>" class="hover:text-brand-500 transition">Home</a>
                <a href="<?= BASE_URL ?>/about" class="hover:text-brand-500 transition">About</a>
                <a href="<?= BASE_URL ?>/services" class="hover:text-brand-500 transition">Services & Pricing</a>
                <a href="<?= BASE_URL ?>/portfolio" class="hover:text-brand-500 transition">Portfolio</a>
                <a href="<?= BASE_URL ?>/gallery" class="hover:text-brand-500 transition">Gallery</a>
                <a href="<?= BASE_URL ?>/blog" class="hover:text-brand-500 transition">Blog</a>
                <a href="<?= BASE_URL ?>/reviews" class="hover:text-brand-500 transition">Reviews</a>
                <a href="<?= BASE_URL ?>/contact" class="hover:text-brand-500 transition">Contact</a>
            </nav>

            <!-- Book Now Action -->
            <div class="hidden md:flex items-center gap-4">
                <a href="<?= BASE_URL ?>/booking" class="px-5 py-2.5 rounded-full bg-gradient-to-r from-brand-500 to-brand-700 hover:from-brand-600 hover:to-brand-700 text-white font-semibold text-sm shadow-lg shadow-brand-900/50 hover:shadow-brand-600/50 hover:-translate-y-0.5 transition duration-200 flex items-center gap-2">
                    <i class="fa-regular font-bold fa-calendar-check"></i>
                    <span>Book Session</span>
                </a>
            </div>

            <!-- Mobile Toggle -->
            <button @click="mobileOpen = !mobileOpen" class="md:hidden text-zinc-300 hover:text-white p-2">
                <i class="fa-solid fa-bars text-xl" x-show="!mobileOpen"></i>
                <i class="fa-solid fa-xmark text-xl" x-show="mobileOpen"></i>
            </button>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileOpen" x-transition class="md:hidden bg-zinc-900 border-b border-zinc-800 px-6 py-6 space-y-4 text-center">
            <a href="<?= BASE_URL ?>" class="block text-zinc-200 font-medium py-2">Home</a>
            <a href="<?= BASE_URL ?>/about" class="block text-zinc-200 font-medium py-2">About</a>
            <a href="<?= BASE_URL ?>/services" class="block text-zinc-200 font-medium py-2">Services & Pricing</a>
            <a href="<?= BASE_URL ?>/portfolio" class="block text-zinc-200 font-medium py-2">Portfolio</a>
            <a href="<?= BASE_URL ?>/gallery" class="block text-zinc-200 font-medium py-2">Gallery</a>
            <a href="<?= BASE_URL ?>/blog" class="block text-zinc-200 font-medium py-2">Blog</a>
            <a href="<?= BASE_URL ?>/reviews" class="block text-zinc-200 font-medium py-2">Reviews</a>
            <a href="<?= BASE_URL ?>/contact" class="block text-zinc-200 font-medium py-2">Contact</a>
            <a href="<?= BASE_URL ?>/booking" class="block w-full py-3 bg-brand-500 text-white rounded-xl font-bold shadow-lg">Book Session Now</a>
        </div>
    </header>

    <!-- Flash Messages Container -->
    <?php if ($msg = \App\Core\Session::flash('success')): ?>
        <div class="max-w-7xl mx-auto px-4 mt-6">
            <div class="p-4 rounded-xl bg-emerald-950/80 border border-emerald-600/50 text-emerald-200 flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-emerald-400 text-xl"></i>
                <span><?= htmlspecialchars($msg) ?></span>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($err = \App\Core\Session::flash('error')): ?>
        <div class="max-w-7xl mx-auto px-4 mt-6">
            <div class="p-4 rounded-xl bg-red-950/80 border border-red-600/50 text-red-200 flex items-center gap-3">
                <i class="fa-solid fa-circle-exclamation text-red-400 text-xl"></i>
                <span><?= htmlspecialchars($err) ?></span>
            </div>
        </div>
    <?php endif; ?>

    <!-- Main Dynamic Content Body -->
    <main>
        <?= $content ?>
    </main>

    <!-- Footer -->
    <footer class="bg-zinc-900 border-t border-zinc-800/80 text-zinc-400 pt-16 pb-12 mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-10">
            
            <!-- Col 1: Brand -->
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <?php if (!empty($globalSettings['site_logo'])): ?>
                        <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($globalSettings['site_logo']) ?>" alt="Logo" class="h-10 w-auto object-contain">
                    <?php else: ?>
                        <div class="w-9 h-9 rounded-full bg-brand-500 flex items-center justify-center text-white font-serif font-bold">M</div>
                    <?php endif; ?>
                    <span class="font-serif text-xl font-bold text-white"><?= htmlspecialchars($globalSettings['site_name'] ?? 'Makeup.mahadev') ?></span>
                </div>
                <p class="text-xs text-zinc-400 leading-relaxed">
                    <?= htmlspecialchars($globalSettings['site_tagline'] ?? 'Enhancing your natural grace with luxury makeup artistry.') ?>
                </p>
                <!-- Dynamic Social Media Icons -->
                <div class="flex gap-4 text-lg text-zinc-400 pt-2">
                    <?php if (!empty($globalSettings['instagram_url'])): ?>
                        <a href="<?= htmlspecialchars($globalSettings['instagram_url']) ?>" target="_blank" class="hover:text-brand-500 transition" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($globalSettings['facebook_url'])): ?>
                        <a href="<?= htmlspecialchars($globalSettings['facebook_url']) ?>" target="_blank" class="hover:text-brand-500 transition" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($globalSettings['pinterest_url'])): ?>
                        <a href="<?= htmlspecialchars($globalSettings['pinterest_url']) ?>" target="_blank" class="hover:text-brand-500 transition" title="Pinterest"><i class="fa-brands fa-pinterest"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($globalSettings['youtube_url'])): ?>
                        <a href="<?= htmlspecialchars($globalSettings['youtube_url']) ?>" target="_blank" class="hover:text-brand-500 transition" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div>
                <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Quick Navigation</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="<?= BASE_URL ?>/services" class="hover:text-white transition">Bridal Packages</a></li>
                    <li><a href="<?= BASE_URL ?>/portfolio" class="hover:text-white transition">Celebrity Lookbook</a></li>
                    <li><a href="<?= BASE_URL ?>/gallery" class="hover:text-white transition">Before & After Transformations</a></li>
                    <li><a href="<?= BASE_URL ?>/reviews" class="hover:text-white transition">Client Testimonials</a></li>
                    <li><a href="<?= BASE_URL ?>/blog" class="hover:text-white transition">Makeup Masterclass Blog</a></li>
                </ul>
            </div>

            <!-- Col 3: Contact Info -->
            <div>
                <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Studio Info</h4>
                <ul class="space-y-3 text-xs">
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-location-dot mt-0.5 text-brand-500"></i>
                        <span><?= htmlspecialchars($globalSettings['office_address'] ?? 'Luxury Makeup Studio, City Center') ?></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-phone text-brand-500"></i>
                        <span><?= htmlspecialchars($globalSettings['contact_phone'] ?? '+91 98765 43210') ?></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-brand-500"></i>
                        <span><?= htmlspecialchars($globalSettings['contact_email'] ?? 'contact@makeupmahadev.com') ?></span>
                    </li>
                </ul>
            </div>

            <!-- Col 4: Newsletter -->
            <div>
                <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Join VIP Beauty Club</h4>
                <p class="text-xs mb-3">Subscribe for exclusive bridal discounts and seasonal skincare guides.</p>
                <form class="flex gap-2">
                    <input type="email" placeholder="Your email address" class="bg-zinc-800 border border-zinc-700 rounded-lg px-3 py-2 text-xs w-full text-white focus:outline-none focus:border-brand-500">
                    <button type="submit" class="bg-brand-500 hover:bg-brand-600 text-white text-xs px-4 rounded-lg font-semibold transition">Join</button>
                </form>
            </div>

        </div>

        <div class="max-w-7xl mx-auto px-4 mt-12 pt-6 border-t border-zinc-800/60 text-center text-xs text-zinc-500 flex flex-col md:flex-row justify-between items-center gap-4">
            <p><?= htmlspecialchars($globalSettings['footer_text'] ?? '© ' . date('Y') . ' ' . ($globalSettings['site_name'] ?? 'Makeup.mahadev') . '. All rights reserved.') ?></p>
            <p><a href="<?= BASE_URL ?>/admin/login" class="hover:text-zinc-400 transition">Admin Portal Login</a></p>
        </div>
    </footer>

    <!-- Floating WhatsApp Button (positioned above mobile sticky bar) -->
    <?php
        $waNumber = htmlspecialchars($globalSettings['whatsapp_number'] ?? '919876543210');
        $waMessage = urlencode($globalSettings['whatsapp_message'] ?? 'Hi, I would like to book a makeover session!');
    ?>
    <a href="https://wa.me/<?= $waNumber ?>?text=<?= $waMessage ?>" target="_blank"
       class="fixed bottom-24 md:bottom-6 right-4 md:right-6 z-40 w-14 h-14 rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition duration-300"
       style="background-color: var(--color-primary);"
       title="Chat on WhatsApp">
        <i class="fa-brands fa-whatsapp text-white text-3xl"></i>
    </a>

    <!-- Sticky Mobile Book Now Bar -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 z-30 p-3 dark-glass-panel border-t border-zinc-800 flex justify-between items-center px-6">
        <div>
            <span class="text-xs text-zinc-400 block">Luxury Bridal Sessions</span>
            <span class="text-sm font-bold text-gold-400">Slots Open for <?= date('Y') ?></span>
        </div>
        <a href="<?= BASE_URL ?>/booking" class="px-5 py-2 rounded-full bg-brand-500 text-white font-bold text-xs shadow-lg">
            Book Now
        </a>
    </div>

    <!-- AOS Animate On Scroll JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialize AOS scroll animations
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 60
        });

        // Preloader fade-out
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('preloader').classList.add('loaded');
            }, 400);
        });
    </script>

</body>
</html>
