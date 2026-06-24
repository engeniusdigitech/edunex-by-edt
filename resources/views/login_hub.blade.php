<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-white mb-2" style="font-family:'Outfit', sans-serif;">Select Portal</h2>
        <p class="text-sm" style="color: var(--text-muted); font-size: 0.9rem;">Choose the appropriate gateway to sign in to your dashboard.</p>
    </div>

    <!-- Selection Options -->
    <div class="portal-selection-options" style="display: flex; flex-direction: column; gap: 16px; margin-top: 24px;">
        
        <!-- Student & Parent Option -->
        <a href="{{ route('student.login') }}" class="portal-option-link" style="text-decoration: none;">
            <div class="portal-option-card" style="
                background: rgba(15, 23, 42, 0.4);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 16px;
                padding: 20px;
                display: flex;
                align-items: center;
                gap: 16px;
                transition: all 0.3s ease;
                cursor: pointer;
            ">
                <div class="portal-option-icon" style="
                    width: 50px;
                    height: 50px;
                    border-radius: 12px;
                    background: rgba(13, 148, 136, 0.12);
                    border: 1px solid rgba(13, 148, 136, 0.2);
                    color: #34D399;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1.4rem;
                    flex-shrink: 0;
                ">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div style="flex-grow: 1; text-align: left;">
                    <h4 style="margin: 0 0 4px 0; font-family: 'Outfit', sans-serif; font-size: 1.05rem; font-weight: 600; color: #ffffff;">Student & Parent Portal</h4>
                    <p style="margin: 0; font-size: 0.82rem; color: #94a3b8; line-height: 1.4;">Sign in to view attendance, homework, and pay fees.</p>
                </div>
                <div class="portal-option-arrow" style="color: #94a3b8; transition: transform 0.3s ease;">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        </a>

        <!-- Staff & Admin Option -->
        <a href="{{ route('login') }}" class="portal-option-link" style="text-decoration: none;">
            <div class="portal-option-card" style="
                background: rgba(15, 23, 42, 0.4);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 16px;
                padding: 20px;
                display: flex;
                align-items: center;
                gap: 16px;
                transition: all 0.3s ease;
                cursor: pointer;
            ">
                <div class="portal-option-icon" style="
                    width: 50px;
                    height: 50px;
                    border-radius: 12px;
                    background: rgba(37, 99, 235, 0.12);
                    border: 1px solid rgba(37, 99, 235, 0.2);
                    color: #60A5FA;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1.4rem;
                    flex-shrink: 0;
                ">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div style="flex-grow: 1; text-align: left;">
                    <h4 style="margin: 0 0 4px 0; font-family: 'Outfit', sans-serif; font-size: 1.05rem; font-weight: 600; color: #ffffff;">Staff & Admin Portal</h4>
                    <p style="margin: 0; font-size: 0.82rem; color: #94a3b8; line-height: 1.4;">Sign in to manage classes, payroll, and administration.</p>
                </div>
                <div class="portal-option-arrow" style="color: #94a3b8; transition: transform 0.3s ease;">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        </a>

    </div>

    <!-- Extra Styles for Hover effects -->
    <style>
        .portal-option-card:hover {
            border-color: rgba(255, 255, 255, 0.22) !important;
            background: rgba(15, 23, 42, 0.6) !important;
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }
        .portal-option-link:first-child:hover .portal-option-icon {
            background: rgba(13, 148, 136, 0.2) !important;
            color: #14b8a6 !important;
            border-color: rgba(13, 148, 136, 0.4) !important;
        }
        .portal-option-link:last-child:hover .portal-option-icon {
            background: rgba(37, 99, 235, 0.2) !important;
            color: #3b82f6 !important;
            border-color: rgba(37, 99, 235, 0.4) !important;
        }
        .portal-option-card:hover .portal-option-arrow {
            transform: translateX(4px);
            color: #ffffff !important;
        }
    </style>
</x-guest-layout>
