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
        <th>Owned By</th>

    </tr>
    @foreach($service_pets as $service)
        <tr>
            <td>
                @if(isset($service->pet->image_mobile) != NULL)
                    <img src="{{ $service->pet->image_mobile }}" width="50" height="50">
                @else
                    <img src="{{ asset('/images/'. $service->pet->image_mobile) }}" width="50" height="50"/>
                @endif
            </td>
            <td>{{ $service->pet->name }}</td>
            <td>{{ $service->pet->age }}</td>
            <td>{{ $service->pet->gender }}</td>
            <td>{{ $service->pet->breed->name }}</td>
            <td>{{ $service->pet->color }}</td>
            <td>{{ $service->pet->birth_date }}</td>
            <td>{{ $service->pet->type->name }}</td>
            <td>{{ $service->pet->user['first_name'] }} {{ $service->pet->user['first_name'] }}</td>
        </tr>
    @endforeach
</table>
@endsection