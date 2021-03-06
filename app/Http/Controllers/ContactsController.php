<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Gate;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store()
    {
        $this->validate(request(), [
           'email' => 'required|email:filter',
           'message' => 'required|max:255',
        ]);

        $contact = new Contact();
        $contact->email = request('email');
        $contact->message = request('message');
        $contact->save();

        $success = 'Сообщение успешно отправлено';
        return redirect(route('contacts.create'))->with([
            'success' => 'Сообщение успешно отправлено',
            ]);
    }
}
