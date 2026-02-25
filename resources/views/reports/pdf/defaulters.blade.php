<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Fee Defaulters Report</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #ddd; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #c0392b; }
        .header p { margin: 5px 0 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f4f6f9; color: #2c3e50; }
        .text-danger { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Fee Defaulters Report</h2>
        <p><strong>Month:</strong> {{ date('F Y', strtotime($currentMonth . '-01')) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Batch</th>
                <th>Contact Phone</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($defaulters as $student)
            <tr>
                <td>{{ $student->name }}<br><small style="color:#666;">{{ $student->email }}</small></td>
                <td>{{ $student->batch->name ?? 'N/A' }}</td>
                <td>{{ $student->phone ?? 'Not provided' }}</td>
                <td class="text-danger">Unpaid</td>
            </tr>
            @endforeach
            @if(count($defaulters) === 0)
            <tr>
                <td colspan="4" style="text-align: center; padding: 30px;">No defaulters found this month.</td>
            </tr>
            @endif
        </tbody>
    </table>
</body>
</html>
