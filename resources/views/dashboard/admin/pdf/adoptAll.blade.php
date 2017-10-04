<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<body>
<h1 align="center">Cebu Pound Animal</h1>
<!-- <h3>Pet Registered</h3> -->
<table>
    <tr>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Breed</th>
        <th>Color</th>
        <th>Birth Date</th>
        <th>Type</th>
        <th>Adopted By</th>

    </tr>
    @foreach($adopts as $adopt)
        <tr>
            <td>{{ $adopt->impound->pet->name }}</td>
            <td>{{ $adopt->impound->pet->age }}</td>
            <td>{{ $adopt->impound->pet->gender }}</td>
            <td>{{ $adopt->impound->pet->breed->name }}</td>
            <td>{{ $adopt->impound->pet->color }}</td>
            <td>{{ $adopt->impound->pet->birth_date }}</td>
            <td>{{ $adopt->impound->pet->type->name }}</td>
            <td>{{ $adopt->user->first_name }} {{ $adopt->user->last_name }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>