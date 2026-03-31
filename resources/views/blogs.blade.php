<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo title="EduNex Insights | Modern Education Management & Technology Blog" 
           description="Stay updated with the latest trends in education management, institute automation, and technology insights from the EduNex team." />
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    @include('components.frontend-styles')

    <style>
        /* ── PAGE HEADER ── */
        .page-header {
            padding: 160px 0 80px;
            position: relative;
        }

        .section-tag {
            font-size: 0.85rem;
            font-weight: 800;
            color: var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 20px;
            display: inline-block;
            background: rgba(79, 70, 229, 0.08);
            padding: 6px 16px;
            border-radius: 50px;
        }

        .page-title {
            font-size: clamp(2.5rem, 6vw, 4.2rem);
            font-weight: 950;
            letter-spacing: -3px;
            color: var(--dark-bg);
            line-height:1.1;
        }

        .page-title span {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* ── BLOG CARDS ── */
        .blog-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 32px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.4);
            height: 100%;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 20px 60px -10px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
        }

        .blog-card:hover {
            transform: translateY(-12px);
            border-color: var(--primary-color);
            box-shadow: 0 40px 100px -20px rgba(79, 70, 229, 0.12);
        }

        .blog-card-img-wrapper {
            position: relative;
            padding: 12px;
        }

        .blog-card-img {
            width: 100%;
            height: 240px;
            object-fit: cover;
            border-radius: 24px;
        }

        .blog-card-content {
            padding: 30px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .blog-category {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--primary-color);
            margin-bottom: 12px;
            display: block;
        }

        .blog-card-title {
            font-size: 1.4rem;
            font-weight: 850;
            letter-spacing: -0.5px;
            color: var(--dark-bg);
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .blog-card-excerpt {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 25px;
            flex-grow: 1;
        }

        .blog-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            padding-top: 20px;
            border-top: 1px solid rgba(0,0,0,0.05);
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        .blog-author-img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* ── SEARCH & FILTER ── */
        .blog-filters {
            margin-bottom: 60px;
        }

        .nav-pills .nav-link {
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--text-muted);
            background: rgba(255,255,255,0.5);
            border: 1px solid rgba(0,0,0,0.05);
            margin-right: 10px;
            transition: all 0.3s;
        }

        .nav-pills .nav-link.active {
            background: var(--primary-color);
            color: #fff;
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.3);
        }
    </style>
</head>

<body>

    <div class="mesh-bg">
        <div class="mesh-circle-1"></div>
        <div class="mesh-circle-2"></div>
        <div class="mesh-circle-3"></div>
        <div class="mesh-circle-4"></div>
    </div>

    <!-- Navigation -->
    @include('components.frontend-navbar')

    <!-- Page Header -->
    <header class="page-header text-center">
        <div class="container px-4">
            <span class="section-tag animate__animated animate__fadeInDown">Insights & Innovation</span>
            <h1 class="page-title animate__animated animate__zoomIn">
                Stay ahead of the curve with<br>
                <span>EduNex Insights.</span>
            </h1>
            <p class="text-muted fs-5 mt-4 max-w-2xl mx-auto animate__animated animate__fadeInUp animate__delay-1s"
                style="max-width: 700px; font-weight: 500;">
                Updates, leadership thoughts, and technical guides on scaling modern institutes and empowering the next generation of learners.
            </p>
        </div>
    </header>

    <!-- Blog Section -->
    <section class="pb-5 mb-5">
        <div class="container px-4">
            
            <!-- Filters -->
            <div class="row justify-content-center mb-5">
                <div class="col-auto">
                    <ul class="nav nav-pills blog-filters animate__animated animate__fadeIn animate__delay-1s">
                        <li class="nav-item"><a href="#" class="nav-link active">All Posts</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Product Updates</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Leadership</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Technology</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Guides</a></li>
                    </ul>
                </div>
            </div>

            <!-- Blog Grid -->
            <div class="row g-4 justify-content-center">
                <!-- Blog 1 -->
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <div class="blog-card glass">
                        <div class="blog-card-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1510074377623-8cf13fb86c08?auto=format&fit=crop&q=80&w=800" alt="Tech In Ed" class="blog-card-img">
                        </div>
                        <div class="blog-card-content">
                            <span class="blog-category">Technology</span>
                            <h3 class="blog-card-title">How Generative AI is Transforming Institute Management.</h3>
                            <p class="blog-card-excerpt">Discover how modern ERP systems are leveraging AI to automate scheduling, attendance tracking, and predictive student performance analytics.</p>
                            <div class="blog-meta">
                                <img src="https://ui-avatars.com/api/?name=Zaid+Khan&background=4f46e5&color=fff" class="blog-author-img">
                                <span>Zaid Khan • March 31, 2026</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Blog 2 -->
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                    <div class="blog-card glass">
                        <div class="blog-card-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=800" alt="Scaling Institutes" class="blog-card-img">
                        </div>
                        <div class="blog-card-content">
                            <span class="blog-category">Leadership</span>
                            <h3 class="blog-card-title">A Founder’s Guide to Scaling Coaching Centers Sustainably.</h3>
                            <p class="blog-card-excerpt">Moving from 100 to 1,000 students requires more than just good teaching. It requires robust digital foundations and transparent workflows.</p>
                            <div class="blog-meta">
                                <img src="https://ui-avatars.com/api/?name=Arif+Siddiqui&background=ec4899&color=fff" class="blog-author-img">
                                <span>Arif Siddiqui • March 28, 2026</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Blog 3 -->
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                    <div class="blog-card glass">
                        <div class="blog-card-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&q=80&w=800" alt="Security" class="blog-card-img">
                        </div>
                        <div class="blog-card-content">
                            <span class="blog-category">Guides</span>
                            <h3 class="blog-card-title">Data Privacy in 2026: Protecting Student Information.</h3>
                            <p class="blog-card-excerpt">Why institute security should be your #1 priority this year, and how EduNex ensures your data is encrypted and isolated by default.</p>
                            <div class="blog-meta">
                                <img src="https://ui-avatars.com/api/?name=Sarah+Lee&background=10b981&color=fff" class="blog-author-img">
                                <span>Sarah Lee • March 25, 2026</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State / Coming Soon -->
            <div class="text-center mt-5 pt-5 animate__animated animate__fadeIn">
                <p class="text-muted fw-600 mb-0">More insights being crafted by our team...</p>
                <div class="mt-4">
                    <a href="{{ route('pricing') }}" class="btn btn-outline-modern btn-modern px-5 py-3 shadow-sm">
                        Start your trial today
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-5 my-5">
        <div class="container px-4 py-5 text-center">
            <h2 class="fw-black mb-4 display-5" style="letter-spacing: -3px;">Ready to innovate?</h2>
            <p class="text-muted mb-5 mx-auto fs-5 fw-500" style="max-width: 500px;">Join 100+ institutes that are already transforming the way they teach and manage.</p>
            <a href="{{ route('pricing') }}" class="btn btn-primary-glow btn-modern px-5 py-3 shadow-lg">View Pricing Plans <i
                    class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </section>

    <x-frontend-footer />

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @include('components.whatsapp-widget')
</body>

</html>
