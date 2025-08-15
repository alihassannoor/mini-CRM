@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Lead</h2>
        <form action="{{ route('leads.store') }}" method="POST">
            @csrf
            @include('leads.partials.form')
            <button class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
