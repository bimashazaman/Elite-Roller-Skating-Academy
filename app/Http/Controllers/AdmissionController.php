<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdmissionController extends Controller
{
    public function index()
    {
        $admissions = Admission::latest()->paginate(15);
        return view('admin.admissions.index', compact('admissions'));
    }

    public function create()
    {
        return view('admissions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'sport_interest' => 'required|string|max:100',
            'experience_level' => 'required|string',
            'medical_conditions' => 'nullable|string',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20',
            'preferred_training_time' => 'nullable|string|max:100',
            'additional_notes' => 'nullable|string',
            'document_uploads' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        if ($request->hasFile('document_uploads')) {
            $validated['document_uploads'] = $request->file('document_uploads')->store('admissions/documents', 'public');
        }

        $admission = Admission::create($validated);

        return redirect()->route('admission.create')
            ->with('success', 'Your admission form has been submitted successfully. We will contact you soon.');
    }

    public function show(Admission $admission)
    {
        return view('admin.admissions.show', compact('admission'));
    }

    public function updateStatus(Request $request, Admission $admission)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $admission->update($validated);

        return redirect()->route('admin.admissions.index')
            ->with('success', 'Admission status updated successfully.');
    }

    public function destroy(Admission $admission)
    {
        if ($admission->document_uploads) {
            Storage::disk('public')->delete($admission->document_uploads);
        }

        $admission->delete();

        return redirect()->route('admin.admissions.index')
            ->with('success', 'Admission record deleted successfully.');
    }
}
