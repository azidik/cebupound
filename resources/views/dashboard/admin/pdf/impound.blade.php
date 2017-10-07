@extends('layouts.pdf')
   
@section('content')
    <h3>Pet Information - Impound</h3>
    <p>Name: {{ $impound->pet->name }}</p>   
    <p>Age: {{ $impound->pet->age }}</p>
    <p>Birth Date: {{ $impound->pet->birth_date }}</p>
    <p>Breed: {{ $impound->pet->breed }}</p>
    <p>Color: {{ $impound->pet->color }}</p>
    <p>Impounded By: {{ $impound->pet->user->first_name }} {{ $impound->pet->user->last_name }}</</p>
    <p>Reason: {{ $impound->reason }}</</p>
@endsection