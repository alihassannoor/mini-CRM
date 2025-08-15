@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Leads</h2>
        <a href="{{ route('leads.create') }}" class="btn btn-primary mb-3">Add Lead</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Agent</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leads as $lead)
                    <tr>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->email }}</td>
                        <td>{{ $lead->phone }}</td>
                        <td>{{ $lead->status }}</td>
                        <td>{{ $lead->agent->name ?? 'Unassigned' }}</td>
                        <td>
                            <a href="{{ route('leads.edit', $lead) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('leads.destroy', $lead) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this lead?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $leads->links() }}
    </div>
@endsection
