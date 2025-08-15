<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $lead->name ?? '') }}">
</div>
<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $lead->email ?? '') }}">
</div>
<div class="mb-3">
    <label>Phone</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $lead->phone ?? '') }}">
</div>
<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
        @foreach (['new', 'contacted', 'closed'] as $status)
            <option value="{{ $status }}" {{ old('status', $lead->status ?? '') == $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label>Assign to Agent</label>
    <select name="assigned_to" class="form-control">
        <option value="">Unassigned</option>
        @foreach ($agents as $agent)
            <option value="{{ $agent->id }}"
                {{ old('assigned_to', $lead->assigned_to ?? '') == $agent->id ? 'selected' : '' }}>
                {{ $agent->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label>Notes</label>
    <textarea name="notes" class="form-control">{{ old('notes', $lead->notes ?? '') }}</textarea>
</div>
