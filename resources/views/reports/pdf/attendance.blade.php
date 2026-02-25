<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Attendance Report</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #ddd; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #2c3e50; }
        .header p { margin: 5px 0 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f4f6f9; color: #2c3e50; }
        .text-success { color: green; font-weight: bold; }
        .text-danger { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Attendance Report</h2>
        <p><strong>Batch:</strong> {{ $batch->name }} | <strong>Month:</strong> {{ date('F Y', strtotime($month . '-01')) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Total Classes</th>
                <th>Attended</th>
                <th>Percentage</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData as $row)
            <tr>
                <td>{{ $row['student']->name }}</td>
                <td>{{ $row['total'] }}</td>
                <td>{{ $row['present'] }}</td>
                <td class="{{ $row['percentage'] >= 75 ? 'text-success' : 'text-danger' }}">{{ $row['percentage'] }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
