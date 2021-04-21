<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactsController extends Controller
{
    public function index()
    {
        $title = 'Сообщения';
        $contacts = Contact::latest()->get();
        return view('contacts.index', compact('contacts', 'title'));
    }

    public function create()
    {
        $title = 'Форма обратной связи';
        return view('contacts.create', compact('title'));
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

        $title = 'Форма обратной связи';
        $success = 'Сообщение успешно отправлено';
        return redirect('/contacts')->with([
            'success' => 'Сообщение успешно отправлено',
            ]);
//        return view('contacts.create', compact('title', 'success'));
    }
}
