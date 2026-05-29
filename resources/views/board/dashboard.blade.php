@extends('layouts.board')
@section('title', 'Board Dashboard - DEPED Region V Recruitment')
@section('content')
<h1 class="text-xl font-semibold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }} - {{ ucfirst(auth()->user()->role) }}</h1>
@endsection
