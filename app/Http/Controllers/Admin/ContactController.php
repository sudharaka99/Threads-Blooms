<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('admin.contacts.index', ['messages' => ContactMessage::latest()->get()]);
    }

    public function show(ContactMessage $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    public function reply(Request $request, ContactMessage $contact)
    {
        return redirect()->back();
    }

    public function destroy(ContactMessage $contact)
    {
        $contact->delete();
        return redirect()->back();
    }
}
