-- Default Seed Data for Makeup.mahadev

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Mahadev Admin', 'admin@makeupmahadev.com', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHe.FqZ8P8D0O8b1M.j.j3N4X3K3K3K3K3', 'admin');
-- Note: Default Admin login is admin@makeupmahadev.com / admin123 (or update password in admin panel)

-- Default Service Categories
INSERT INTO `service_categories` (`id`, `name`, `slug`, `description`, `sort_order`) VALUES
(1, 'Bridal Makeup', 'bridal-makeup', 'Premium luxury bridal makeover packages designed for your special day.', 1),
(2, 'Party & Engagement', 'party-engagement', 'Glamorous makeover for sangeet, engagement, and evening receptions.', 2),
(3, 'Editorial & Fashion', 'editorial-fashion', 'High-definition photography and high-fashion shoot makeovers.', 3);

-- Default Services
INSERT INTO `services` (`id`, `category_id`, `title`, `slug`, `description`, `cover_image`, `duration`, `pricing_type`, `simple_price`, `status`, `is_featured`) VALUES
(1, 1, 'HD Royal Bridal Makeover', 'hd-royal-bridal-makeover', 'Complete royal bridal package with high-definition airbrush technique, HD hair styling, and premium mink lashes.', 'bridal_cover.jpg', '4 Hours', 'package', 0.00, 'active', 1),
(2, 2, 'Glamorous Reception Makeup', 'glamorous-reception-makeup', 'Sleek, radiant evening reception look customized according to your outfit and aesthetic.', 'reception_cover.jpg', '2.5 Hours', 'package', 0.00, 'active', 1),
(3, 3, 'High-Fashion Editorial Shoot', 'high-fashion-editorial-shoot', 'Precision camera-ready makeup for portfolio, magazine, and concept photoshoots.', 'editorial_cover.jpg', '3 Hours', 'simple', 8500.00, 'active', 0);

-- Packages for Bridal Makeup Service (Service ID 1)
INSERT INTO `service_packages` (`id`, `service_id`, `name`, `price`, `description`, `is_popular`, `sort_order`) VALUES
(1, 1, 'Basic Bridal', 15000.00, 'Standard HD Makeup + Basic Hair Styling + False Lashes', 0, 1),
(2, 1, 'Silver Bridal Package', 22000.00, 'Ultra HD Makeup + Advanced Hair Styling + Outfit Draping + Premium Lashes', 0, 2),
(3, 1, 'Gold Royal Package', 32000.00, 'Airbrush Makeup + Signature Bridal Hair Design + Jewelry Attachment + Saree Draping + Mini Touch-up Kit', 1, 3),
(4, 1, 'Premium Diamond Experience', 45000.00, 'Full Luxe Airbrush Makeover + Trial Session included + Pre-bridal skin prep consultancy + Full day venue assistance', 0, 4);

-- Packages for Reception Service (Service ID 2)
INSERT INTO `service_packages` (`id`, `service_id`, `name`, `price`, `description`, `is_popular`, `sort_order`) VALUES
(5, 2, 'Silver Glam', 9500.00, 'HD Reception Makeup + Sleek Blowdry / Curls', 0, 1),
(6, 2, 'Gold Glam Luxe', 14000.00, 'High Definition Glow Makeup + Designer Updo Haircut + Dupatta / Outfit Draping', 1, 2);

-- Global Add-ons
INSERT INTO `service_addons` (`id`, `service_id`, `name`, `price`, `description`, `status`) VALUES
(1, NULL, 'Advanced Hair Styling Extension', 2500.00, 'Addition of premium hair extensions and floral attachments.', 'active'),
(2, NULL, 'Designer Saree / Dupatta Draping', 1500.00, 'Precision pleating and secure pinup by expert draping artist.', 'active'),
(3, NULL, 'Extra Party Person Makeup', 4500.00, 'Per guest HD guest makeup package for family members.', 'active'),
(4, NULL, 'Early Morning Charge (Before 6 AM)', 2000.00, 'Surcharge for early morning call times.', 'active'),
(5, NULL, 'Outstation / Venue Travel Fee', 3500.00, 'Travel and transport fee within 50km radius.', 'active');

-- Default Settings
INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES
('site_name', 'Makeup.mahadev'),
('site_title', 'Makeup.mahadev | Luxury Bridal & Celebrity Makeup Studio'),
('site_tagline', 'Enhancing Your Natural Grace with Timeless Artistry'),
('contact_email', 'contact@makeupmahadev.com'),
('contact_phone', '+91 98765 43210'),
('whatsapp_number', '919876543210'),
('office_address', 'Studio 104, Royal Elegance Heights, Fashion Avenue, City'),
('primary_color', '#e11d48'),
('secondary_color', '#881337'),
('dark_mode', 'true'),
('smtp_host', 'smtp.mailtrap.io'),
('smtp_port', '2525'),
('smtp_user', ''),
('smtp_pass', ''),
('smtp_encryption', 'tls'),
('currency_symbol', '₹'),
('hero_heading', 'Timeless Beauty & Elegance Redefined'),
('hero_subheading', 'Book award-winning bridal, party, and luxury HD makeup services crafted for your special moments.'),
('cta_booking_text', 'Reserve Your Date');
