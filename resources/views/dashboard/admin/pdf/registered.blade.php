<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 align="center">Cebu Pound Animal</h1>
    <br>
    <h3>Pet Information - Registered</h3>
    <p>Name: {{ $registered->name }}</p>   
    <p>Age: {{ $registered->age }}</p>
    <p>Birth Date: {{ $registered->birth_date }}</p>
    <p>Breed: {{ $registered->breed->name }}</p>
    <p>Color: {{ $registered->color }}</p>
    <p>Owned By: {{ $registered->user->first_name }} {{ $registered->user->last_name }}</</p>
</body>
</html>