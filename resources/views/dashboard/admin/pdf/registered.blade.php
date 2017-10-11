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
        <th>Image</th>
        <th>Name</th>
        <th>Age</th>
        <th>Birth Date</th>
        <th>Breed</th>
        <th>Color</th>
        <th>Owned By</th>
    </tr>
 
    <tr>
        <td><img src="{{ asset('/images/'. $registered->image) }}"/></td>
        <td>{{ $registered->name }}</td>
        <td>{{ $registered->age }}</td>
        <td>{{ $registered->birth_date }}</td>
        <td>{{ $registered->breed->name }}</td>
        <td>{{ $registered->color }}</td>
        <td>{{ $registered->user->first_name }} {{ $registered->user->last_name }}</td>
    </tr>
</table>
@endsection

