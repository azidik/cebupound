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
    <h3>Pet Information - Adopt</h3>
    <p>Name: {{ $adopt->impound->pet->name }}</p>   
    <p>Age: {{ $adopt->impound->pet->age }}</p>
    <p>Birth Date: {{ $adopt->impound->pet->birth_date }}</p>
    <p>Breed: {{ $adopt->impound->pet->breed }}</p>
    <p>Color: {{ $adopt->impound->pet->color }}</p>
    <p>Adopted By: {{ $adopt->user->first_name }} {{ $adopt->user->last_name }}</</p>
</body>
</html>