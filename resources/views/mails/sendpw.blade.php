<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password untuk Login</title>
</head>

<body>
    <h1>Selamat Anda Telah Terdaftar Sebagai Admin LPPM UNLA!</h1>
    <hr>
    <p>
        Password Anda : {{ $data['password'] }}
        <br>
        Username Anda : {{ $data['username'] }}
    </p>

</body>

</html>
