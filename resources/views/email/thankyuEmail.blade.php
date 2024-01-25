<!-- resources/views/email/thankyuEmail.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 60%;
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

<h2>Copy of your inquiry</h2>


<table>
    <tr>
        <th>Name</th>
        <td>{{ $inquiry['name'] }}</td>
    </tr>
    <tr>
        <th>Phone</th>
        <td>{{ $inquiry['phone'] }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $inquiry['email'] }}</td>
    </tr>
    <tr>
        <th>Message</th>
        <td>{{ $inquiry['message'] }}</td>
    </tr>
</table>

</body>
</html>
