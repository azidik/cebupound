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
@extends('layouts.pdf')
   
@section('content')
<table>
    <tr>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Breed</th>
        <th>Color</th>
        <th>Birth Date</th>
        <th>Type</th>
        <th>Owned By</th>

    </tr>
    @foreach($pets as $pet)
        <tr>
            <td>{{ $pet->name }}</td>
            <td>{{ $pet->age }}</td>
            <td>{{ $pet->gender }}</td>
            <td>{{ $pet->breed }}</td>
            <td>{{ $pet->color }}</td>
            <td>{{ $pet->birth_date }}</td>
            <td>{{ $pet->type->name }}</td>
            <td>{{ $pet->user->first_name }} {{ $pet->user->last_name }}</td>
        </tr>
    @endforeach
</table>
@endsection