<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo title="Contact EduNex ERP | Free Demo of School Management Software & Institute ERP" description="Contact EduNex ERP to book a free live demo of our school management software and institute ERP. Talk to our experts. We set up your school in under 15 minutes. Contact us today — respond within 1 business day." keywords="school management software demo, book school ERP demo, institute ERP contact, school software free demo, EduNex ERP contact, school software support, institute software sales, school ERP demo request, school management software vadodara, school erp support india, best school software demo" pageType="ContactPage" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @include('components.frontend-styles')
<style>
*,*::before,*::after{box-sizing:border-box;}
body {
    font-family:'Inter',system-ui,sans-serif;
    background:#F8FAFC;
    color:#0F172A;
    overflow-x:hidden;
    -webkit-font-smoothing:antialiased;
}
:root{
    --bg:#F8FAFC;
    --card:#FFFFFF;
    --border:#E2E8F0;
    --muted:#64748B;
    --primary:#0D9488;
    --secondary:hsl(217,91%,60%);
    --gradient:linear-gradient(135deg,#0D9488,hsl(217,91%,60%));
}
section{background:transparent!important;}

/* Hero */
.contact-hero {
    padding:200px 0 80px;
    text-align:center; position:relative; overflow:hidden;
}
.contact-hero::before {
    content:'';position:absolute;top:-200px;left:50%;transform:translateX(-50%);
    width:700px;height:500px;
    background:radial-gradient(ellipse,hsla(174,72%,56%,0.08) 0%,transparent 70%);
    pointer-events:none;
}
.eyebrow {
    display:inline-flex;align-items:center;gap:7px;
    background:hsla(174,72%,56%,0.1);border:1px solid hsla(174,72%,56%,0.22);
    border-radius:9999px;padding:5px 14px;
    font-size:0.72rem;font-weight:600;color:#0D9488;
    text-transform:uppercase;letter-spacing:1px;margin-bottom:22px;
}
.page-h1 {
    font-size:clamp(2.5rem,5vw,4rem);font-weight: 500;
    letter-spacing:-2.5px;line-height:1.08;margin-bottom:18px;color:#0F172A;
}
.g-text{background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.page-sub{font-size:1rem;color:var(--muted);line-height:1.85;max-width:520px;margin:0 auto;}

/* Contact card */
.contact-card {
    background:var(--card);border:1px solid var(--border);
    border-radius:20px;overflow:hidden;
    box-shadow:0 30px 80px -20px rgba(0,0,0,0.06);
    max-width:1000px;margin:0 auto;
}
.contact-form-col { padding:50px; }
.contact-info-col {
    background:#F8FAFC;
    border-left:1px solid var(--border);
    padding:50px; display:flex; flex-direction:column;
    position:relative; overflow:hidden;
}
.contact-info-col::before {
    content:'';position:absolute;top:-150px;right:-100px;
    width:350px;height:350px;border-radius:50%;
    background:hsla(174,72%,56%,0.05);filter:blur(60px);pointer-events:none;
}

/* Form */
.form-group{margin-bottom:22px;}
.form-lbl {
    display:block;font-size:0.72rem;font-weight: 500;
    text-transform:uppercase;letter-spacing:1px;
    color:var(--muted);margin-bottom:8px;
}
.form-inp {
    width:100%;padding:13px 16px;border-radius:10px;
    background:#FFFFFF;
    border:1px solid var(--border);color:#0F172A;
    font-family:inherit;font-size:0.9rem;transition:all 0.2s;outline:none;
}
.form-inp:focus {
    border-color:var(--primary);
    background:#F8FAFC;
    box-shadow:0 0 0 3px hsla(174,72%,56%,0.12);
}
.form-inp::placeholder{color:#94A3B8;}
.form-inp option{background:#FFFFFF;color:#0F172A;}
textarea.form-inp{resize:vertical;min-height:130px;}

.submit-btn {
    width:100%;padding:14px;border-radius:10px;border:none;cursor:pointer;
    background:var(--gradient);color:#FFFFFF;
    font-weight: 500;font-size:0.95rem;font-family:inherit;
    display:flex;align-items:center;justify-content:center;gap:8px;
    box-shadow:0 0 24px hsla(174,72%,56%,0.3);
    transition:all 0.25s ease;
}
.submit-btn:hover{opacity:0.9;transform:translateY(-2px);}
.submit-btn:disabled{opacity:0.6;cursor:not-allowed;transform:none;}

/* Info cards */
.ic {
    display:flex;align-items:center;gap:16px;
    background:#F8FAFC;border:1px solid var(--border);
    border-radius:12px;padding:16px 18px;margin-bottom:14px;
    transition:all 0.2s;
}
.ic:hover{border-color:hsla(174,72%,56%,0.3);background:#F1F5F9;}
.ic-icon {
    width:42px;height:42px;border-radius:10px;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;font-size:1rem;
}
.ic-icon.teal{background:hsla(174,72%,56%,0.15);color:hsl(174,72%,40%);}
.ic-icon.blue{background:hsla(217,91%,60%,0.15);color:hsl(217,91%,50%);}
.ic-icon.green{background:hsla(120,60%,50%,0.15);color:hsl(120,60%,35%);}
.ic-title{font-size:0.85rem;font-weight: 500;color:#0F172A;margin-bottom:2px;}
.ic-val{font-size:0.78rem;color:var(--muted);}

/* Success screen */
.success-screen{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:120px 20px;}
.success-card{
    background:var(--card);border:1px solid var(--border);
    border-radius:24px;padding:60px 48px;max-width:540px;width:100%;text-align:center;
    animation:pop 0.5s cubic-bezier(0.34,1.56,0.64,1) forwards;
    box-shadow:0 4px 24px rgba(0,0,0,0.06);
}
@keyframes pop{from{opacity:0;transform:translateY(24px) scale(0.95)}to{opacity:1;transform:none}}
.success-icon{
    width:88px;height:88px;border-radius:50%;
    background:hsla(174,72%,56%,0.12);border:2px solid hsla(174,72%,56%,0.3);
    display:flex;align-items:center;justify-content:center;
    font-size:2.2rem;color:var(--primary);margin:0 auto 28px;
    animation:pulse-icon 2.5s ease-in-out infinite;
}
@keyframes pulse-icon{0%,100%{box-shadow:0 0 0 0 hsla(174,72%,56%,0.3)}50%{box-shadow:0 0 0 16px hsla(174,72%,56%,0)}}

@media(max-width:991px){
    .contact-form-col,.contact-info-col{padding:32px 24px;}
    .contact-info-col{border-left:none;border-top:1px solid var(--border);}
    .page-h1{font-size:2.5rem;letter-spacing:-2px;}
}
</style>
</head>
<body>
@include('components.frontend-navbar')

@if(session('success'))
<div class="success-screen">
    <div class="success-card">
        <div class="success-icon"><i class="fas fa-check"></i></div>
        <h2 style="font-size:1.8rem;font-weight: 500;color:#0F172A;letter-spacing:-1px;margin-bottom:12px;">Message Sent!</h2>
        <p style="color:var(--muted);line-height:1.8;margin-bottom:32px;">{{ session('success') }}<br>Our team typically responds within <strong style="color:#0F172A;">1 business day</strong>.</p>
        <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;margin-bottom:32px;">
            <span style="display:inline-flex;align-items:center;gap:6px;background:#F8FAFC;border:1px solid var(--border);border-radius:9999px;padding:6px 14px;font-size:0.78rem;color:var(--muted);">
                <i class="fas fa-clock" style="color:var(--primary);"></i> Within 1 business day
            </span>
            <span style="display:inline-flex;align-items:center;gap:6px;background:#F8FAFC;border:1px solid var(--border);border-radius:9999px;padding:6px 14px;font-size:0.78rem;color:var(--muted);">
                <i class="fas fa-shield-alt" style="color:var(--primary);"></i> Your data is safe
            </span>
        </div>
        <a href="{{ url('/') }}" style="display:inline-flex;align-items:center;gap:8px;background:var(--gradient);color:#FFFFFF;text-decoration:none;padding:13px 28px;border-radius:10px;font-weight: 500;font-size:0.95rem;">
            <i class="fas fa-home"></i> Back to Home
        </a>
    </div>
</div>
@else

<!-- Hero -->
<section class="contact-hero">
    <div class="container px-4" style="position:relative;z-index:2;">
        <h1 class="page-h1">Let's start your<br><span class="g-text">digital transformation.</span></h1>
        <p class="page-sub">Whether you have a question, need a demo, or want a custom deployment — our team at Engenius Digitech is here.</p>
    </div>
</section>

<!-- Contact Body -->
<section style="padding:0 0 100px;">
    <div class="container px-4">
        <div class="contact-card">
            <div class="row g-0">
                <!-- Form -->
                <div class="col-lg-7 contact-form-col">
                    <h3 style="font-size:1.3rem;font-weight: 500;letter-spacing:-0.5px;color:#0F172A;margin-bottom:32px;">Send us a message</h3>
                    <form id="ejs-contact-form">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-lbl">Full Name</label>
                                    <input type="text" name="name" id="ejs_name" class="form-inp" placeholder="e.g. Arjun Sharma" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-lbl">Email Address</label>
                                    <input type="email" name="email" id="ejs_email" class="form-inp" placeholder="arjun@institute.com" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-lbl">Inquiry Type</label>
                                    <select name="inquiry_type" id="ejs_inquiry" class="form-inp">
                                        <option>General Sales Inquiry</option>
                                        <option>Partner with us</option>
                                        <option>Technical Support</option>
                                        <option>Custom Enterprise Setup</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-lbl">Your Message</label>
                                    <textarea name="message" id="ejs_message" class="form-inp" placeholder="Tell us about your institute and how we can help..."></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" id="ejs-submit-btn" class="submit-btn">
                                    <span id="ejs-btn-text">Submit Inquiry <i class="fas fa-paper-plane"></i></span>
                                    <span id="ejs-btn-loading" style="display:none;">
                                        <span class="spinner-border spinner-border-sm me-2"></span>Sending…
                                    </span>
                                </button>
                                <p style="text-align:center;font-size:0.75rem;color:var(--muted);margin-top:14px;">
                                    <i class="fas fa-clock me-1" style="color:var(--primary);"></i> We typically respond within 1 business day.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Info -->
                <div class="col-lg-5 contact-info-col">
                    <h3 style="font-size:1.3rem;font-weight: 500;letter-spacing:-0.5px;color:#0F172A;margin-bottom:32px;">Contact Details</h3>

                    

                    <div class="ic">
                        <div class="ic-icon blue"><i class="fas fa-paper-plane"></i></div>
                        <div>
                            <div class="ic-title">Sales &amp; Partnerships</div>
                            <div class="ic-val">engeniusdigitech@gmail.com</div>
                        </div>
                    </div>

                    <div class="ic">
                        <div class="ic-icon green"><i class="fas fa-location-dot"></i></div>
                        <div>
                            <div class="ic-title">Headquarters</div>
                            <div class="ic-val">Vadodara, Gujarat, India</div>
                        </div>
                    </div>

                    <div style="margin-top:auto;padding-top:36px;border-top:1px solid var(--border);">
                        <div style="font-size:0.68rem;font-weight: 500;text-transform:uppercase;letter-spacing:1.2px;color:var(--primary);margin-bottom:12px;">Crafted by</div>
                        <a href="https://engeniusdigitech.netlify.app" target="_blank" style="text-decoration:none;">
                            <div style="font-size:1.05rem;font-weight: 500;color:#0F172A;margin-bottom:4px;">Engenius Digitech</div>
                            <div style="font-size:0.78rem;color:var(--muted);">Leading specialized SaaS solutions <i class="fas fa-external-link-alt" style="font-size:0.6rem;"></i></div>
                        </a>
                        <div style="margin-top:16px;">
                            <a href="https://www.linkedin.com/company/engenius-digitech" target="_blank"
                               style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#F1F5F9;border:1px solid var(--border);color:var(--muted);text-decoration:none;font-size:0.9rem;transition:all 0.2s;"
                               onmouseover="this.style.color='hsl(174,72%,60%)';this.style.borderColor='hsl(174,72%,56%)';"
                               onmouseout="this.style.color='var(--muted)';this.style.borderColor='var(--border)';">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<x-frontend-footer/>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
<script>
(function() { emailjs.init({ publicKey: 'lmK1jA7aTfhahMzac' }); })();

document.getElementById('ejs-contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn  = document.getElementById('ejs-submit-btn');
    const txt  = document.getElementById('ejs-btn-text');
    const load = document.getElementById('ejs-btn-loading');

    btn.disabled = true;
    txt.style.display  = 'none';
    load.style.display = 'flex';

    emailjs.sendForm('service_0xkqhcr', 'template_fghjchm', this)
        .then(function() {
            document.querySelector('.contact-form-col').innerHTML = `
                <div style="text-align:center;padding:40px 20px;animation:pop 0.5s cubic-bezier(0.34,1.56,0.64,1) forwards;">
                    <div style="width:80px;height:80px;border-radius:50%;background:hsla(174,72%,56%,0.12);border:2px solid hsla(174,72%,56%,0.3);display:flex;align-items:center;justify-content:center;font-size:2rem;color:hsl(174,72%,56%);margin:0 auto 24px;animation:pulse-icon 2.5s ease-in-out infinite;">
                        <i class="fas fa-check"></i>
                    </div>
                    <h3 style="font-size:1.5rem;font-weight: 500;color:#0F172A;letter-spacing:-0.5px;margin-bottom:10px;">Message Sent!</h3>
                    <p style="color:var(--muted);line-height:1.8;margin-bottom:28px;">
                        Thanks for reaching out!<br>
                        Our team typically responds within <strong style="color:#0F172A;">1 business day</strong>.
                    </p>
                    <a href="{{ url('/') }}" style="display:inline-flex;align-items:center;gap:8px;background:var(--gradient);color:#FFFFFF;text-decoration:none;padding:12px 24px;border-radius:10px;font-weight: 500;">
                        <i class="fas fa-home"></i> Back to Home
                    </a>
                </div>`;
        }, function(error) {
            btn.disabled = false;
            txt.style.display = 'flex';
            load.style.display = 'none';
            alert('Something went wrong. Please email us at engeniusdigitech@gmail.com');
            console.error('EmailJS error:', error);
        });
});
</script>
@include('components.whatsapp-widget')
@endif
</body>
</html>