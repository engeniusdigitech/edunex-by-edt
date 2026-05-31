<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Barcode - {{ $book->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        .barcode-container {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
        }
        .book-title {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        @media print {
            .no-print {
                display: none;
            }
            .barcode-container {
                border: none;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">Print Barcode</button>
        <button onclick="window.close()" style="padding: 10px 20px; font-size: 16px; cursor: pointer; margin-left:10px;">Close</button>
    </div>

    <div class="barcode-container">
        <div class="book-title">{{ $book->title }}</div>
        
        <div style="margin-top: 5px;">
            {!! \Milon\Barcode\Facades\DNS1DFacade::getBarcodeHTML($book->barcode ?? $book->isbn ?? $book->id, 'C128', 2, 60) !!}
        </div>
        <div style="margin-top: 5px; font-size: 12px; letter-spacing: 2px;">
            {{ $book->barcode ?? $book->isbn ?? $book->id }}
        </div>
    </div>
</body>
</html>
