<!DOCTYPE html>
<html>
<head>
    <title>Attendance List</title>
</head>
<body>
    <h1>Attendance List</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Total Working Hours</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $attendance)
            <tr>
                <td>{{ $attendance->name }}</td>
                <td>{{ $attendance->checkin ?? 'N/A' }}</td>
                <td>{{ $attendance->checkout ?? 'N/A' }}</td>
                <td>{{ $attendance->total_working_hours ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
