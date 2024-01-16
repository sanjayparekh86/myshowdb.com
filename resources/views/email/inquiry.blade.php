<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 36%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>New Inquiry Submitted</h2>

<table>
    <tr>
        <th>Email</th>
        <td>{{ $data['email'] }}</td>
    </tr>
    <tr>
        <th>Phone</th>
        <td>{{ $data['phone'] }}</td>
    </tr>
    <tr>
        <th>Message</th>
        <td>{{ $data['message'] }}</td>
    </tr>
</table>

</body>
</html>
