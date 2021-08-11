<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ecommerce Email Document</title>
</head>

<body>
    <table>
        <tr>
            <td>Dear, {{ $name }}</td>
        </tr>
        <tr>
            <td>Welcome to my ecommerce. Your account are as below:-</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Name : {{ $name }}</td>
        </tr>

        <tr>
            <td>Please activate your email by clicking:-</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <a href="{{ url('confirm/'.$code) }}">Confirm Account</a>
            </td>
        </tr>
        <tr>
            <td>Thanks and regards,</td>
        </tr>
        <tr>
            <td>Ecommerce Website</td>
        </tr>
    </table>
</body>

</html>
