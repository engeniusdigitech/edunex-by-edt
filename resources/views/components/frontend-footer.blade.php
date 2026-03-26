<footer class="footer py-5" style="border-top: 1px solid #e2e8f0; background: #fff;">
    <div class="container px-4">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="footer-logo mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="EduNex" style="height: 50px;" class="me-2">
                </div>
                <p class="text-muted small mb-4 fw-500">The ultimate SaaS platform for modern educational institutes. Built by educators, for educators.</p>
                <div class="d-flex gap-3">
                    <a href="https://www.linkedin.com/company/engenius-digitech/?viewAsMember=true" target="_blank"
                        class="footer-link fs-5"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <h6 class="fw-bold mb-4 text-uppercase ls-1 small">Platform</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ url('/') }}#features" class="footer-link small">Features</a></li>
                    <li class="mb-2"><a href="{{ route('pricing') }}" class="footer-link small">Pricing</a></li>
                    <li class="mb-2"><a href="{{ route('trial.request') }}" class="footer-link small">Live Demo</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-lg-2">
                <h6 class="fw-bold mb-4 text-uppercase ls-1 small">Company</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('about') }}" class="footer-link small">About Us</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}" class="footer-link small">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-lg-2">
                <h6 class="fw-bold mb-4 text-uppercase ls-1 small">Legal</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('legal.privacy') }}" class="footer-link small">Privacy Policy</a></li>
                    <li class="mb-2"><a href="{{ route('legal.terms') }}" class="footer-link small">Terms & Conditions</a></li>
                    <li class="mb-2"><a href="{{ route('legal.refund') }}" class="footer-link small">Refund Policy</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-lg-2 text-md-end">
                <h6 class="fw-bold mb-4 text-uppercase ls-1 small">Product by</h6>
                <h5 class="fw-black text-dark mb-1">Engenius Digitech</h5>
                <p class="text-muted small">Specialized in SaaS solutions</p>
            </div>
        </div>
        <div class="border-top mt-5 pt-4 text-center">
            <p class="text-muted small mb-0 fw-600">© {{ date('Y') }} EduNex. All rights reserved.</p>
        </div>
    </div>
</footer>
