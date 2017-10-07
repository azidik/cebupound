@extends('layouts.pdf')
   
@section('content')
    <h3>Pet Information - Adopt</h3>
    <p>Name: {{ $adopt->impound->pet->name }}</p>   
    <p>Age: {{ $adopt->impound->pet->age }}</p>
    <p>Birth Date: {{ $adopt->impound->pet->birth_date }}</p>
    <p>Breed: {{ $adopt->impound->pet->breed->name }}</p>
    <p>Color: {{ $adopt->impound->pet->color }}</p>
    <p>Adopted By: {{ $adopt->user->first_name }} {{ $adopt->user->last_name }}</</p>
@endsection