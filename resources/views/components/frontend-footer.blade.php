<style>
:root {
    --ft-bg:      hsl(222,47%,5%);
    --ft-border:  hsl(217,33%,17%);
    --ft-muted:   hsl(215,20%,65%);
    --ft-primary: hsl(174,72%,56%);
    --ft-grad:    linear-gradient(135deg,hsl(174,72%,56%),hsl(217,91%,60%));
}
.site-footer {
    background: var(--ft-bg);
    border-top: 1px solid var(--ft-border);
    font-family: 'Inter', system-ui, sans-serif;
    position: relative;
    z-index: 50;
}
/* Gradient top strip */
.site-footer::before {
    content: '';
    display: block;
    height: 2px;
    background: var(--ft-grad);
    position: absolute;
    top: 0; left: 0; right: 0;
}
.site-footer .ft-inner {
    padding: 72px 32px 40px;
    max-width: 100%;
}
.ft-brand img { display: block; }
.ft-tagline {
    font-size: 0.85rem; color: var(--ft-muted); line-height: 1.75;
    margin: 16px 0 22px; max-width: 280px;
}
.ft-social a {
    display: inline-flex; align-items: center; justify-content: center;
    width: 36px; height: 36px; border-radius: 8px;
    background: rgba(255,255,255,0.05);
    border: 1px solid var(--ft-border);
    color: var(--ft-muted); font-size: 0.9rem;
    text-decoration: none; transition: all 0.2s;
}
.ft-social a:hover { color: var(--ft-primary); border-color: var(--ft-primary); background: hsla(174,72%,56%,0.08); }

.ft-col-title {
    font-size: 0.7rem; font-weight: 500;
    text-transform: uppercase; letter-spacing: 1.5px;
    color: var(--ft-primary); margin-bottom: 18px;
}
.ft-links { list-style: none; padding: 0; margin: 0; }
.ft-links li { margin-bottom: 10px; }
.ft-links a {
    font-size: 0.85rem; color: var(--ft-muted);
    text-decoration: none; transition: color 0.2s;
    display: inline-block;
}
.ft-links a:hover { color: #fff; }

.ft-bottom {
    border-top: 1px solid var(--ft-border);
    padding: 24px 32px;
    display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 6px; text-align: center;
}
.ft-copy { font-size: 0.85rem; color: var(--ft-muted); margin: 0; }
.ft-made-by { font-size: 0.85rem; color: var(--ft-muted); margin: 0; }
.ft-made-by a { color: var(--ft-primary); font-weight: 500; text-decoration: none; transition: opacity 0.2s; }
.ft-made-by a:hover { opacity: 0.8; }
</style>

<footer class="site-footer">
    <div class="ft-inner">
        <div class="container px-0" style="max-width:100%;">
            <div class="row g-5">
                <!-- Brand -->
                <div class="col-lg-4">
                    <div class="ft-brand">
                        <img src="{{ asset('images/logo.png') }}" alt="EduNex" style="height:52px;">
                    </div>
                    <p class="ft-tagline">The AI-powered platform for modern institutes. Built by educators, for educators — across coaching centers, schools, and skill institutes.</p>
                    <div class="ft-social">
                        <a href="https://www.linkedin.com/company/engenius-digitech/?viewAsMember=true" target="_blank" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <!-- Platform -->
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="ft-col-title">Platform</div>
                    <ul class="ft-links">
                        <li><a href="{{ url('/') }}#features">Features</a></li>
                        <li><a href="{{ url('/') }}#staff">AI Biometrics</a></li>
                        <li><a href="{{ route('pricing') }}">Pricing</a></li>
                        <li><a href="{{ route('trial.request') }}">Live Demo</a></li>
                        <li><a href="{{ url('/school-erp-locations') }}">School ERP Directory</a></li>
                        <li><a href="{{ url('/institute-erp-locations') }}">Institute ERP Directory</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="ft-col-title">Company</div>
                    <ul class="ft-links">
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        <li><a href="{{ route('blogs') }}">Blog</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="ft-col-title">Legal</div>
                    <ul class="ft-links">
                        <li><a href="{{ route('legal.privacy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('legal.terms') }}">Terms &amp; Conditions</a></li>
                        <li><a href="{{ route('legal.refund') }}">Refund Policy</a></li>
                    </ul>
                </div>

                <!-- Product by -->
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="ft-col-title">Built by</div>
                    <a href="https://engeniusdigitech.netlify.app" target="_blank" style="text-decoration:none;">
                        <div style="font-size:1rem;font-weight: 500;color:#fff;margin-bottom:4px;letter-spacing:-0.5px;">Engenius Digitech</div>
                        <div style="font-size:0.78rem;color:var(--ft-muted);">Specialized SaaS solutions <i class="fas fa-external-link-alt" style="font-size:0.6rem;"></i></div>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="ft-bottom">
        <p class="ft-copy">© {{ date('Y') }} EduNex. All rights reserved.</p>
        <p class="ft-made-by">A product of <a href="https://engeniusdigitech.netlify.app" target="_blank">Engenius Digitech</a></p>
    </div>
</footer>
