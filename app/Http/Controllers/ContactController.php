<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function dashboard()
    {
        return view('contact.dashboard');
    }

    public function list(Request $request)
    {
        $query = Contact::where('user_id', auth()->id());

        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%")
                  ->orWhere('phone', 'LIKE', "%$search%")
                  ->orWhere('company', 'LIKE', "%$search%");
            });
        }

        $contacts = $query->latest()->paginate(2);

        return view('contact.contact_list', compact('contacts'));
    }

    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:50',
        ]);

        Contact::create([
            'user_id' => auth()->id(),
            ...$validated
        ]);

        return redirect('/dashboard')->with('success', 'Contact added successfully');
    }

    public function edit($id)
    {
        $contact = Contact::where('user_id', auth()->id())
                        ->findOrFail($id);

        return view('contact.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::where('user_id', auth()->id())
                        ->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:50',
        ]);

        $contact->update($validated);

        return redirect('/dashboard')->with('success', 'Contact updated');
    }

    public function destroy($id)
    {
        $contact = Contact::where('user_id', auth()->id())
                          ->where('id', $id)
                          ->firstOrFail();

        $contact->delete();

        return response()->json(['success' => true]);
    }
}
