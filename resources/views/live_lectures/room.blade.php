<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $liveLecture->title }} — Live Lecture</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Outfit', sans-serif; background: #0f0f1a; color: white; display: flex; flex-direction: column; height: 100vh; }
        
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 24px;
            background: rgba(255,255,255,0.05);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            flex-shrink: 0;
        }
        .top-bar .lecture-info h4 { font-size: 1rem; font-weight: 700; margin-bottom: 2px; }
        .top-bar .lecture-info span { font-size: 0.8rem; color: rgba(255,255,255,0.5); }
        .live-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #ef4444;
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 20px;
            letter-spacing: 1px;
        }
        .live-badge .dot {
            width: 8px; height: 8px; background: white;
            border-radius: 50%;
            animation: blink 1s infinite;
        }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.2} }

        #jitsi-container { flex: 1; width: 100%; }

        .bottom-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 16px;
            padding: 12px 24px;
            background: rgba(255,255,255,0.05);
            border-top: 1px solid rgba(255,255,255,0.08);
            flex-shrink: 0;
        }
        .btn-end {
            background: #ef4444;
            color: white;
            border: none;
            padding: 10px 28px;
            border-radius: 50px;
            font-weight: 700;
            cursor: pointer;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s;
        }
        .btn-end:hover { background: #dc2626; }
        .btn-back {
            background: rgba(255,255,255,0.1);
            color: white;
            border: 1px solid rgba(255,255,255,0.15);
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-back:hover { background: rgba(255,255,255,0.18); color: white; }
    </style>
</head>
<body>
    <div class="top-bar">
        <div class="lecture-info">
            <h4><i class="fas fa-broadcast-tower me-2 text-danger"></i>{{ $liveLecture->title }}</h4>
            <span>{{ $liveLecture->subject }} &bull; {{ $liveLecture->batch->name }}</span>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="live-badge"><div class="dot"></div> LIVE</div>
        </div>
    </div>

    <div id="jitsi-container"></div>

    @if($isHost ?? false)
    <div class="bottom-bar">
        <a href="{{ route('live-lectures.index') }}" class="btn-back"><i class="fas fa-arrow-left me-1"></i> Back to Dashboard</a>
        <form action="{{ route('live-lectures.end', $liveLecture) }}" method="POST" onsubmit="return confirm('End this live session? Students will no longer be able to join.')">
            @csrf
            <button type="submit" class="btn-end"><i class="fas fa-stop-circle"></i> End & Save Lecture</button>
        </form>
    </div>
    @endif

    <script src='https://meet.jit.si/external_api.js'></script>
    <script>
        const domain = 'meet.jit.si';
        const options = {
            roomName: '{{ $liveLecture->room_name }}',
            width: '100%',
            height: '100%',
            parentNode: document.getElementById('jitsi-container'),
            userInfo: {
                displayName: '{{ auth()->user()->name ?? auth('student')->user()->name ?? 'User' }}'
            },
            configOverwrite: {
                startWithAudioMuted: false,
                startWithVideoMuted: false,
                disableDeepLinking: true,
            },
            interfaceConfigOverwrite: {
                TOOLBAR_BUTTONS: [
                    'microphone', 'camera', 'closedcaptions', 'desktop', 'fullscreen',
                    'fodeviceselection', 'hangup', 'chat', 'raisehand', 'tileview',
                ],
                SHOW_JITSI_WATERMARK: false,
                SHOW_WATERMARK_FOR_GUESTS: false,
                DEFAULT_BACKGROUND: '#0f0f1a',
            },
        };
        const api = new JitsiMeetExternalAPI(domain, options);
    </script>
</body>
</html>
