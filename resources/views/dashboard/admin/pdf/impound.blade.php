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
    <h3>Pet Information - Impound</h3>
    <p>Name: {{ $impound->pet->name }}</p>   
    <p>Age: {{ $impound->pet->age }}</p>
    <p>Birth Date: {{ $impound->pet->birth_date }}</p>
    <p>Breed: {{ $impound->pet->breed }}</p>
    <p>Color: {{ $impound->pet->color }}</p>
    <p>Impounded By: {{ $impound->pet->user->first_name }} {{ $impound->pet->user->last_name }}</</p>
    <p>Reason: {{ $impound->reason }}</</p>
</body>
</html>