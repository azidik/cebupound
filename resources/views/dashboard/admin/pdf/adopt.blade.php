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
        <th>Gender</th>
        <th>Breed</th>
        <th>Color</th>
        <th>Adopted By</th>
    </tr>
 
    <tr>
        <td>
            <img src="{{ asset('/images/'. $adopt->impound->pet->image) }}" width="50" height="50"/>
        </td>
        <td>{{ $adopt->impound->pet->name }}</td>
        <td>{{ $adopt->impound->pet->age }}</td>
        <td>{{ $adopt->impound->pet->gender }}</td>
        <td>{{ $adopt->impound->pet->breed->name }}</td>
        <td>{{ $adopt->impound->pet->color }}</td>
        <td>{{ $adopt->impound->pet->user->first_name }} {{ $adopt->impound->pet->user->last_name }}</td>
    </tr>
</table>
@endsection