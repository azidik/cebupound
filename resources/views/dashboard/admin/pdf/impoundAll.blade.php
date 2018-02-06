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
        <th>Birth Date</th>
        <th>Type</th>
        <th>Impounded By</th>

    </tr>
    @foreach($impounds as $impound)
        <tr>
            <td>
                <img src="{{ asset('/images/'. $impound['pet']['image']) }}" width="50" height="50"/>
            </td>
            <td>{{ $impound['pet']['name'] }}</td>
            <td>{{ $impound['pet']['age'] }}</td>
            <td>{{ $impound['pet']['gender'] }}</td>
            <td>{{ $impound['pet']['breed']['name'] }}</td>
            <td>{{ $impound['pet']['color'] }}</td>
            <td>{{ $impound['pet']['birth_date'] }}</td>
            <td>{{ $impound['pet']['type']['name'] }}</td>
            <td>{{ $impound['pet']['user']['first_name'] }} {{ $impound['pet']['user']['last_name'] }}</td>
        </tr>
    @endforeach
</table>
@endsection