<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo title="EduNex Blog — Insights for Modern Institute Management" description="Stay updated with the latest trends in institute management, AI attendance, payroll automation, and education technology from the EduNex team." />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @include('components.frontend-styles')
<style>
*,*::before,*::after{box-sizing:border-box;}
body{
    font-family:'Inter',system-ui,sans-serif;
    background:hsl(222,47%,6%);
    color:hsl(210,40%,98%);
    overflow-x:hidden;
    -webkit-font-smoothing:antialiased;
}
:root{
    --bg:hsl(222,47%,6%);
    --card:hsl(222,47%,8%);
    --border:hsl(217,33%,17%);
    --muted:hsl(215,20%,65%);
    --primary:hsl(174,72%,56%);
    --secondary:hsl(217,91%,60%);
    --gradient:linear-gradient(135deg,hsl(174,72%,56%),hsl(217,91%,60%));
}
section{background:transparent!important;}
.g-text{background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}

/* Hero */
.blog-hero{
    padding:150px 0 70px;text-align:center;
    position:relative;overflow:hidden;
}
.blog-hero::before{
    content:'';position:absolute;top:-200px;left:50%;transform:translateX(-50%);
    width:700px;height:500px;
    background:radial-gradient(ellipse,hsla(174,72%,56%,0.12) 0%,transparent 70%);
    pointer-events:none;
}
.eyebrow{
    display:inline-flex;align-items:center;gap:7px;
    background:hsla(174,72%,56%,0.1);border:1px solid hsla(174,72%,56%,0.22);
    border-radius:9999px;padding:5px 14px;
    font-size:0.72rem;font-weight:600;color:hsl(174,72%,70%);
    text-transform:uppercase;letter-spacing:1px;margin-bottom:22px;
}
.page-h1{font-size:clamp(2.5rem,5vw,4rem);font-weight: 500;letter-spacing:-2.5px;line-height:1.08;margin-bottom:18px;color:#fff;}
.page-sub{font-size:1rem;color:var(--muted);line-height:1.85;max-width:520px;margin:0 auto;}

/* Category pills */
.cat-pill{
    display:inline-flex;align-items:center;gap:5px;
    background:rgba(255,255,255,0.05);border:1px solid var(--border);
    border-radius:9999px;padding:7px 16px;
    font-size:0.78rem;font-weight:600;color:var(--muted);
    cursor:pointer;transition:all 0.2s;text-decoration:none;
}
.cat-pill:hover,.cat-pill.active{
    background:hsla(174,72%,56%,0.12);
    border-color:hsla(174,72%,56%,0.35);
    color:hsl(174,72%,65%);
}

/* Blog cards */
.blog-card{
    background:var(--card);border:1px solid var(--border);
    border-radius:16px;overflow:hidden;height:100%;
    display:flex;flex-direction:column;
    transition:all 0.3s cubic-bezier(0.4,0,0.2,1);
}
.blog-card:hover{
    border-color:hsla(174,72%,56%,0.35);
    box-shadow:0 0 30px hsla(174,72%,56%,0.1);
    transform:translateY(-4px);
}
.blog-img-wrap{position:relative;overflow:hidden;aspect-ratio:16/9;flex-shrink:0;}
.blog-img-wrap img{
    width:100%;height:100%;object-fit:cover;
    transition:transform 0.5s ease;display:block;
}
.blog-card:hover .blog-img-wrap img{transform:scale(1.04);}

.blog-body{padding:24px;display:flex;flex-direction:column;flex:1;}
.blog-cat{
    display:inline-block;
    background:hsla(174,72%,56%,0.12);border:1px solid hsla(174,72%,56%,0.22);
    color:hsl(174,72%,65%);border-radius:6px;
    font-size:0.65rem;font-weight: 500;text-transform:uppercase;letter-spacing:1px;
    padding:3px 10px;margin-bottom:14px;
}
.blog-title{
    font-size:1rem;font-weight: 500;color:#fff;
    line-height:1.45;margin-bottom:10px;letter-spacing:-0.3px;
}
.blog-excerpt{
    font-size:0.83rem;color:var(--muted);line-height:1.75;
    margin-bottom:20px;flex:1;
    display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;
}
.blog-meta{
    display:flex;align-items:center;justify-content:space-between;
    padding-top:16px;border-top:1px solid var(--border);
    font-size:0.75rem;color:var(--muted);
}
.blog-meta-left{display:flex;align-items:center;gap:8px;}
.blog-av{
    width:28px;height:28px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    font-size:0.65rem;font-weight: 500;color:hsl(222,47%,6%);flex-shrink:0;
}
.blog-read-more{
    display:inline-flex;align-items:center;gap:5px;
    color:var(--primary);font-size:0.75rem;font-weight:600;
    text-decoration:none;transition:gap 0.2s;
}
.blog-card:hover .blog-read-more{gap:8px;}

/* Empty state */
.empty-state{
    background:var(--card);border:1px dashed var(--border);
    border-radius:16px;padding:60px 40px;text-align:center;
}
.empty-icon{
    width:64px;height:64px;border-radius:16px;
    background:hsla(174,72%,56%,0.1);border:1px solid hsla(174,72%,56%,0.2);
    display:flex;align-items:center;justify-content:center;
    font-size:1.5rem;color:var(--primary);margin:0 auto 20px;
}

/* CTA */
.blog-cta{
    background:hsl(222,47%,5%);
    border-top:1px solid var(--border);
    padding:80px 0;text-align:center;
}
.cta-btn{
    display:inline-flex;align-items:center;gap:8px;
    background:var(--gradient);color:hsl(222,47%,6%);
    text-decoration:none;padding:13px 28px;border-radius:10px;
    font-weight: 500;font-size:0.95rem;
    box-shadow:0 0 24px hsla(174,72%,56%,0.28);
    transition:all 0.25s;
}
.cta-btn:hover{opacity:0.9;transform:translateY(-2px);color:hsl(222,47%,6%);}

@media(max-width:768px){.page-h1{font-size:2.5rem;letter-spacing:-2px;}}
</style>
</head>
<body>
@include('components.frontend-navbar')

<!-- Hero -->
<section class="blog-hero">
    <div class="container px-4" style="position:relative;z-index:2;">
        <div class="eyebrow"><i class="fas fa-newspaper"></i> Insights &amp; Innovation</div>
        <h1 class="page-h1">The <span class="g-text">EduNex Blog.</span></h1>
        <p class="page-sub">Tips, stories, and insights for institute owners, principals, and educators building the future of education.</p>
    </div>
</section>

<!-- Blog Content -->
<section style="padding:0 0 90px;">
    <div class="container px-4">

        <!-- Category Pills -->
        <div class="d-flex gap-2 flex-wrap justify-content-center mb-5">
            <a href="#" class="cat-pill active">All Posts</a>
            <a href="#" class="cat-pill">Product Updates</a>
            <a href="#" class="cat-pill">Leadership</a>
            <a href="#" class="cat-pill">Technology</a>
            <a href="#" class="cat-pill">Guides</a>
        </div>

        <!-- Blog Grid — Static featured posts (always shown) -->
        <div class="row g-4 mb-5">
            <div class="col-lg-4 col-md-6">
                <div class="blog-card">
                    <div class="blog-img-wrap">
                        <img src="https://images.unsplash.com/photo-1510074377623-8cf13fb86c08?auto=format&fit=crop&q=80&w=800" alt="AI in Education">
                    </div>
                    <div class="blog-body">
                        <span class="blog-cat">Technology</span>
                        <div class="blog-title">How Generative AI is Transforming Institute Management.</div>
                        <div class="blog-excerpt">Discover how modern ERP systems are leveraging AI to automate scheduling, attendance tracking, and predictive student performance analytics.</div>
                        <div class="blog-meta">
                            <div class="blog-meta-left">
                                <div class="blog-av" style="background:linear-gradient(135deg,hsl(262,83%,58%),hsl(217,91%,60%));">ZK</div>
                                <span>Zaid Khan · March 31, 2026</span>
                            </div>
                            <a href="#" class="blog-read-more">Read <i class="fas fa-arrow-right" style="font-size:0.6rem;"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="blog-card">
                    <div class="blog-img-wrap">
                        <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=800" alt="Scaling Institutes">
                    </div>
                    <div class="blog-body">
                        <span class="blog-cat" style="background:hsla(217,91%,60%,0.12);border-color:hsla(217,91%,60%,0.22);color:hsl(217,91%,75%);">Leadership</span>
                        <div class="blog-title">A Founder's Guide to Scaling Coaching Centers Sustainably.</div>
                        <div class="blog-excerpt">Moving from 100 to 1,000 students requires more than good teaching. It requires robust digital foundations and transparent workflows.</div>
                        <div class="blog-meta">
                            <div class="blog-meta-left">
                                <div class="blog-av" style="background:linear-gradient(135deg,hsl(347,77%,50%),hsl(262,83%,58%));">AS</div>
                                <span>Arif Siddiqui · March 28, 2026</span>
                            </div>
                            <a href="#" class="blog-read-more">Read <i class="fas fa-arrow-right" style="font-size:0.6rem;"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="blog-card">
                    <div class="blog-img-wrap">
                        <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&q=80&w=800" alt="Data Privacy">
                    </div>
                    <div class="blog-body">
                        <span class="blog-cat" style="background:hsla(38,92%,50%,0.12);border-color:hsla(38,92%,50%,0.22);color:hsl(38,92%,65%);">Guides</span>
                        <div class="blog-title">Data Privacy in 2026: Protecting Student Information.</div>
                        <div class="blog-excerpt">Why institute security should be your #1 priority this year, and how EduNex ensures your data is encrypted and isolated by default.</div>
                        <div class="blog-meta">
                            <div class="blog-meta-left">
                                <div class="blog-av" style="background:linear-gradient(135deg,hsl(174,72%,40%),hsl(217,91%,50%));">SL</div>
                                <span>Sarah Lee · March 25, 2026</span>
                            </div>
                            <a href="#" class="blog-read-more">Read <i class="fas fa-arrow-right" style="font-size:0.6rem;"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- "More coming soon" note -->
        <div class="text-center" style="padding:20px 0 10px;">
            <p style="font-size:0.85rem;color:var(--muted);">More insights being crafted by our team…</p>
        </div>

    </div>
</section>

<!-- CTA -->
<section class="blog-cta">
    <div class="container px-4">
        <span style="display:inline-flex;align-items:center;gap:6px;background:hsla(174,72%,56%,0.1);border:1px solid hsla(174,72%,56%,0.22);border-radius:9999px;padding:4px 14px;font-size:0.72rem;font-weight:600;color:hsl(174,72%,70%);text-transform:uppercase;letter-spacing:1px;margin-bottom:20px;">
            <i class="fas fa-rocket"></i> Ready to Innovate?
        </span>
        <h2 style="font-size:clamp(2rem,3.5vw,2.8rem);font-weight: 500;letter-spacing:-1.5px;color:#fff;margin-bottom:14px;">Join 100+ institutes already using EduNex.</h2>
        <p style="color:var(--muted);font-size:1rem;max-width:420px;margin:0 auto 32px;line-height:1.8;">Start your free trial today — no credit card, no setup fee.</p>
        <a href="{{ route('pricing') }}" class="cta-btn">View Pricing Plans <i class="fas fa-arrow-right"></i></a>
    </div>
</section>

<x-frontend-footer/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@include('components.whatsapp-widget')
</body>
</html>
