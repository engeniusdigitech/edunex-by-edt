<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print QR Code - {{ $book->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        .qr-container {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
        }
        .book-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
        }
        .book-meta {
            font-size: 12px;
            color: #555;
            margin-bottom: 15px;
        }
        @media print {
            .no-print {
                display: none;
            }
            .qr-container {
                border: none;
            }
        }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">Print QR Code</button>
        <button onclick="window.close()" style="padding: 10px 20px; font-size: 16px; cursor: pointer; margin-left:10px;">Close</button>
    </div>

    <div class="qr-container">
        <div class="book-title">{{ $book->title }}</div>
        <div class="book-meta">ISBN: {{ $book->isbn ?? 'N/A' }} | {{ $book->author?->name }}</div>
        
        <div style="margin-top: 10px;">
            {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate($book->qr_data ?? $book->isbn ?? $book->id) !!}
        </div>
        <div style="margin-top: 10px; font-size: 10px; color: #888;">
            Library Property
        </div>
    </div>
</body>
</html>
