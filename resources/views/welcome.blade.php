<?php

use App\Http\Resources\Equipment_types_Resource;
use App\Models\Equipment;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment_types;

?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>API SPA</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
SPA

Регистрация нового юзера API:
<form action="api/auth/register" method="post">
    {{csrf_field()}}
    Name: <input type="text" name="name"> <br>
    Email: <input type="text" name="email"> <br>
    Пароль: <input type="password" name="password" placeholder="Введите пароль" required> <br>
    <input type="submit" value="Получить токен API">
</form>
<br>
<br>
Войти для получения доступа к API
<form action="auth/login" method="post">
    {{csrf_field()}}
    Email: <input type="text" name="email"> <br>
    Пароль: <input type="password" name="password"> <br>
    <input type="submit" value="Войти">
</form>
<br>
<br>
<div>
    @if (!empty($user))
        @include('change')
    @else
        @include('look')
    @endif
</div>
</body>
</html>
