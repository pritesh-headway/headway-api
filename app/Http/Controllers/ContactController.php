<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->checkAuthorization(auth()->user(), ['contacts.create']);
        return view('backend.pages.contacts.index', [
            'contacts' => Contact::where('is_deleted', 0)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'message' => 'required|string',
        //     'phone' => 'nullable|string|max:20',
        //     'city' => 'nullable|string|max:100',
        // ]);

        // $contact = new Contact();
        // $contact->name = $request->name;
        // $contact->email = $request->email;
        // $contact->message = $request->message;
        // $contact->phone = $request->phone;
        // $contact->city = $request->city;
        // $contact->save();

        // session()->flash('success', __('Contact message has been sent successfully.'));
        // return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
