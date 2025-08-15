<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadRequest;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            $leads = Lead::paginate(10);
        } else {
            $leads = Lead::where('user_id', $user->id)->paginate(10);;
        }

        return response()->json($leads);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeadRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
        ]);

        $lead = Lead::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'status'      => $request->status ?? 'new',
            'assigned_to' => $request->assigned_to ?? $request->user()->id,
            'notes'       => $request->notes,
        ]);

        return response()->json([
            'message' => 'Lead created successfully.',
            'data'    => $lead
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Lead $lead)
    {
        if ($request->user()->role !== 'admin' && $lead->assigned_to !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($lead);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        if ($request->user()->role !== 'admin' && $lead->assigned_to !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'email'       => 'nullable|email|max:255',
            'phone'       => 'nullable|string|max:20',
            'status'      => 'nullable|in:new,contacted,closed',
            'assigned_to' => 'nullable|exists:users,id',
            'notes'       => 'nullable|string',
        ]);

        $lead->update($request->only(['name', 'email', 'phone', 'status', 'assigned_to', 'notes']));

        return response()->json([
            'message' => 'Lead updated successfully.',
            'data'    => $lead
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Lead $lead)
    {
        if ($request->user()->role !== 'admin' && $lead->assigned_to !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $lead->delete();

        return response()->json(['message' => 'Lead deleted successfully.']);
    }
}
