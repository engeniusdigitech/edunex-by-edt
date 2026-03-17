<style>
    /* ── WHATSAPP WIDGET ── */
    .wa-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(4px);
        z-index: 9998;
        animation: fadeInWA 0.3s ease;
    }

    .wa-backdrop.d-none {
        display: none !important;
    }

    .whatsapp-widget {
        position: fixed;
        bottom: 25px;
        left: 25px;
        z-index: 9999;
    }

    .whatsapp-btn {
        width: 56px;
        height: 56px;
        background-color: #25D366;
        color: #fff;
        border-radius: 50%;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .whatsapp-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 16px rgba(37, 211, 102, 0.4);
    }

    .whatsapp-form-card {
        position: absolute;
        bottom: 60px;
        left: 0;
        width: 280px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transform-origin: bottom left;
        animation: slideUpWA 0.3s ease-out;
        z-index: 10000;
    }

    .whatsapp-form-card.d-none {
        display: none !important;
    }

    .bg-whatsapp {
        background-color: #128C7E !important;
    }

    .btn-whatsapp {
        background-color: #25D366 !important;
        border: none;
    }

    .btn-whatsapp:hover {
        background-color: #128C7E !important;
    }

    @keyframes slideUpWA {
        from {
            opacity: 0;
            transform: translateY(15px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes fadeInWA {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
</style>

<!-- Backdrop -->
<div id="wa-backdrop" class="wa-backdrop d-none" onclick="toggleWhatsappForm()"></div>

<div id="whatsapp-widget" class="whatsapp-widget">
    <!-- Form Card -->
    <div id="whatsapp-form-card" class="whatsapp-form-card d-none">
        <div class="card-header bg-whatsapp text-white d-flex justify-content-between align-items-center p-3">
            <div class="d-flex align-items-center gap-2">
                <i class="fab fa-whatsapp fs-5"></i>
                <span class="fw-bold small">Chat with us</span>
            </div>
            <button type="button" class="btn-close btn-close-white btn-sm" onclick="toggleWhatsappForm()"></button>
        </div>
        <div class="p-3">
            <form id="wa-form">
                <div class="mb-2">
                    <label class="form-label small mb-1" style="font-size: 0.75rem;">Name</label>
                    <input type="text" id="wa-name" class="form-control form-control-sm" required
                        placeholder="Your Name">
                </div>
                <div class="mb-2">
                    <label class="form-label small mb-1" style="font-size: 0.75rem;">Number</label>
                    <input type="text" id="wa-phone" class="form-control form-control-sm" required
                        placeholder="Your Phone">
                </div>
                <div class="mb-2">
                    <label class="form-label small mb-1" style="font-size: 0.75rem;">Country</label>
                    <input type="text" id="wa-country" class="form-control form-control-sm" required
                        placeholder="Your Country">
                </div>
                <div class="mb-3">
                    <label class="form-label small mb-1" style="font-size: 0.75rem;">Message</label>
                    <textarea id="wa-message" class="form-control form-control-sm" rows="3"
                        placeholder="How can we help?"></textarea>
                </div>
                <button type="submit" class="btn btn-whatsapp w-100 btn-sm text-white fw-bold">Send Message <i
                        class="fas fa-paper-plane ms-1"></i></button>
            </form>
        </div>
    </div>

    <!-- Floating Button -->
    <button class="whatsapp-btn" onclick="toggleWhatsappForm()">
        <i class="fab fa-whatsapp"></i>
    </button>
</div>

<script>
    function toggleWhatsappForm() {
        const card = document.getElementById('whatsapp-form-card');
        const backdrop = document.getElementById('wa-backdrop');
        if (card && backdrop) {
            card.classList.toggle('d-none');
            backdrop.classList.toggle('d-none');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('wa-form');
        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const name = document.getElementById('wa-name').value;
                const phone = document.getElementById('wa-phone').value;
                const country = document.getElementById('wa-country').value;
                const message = document.getElementById('wa-message').value;

                const text = `*New Lead from Website* 🚀\n\n*Name:* ${name}\n*Phone:* ${phone}\n*Country:* ${country}\n\n*Message:* ${message}`;
                const encodedText = encodeURIComponent(text);
                const waUrl = `https://wa.me/918160490089?text=${encodedText}`;

                window.open(waUrl, '_blank');
                toggleWhatsappForm();
                form.reset();
            });
        }
    });
</script>