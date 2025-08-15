@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Lead</h2>
        <form action="{{ route('leads.update', $lead) }}" method="POST">
            @csrf @method('PUT')
            @include('leads.partials.form')
            <button class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
