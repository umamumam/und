<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Platform Undangan Digital Terbaik - Buat undangan pernikahan online yang elegan, modern, dan praktis.">
    <title>{{ config('app.name', 'UndangKita') }} - Undangan Digital Elegan</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600;700&family=Dancing+Script:wght@700&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <!-- Animate On Scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary: #D4AF37;
            --primary-light: #F4E0A1;
            --secondary: #1a1a1a;
            --accent: #E66239;
            --bg-pearl: #FDFDFC;
            --text-dark: #2d3436;
            --text-muted: #636e72;
            --glass: rgba(255, 255, 255, 0.8);
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Inter', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-sans);
            background-color: var(--bg-pearl);
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* PREMIUM SCROLLBAR */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* NAVBAR */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 20px 0;
            transition: all 0.3s ease;
        }

        nav.scrolled {
            background: var(--glass);
            backdrop-filter: blur(10px);
            padding: 12px 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .btn-nav {
            background: var(--primary);
            color: white !important;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        .btn-nav:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
        }

        /* HERO SECTION */
        .hero {
            padding: 160px 0 100px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: radial-gradient(circle at top right, #fff5e6, transparent),
                radial-gradient(circle at bottom left, #fff0f5, transparent);
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .hero-text h1 {
            font-family: var(--font-serif);
            font-size: 4rem;
            line-height: 1.1;
            margin-bottom: 24px;
            color: var(--secondary);
        }

        .hero-text h1 span {
            color: var(--primary);
            font-style: italic;
        }

        .hero-text p {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-bottom: 40px;
            max-width: 500px;
        }

        .cta-group {
            display: flex;
            gap: 20px;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            padding: 16px 36px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(212, 175, 55, 0.4);
        }

        .btn-outline {
            padding: 16px 36px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            border: 2px solid var(--primary);
            color: var(--primary);
            transition: all 0.3s;
        }

        .btn-outline:hover {
            background: var(--primary-light);
            transform: translateY(-3px);
        }

        .hero-image {
            position: relative;
        }

        .hero-image img {
            width: 100%;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        }

        .floating-card {
            position: absolute;
            background: white;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 15px;
            animation: float 4s ease-in-out infinite;
        }

        .f-card-1 {
            bottom: 40px;
            left: -40px;
        }

        .f-card-2 {
            top: 40px;
            right: -40px;
            animation-delay: 1s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        /* FEATURES */
        .features {
            padding: 100px 0;
            background: white;
        }

        .section-header {
            text-align: center;
            margin-bottom: 70px;
        }

        .section-header h2 {
            font-family: var(--font-serif);
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .section-header p {
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .feature-card {
            padding: 40px;
            border-radius: 24px;
            background: var(--bg-pearl);
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .feature-card:hover {
            background: white;
            border-color: var(--primary-light);
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 25px;
        }

        .feature-card h3 {
            font-size: 1.4rem;
            margin-bottom: 15px;
        }

        .feature-card p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        /* PACKAGES */
        .pricing {
            padding: 100px 0;
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            align-items: center;
        }

        .price-card {
            background: white;
            padding: 50px 40px;
            border-radius: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            border: 1px solid #eee;
            position: relative;
        }

        .price-card.featured {
            border: 2px solid var(--primary);
            transform: scale(1.05);
            z-index: 2;
        }

        .badge-popular {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary);
            color: white;
            padding: 6px 20px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .price-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-muted);
        }

        .price-amount {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 30px;
            font-family: var(--font-serif);
        }

        .price-amount span {
            font-size: 1rem;
            color: var(--text-muted);
            font-weight: 400;
        }

        .price-features {
            list-style: none;
            text-align: left;
            margin-bottom: 40px;
        }

        .price-features li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .price-features li i {
            color: var(--primary);
        }

        /* FOOTER */
        footer {
            background: var(--secondary);
            color: white;
            padding: 80px 0 40px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 60px;
            margin-bottom: 60px;
        }

        .footer-about p {
            color: #aaa;
            margin: 20px 0;
            max-width: 300px;
        }

        .footer-links h4 {
            font-size: 1.2rem;
            margin-bottom: 25px;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links ul li {
            margin-bottom: 12px;
        }

        .footer-links ul li a {
            color: #aaa;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links ul li a:hover {
            color: var(--primary);
        }

        .social-links {
            display: flex;
            gap: 15px;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: #333;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: background 0.3s;
        }

        .social-links a:hover {
            background: var(--primary);
        }

        .footer-bottom {
            border-top: 1px solid #333;
            padding-top: 40px;
            text-align: center;
            color: #777;
            font-size: 0.9rem;
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .hero-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-text p {
                margin: 0 auto 40px;
            }

            .cta-group {
                justify-content: center;
            }

            .features-grid,
            .pricing-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .price-card.featured {
                transform: scale(1);
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .hero-text h1 {
                font-size: 3rem;
            }

            .features-grid,
            .pricing-grid,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .nav-links {
                display: none;
            }
        }
    </style>
</head>

<body>
    <!-- NAVIGATION -->
    <nav id="navbar">
        <div class="container nav-content">
            <a href="/" class="logo">UndangKita</a>
            <div class="nav-links">
                <a href="#fitur">Fitur</a>
                <a href="#tema">Tema</a>
                <a href="#harga">Harga</a>
                @if (Route::has('login'))
                @auth
                <a href="{{ url('/dashboard') }}" class="btn-nav">Dashboard</a>
                @else
                <a href="{{ route('login') }}">Masuk</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn-nav">Mulai Sekarang</a>
                @endif
                @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="container hero-grid">
            <div class="hero-text" data-aos="fade-right">
                <h1>Abadikan Momen <span>Cinta</span> dengan Undangan Digital</h1>
                <p>Ubah hari spesial Anda menjadi pengalaman digital yang tak terlupakan. Elegan, eksklusif, dan ramah
                    lingkungan.</p>
                <div class="cta-group">
                    <a href="{{ route('register') }}" class="btn-primary">Buat Undangan</a>
                    <a href="#tema" class="btn-outline">Lihat Tema</a>
                </div>
            </div>
            <div class="hero-image" data-aos="fade-left">
                <img src="{{ asset('hero-couple.png') }}" alt="Premium Wedding Invitation">
                <div class="floating-card f-card-1">
                    <div class="feature-icon" style="width:40px; height:40px; font-size: 1.2rem; margin-bottom:0;">
                        <i class="ti ti-heart"></i>
                    </div>
                    <div>
                        <strong style="display:block; font-size:0.9rem;">1,200+</strong>
                        <small style="color:var(--text-muted);">Pasangan Bahagia</small>
                    </div>
                </div>
                <div class="floating-card f-card-2">
                    <div class="feature-icon" style="width:40px; height:40px; font-size: 1.2rem; margin-bottom:0;">
                        <i class="ti ti-palette"></i>
                    </div>
                    <div>
                        <strong style="display:block; font-size:0.9rem;">Premium</strong>
                        <small style="color:var(--text-muted);">Desain Eksklusif</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section id="fitur" class="features">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Fitur Premium Untuk Anda</h2>
                <p>Kami menyediakan segala hal yang Anda butuhkan untuk membuat undangan digital yang sempurna.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon"><i class="ti ti-device-mobile"></i></div>
                    <h3>Responsif & Mobile Friendly</h3>
                    <p>Undangan Anda akan tampil sempurna di semua perangkat, baik smartphone, tablet, maupun desktop.
                    </p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon"><i class="ti ti-music"></i></div>
                    <h3>Musik Latar Otomatis</h3>
                    <p>Pilih lagu favorit Anda untuk mengiringi tamu saat membuka undangan digital Anda.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon"><i class="ti ti-map-pin"></i></div>
                    <h3>Integrasi Google Maps</h3>
                    <p>Mudahkan tamu menemukan lokasi acara dengan peta interaktif dan tombol navigasi langsung.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-icon"><i class="ti ti-users"></i></div>
                    <h3>Konfirmasi RSVP</h3>
                    <p>Terima pemberitahuan otomatis saat tamu mengonfirmasi kehadiran mereka secara online.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-icon"><i class="ti ti-gift"></i></div>
                    <h3>Hadiah Digital</h3>
                    <p>Fitur amplop digital dan pengiriman kado langsung melalui rekening atau e-wallet.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-icon"><i class="ti ti-photo"></i></div>
                    <h3>Galeri Foto & Video</h3>
                    <p>Bagikan momen-momen indah pre-wedding Anda melalui galeri foto dan video sinematik.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SHOWCASE SECTION -->
    <section id="tema" class="showcase" style="padding: 100px 0; background: var(--bg-pearl);">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Pilihan Tema Eksklusif</h2>
                <p>Temukan desain yang mencerminkan kisah cinta Anda. Mulai dari gaya minimalis hingga kemewahan yang
                    klasik.</p>
            </div>
            <div class="showcase-content"
                style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
                <div class="showcase-image" data-aos="zoom-in">
                    <img src="{{ asset('themes-showcase.png') }}" alt="Template Showcase"
                        style="width:100%; border-radius:30px; box-shadow: 0 20px 50px rgba(0,0,0,0.1);">
                </div>
                <div class="showcase-text" data-aos="fade-left">
                    <h3 style="font-family: var(--font-serif); font-size: 2.2rem; margin-bottom: 20px;">Desain yang
                        Dapat Disesuaikan Sepenuhnya</h3>
                    <p style="color: var(--text-muted); margin-bottom: 30px;">Setiap tema dirancang oleh desainer
                        profesional untuk memastikan kualitas visual terbaik di hari spesial Anda. Anda dapat mengubah
                        teks, foto, musik, hingga susunan acara dengan sangat mudah.</p>
                    <ul style="list-style: none; margin-bottom: 40px;">
                        <li style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;"><i
                                class="ti ti-circle-check-filled" style="color: var(--primary);"></i> Editor yang
                            intuitif</li>
                        <li style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;"><i
                                class="ti ti-circle-check-filled" style="color: var(--primary);"></i> Live Preview
                            seketika</li>
                        <li style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;"><i
                                class="ti ti-circle-check-filled" style="color: var(--primary);"></i> Pilihan font &
                            warna yang beragam</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn-primary">Lihat Katalog Lengkap</a>
                </div>
            </div>
        </div>
    </section>

    <!-- PRICING SECTION -->
    <section id="harga" class="pricing">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Paket Hemat Untuk Hari Bahagia</h2>
                <p>Pilih paket yang paling sesuai dengan kebutuhan dan impian pernikahan Anda.</p>
            </div>
            <div class="pricing-grid">
                <div class="price-card" data-aos="fade-right">
                    <div class="price-name">Basic</div>
                    <div class="price-amount">Gratis<span>/Selamanya</span></div>
                    <ul class="price-features">
                        <li><i class="ti ti-check"></i> Tema Standar</li>
                        <li><i class="ti ti-check"></i> Aktif 3 Hari</li>
                        <li><i class="ti ti-check"></i> Maks. 50 Tamu</li>
                        <li style="color:#ccc;"><i class="ti ti-x"></i> Tanpa Musik Latar</li>
                        <li style="color:#ccc;"><i class="ti ti-x"></i> Tanpa Galeri Video</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn-outline" style="display:block;">Pilih Paket</a>
                </div>
                <div class="price-card featured" data-aos="fade-up">
                    <div class="badge-popular">Paling Populer</div>
                    <div class="price-name">Premium</div>
                    <div class="price-amount">Rp 149k<span>/Acara</span></div>
                    <ul class="price-features">
                        <li><i class="ti ti-check"></i> Semua Tema Premium</li>
                        <li><i class="ti ti-check"></i> Aktif Selamanya</li>
                        <li><i class="ti ti-check"></i> Tamu Tak Terbatas</li>
                        <li><i class="ti ti-check"></i> Musik Latar Custom</li>
                        <li><i class="ti ti-check"></i> RSVP & Buku Tamu</li>
                        <li><i class="ti ti-check"></i> Galeri Foto & Video</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn-primary" style="display:block;">Pilih Paket</a>
                </div>
                <div class="price-card" data-aos="fade-left">
                    <div class="price-name">Exclusive</div>
                    <div class="price-amount">Rp 299k<span>/Acara</span></div>
                    <ul class="price-features">
                        <li><i class="ti ti-check"></i> Semua Fitur Premium</li>
                        <li><i class="ti ti-check"></i> Custom Domain (.com)</li>
                        <li><i class="ti ti-check"></i> Tanpa Watermark</li>
                        <li><i class="ti ti-check"></i> Prioritas Support</li>
                        <li><i class="ti ti-check"></i> QR Code Check-in</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn-outline" style="display:block;">Pilih Paket</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container footer-grid">
            <div class="footer-about">
                <a href="/" class="logo" style="color:white;">UndangKita</a>
                <p>Platform undangan digital terbaik di Indonesia. Membantu Anda menyebarkan kebahagiaan dengan cara
                    yang lebih elegan dan modern.</p>
                <div class="social-links">
                    <a href="#"><i class="ti ti-brand-instagram"></i></a>
                    <a href="#"><i class="ti ti-brand-facebook"></i></a>
                    <a href="#"><i class="ti ti-brand-whatsapp"></i></a>
                    <a href="#"><i class="ti ti-brand-tiktok"></i></a>
                </div>
            </div>
            <div class="footer-links">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#fitur">Fitur</a></li>
                    <li><a href="#tema">Tema</a></li>
                    <li><a href="#harga">Harga</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>Bantuan</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Kontak Kami</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>Kontak</h4>
                <p style="color:#aaa; font-size:0.9rem; margin-bottom:10px;"><i class="ti ti-mail"></i>
                    halo@undangkita.id</p>
                <p style="color:#aaa; font-size:0.9rem; margin-bottom:10px;"><i class="ti ti-phone"></i> +62 812 3456
                    7890</p>
                <p style="color:#aaa; font-size:0.9rem;"><i class="ti ti-map-pin"></i> Jakarta, Indonesia</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 UndangKita. All rights reserved. Crafted with <i class="ti ti-heart"
                    style="color:var(--accent);"></i> by {{ config('app.name') }} Team.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Init Animation
        AOS.init({
            duration: 1000,
            once: true
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>