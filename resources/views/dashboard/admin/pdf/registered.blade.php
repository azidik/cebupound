@extends('layouts.pdf')
   
@section('content')
    <h3>Pet Information - Registered</h3>
    <p>Name: {{ $registered->name }}</p>   
    <p>Age: {{ $registered->age }}</p>
    <p>Birth Date: {{ $registered->birth_date }}</p>
    <p>Breed: {{ $registered->breed }}</p>
    <p>Color: {{ $registered->color }}</p>
    <p>Owned By: {{ $registered->user->first_name }} {{ $registered->user->last_name }}</</p>
@endsection