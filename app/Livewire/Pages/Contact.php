<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact as ModelsContact;

class Contact extends Component
{

    public $name, $email, $subject, $phone, $comment;


    public function save()
    {

        $this->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email',
            'subject' => 'required|string',
            'phone' => 'required|',
            'comment' => 'required',
        ]);

        Mail::to('ecommercesite@dev-shadin.com') // Admin's Email (আপনার ইমেইলে পাঠাবে)
            ->send(new ContactMail($this->name, $this->email, $this->subject, $this->phone, $this->comment));
        $contact = new ModelsContact();
        $contact->name = $this->name;
        $contact->email = $this->email;
        $contact->subject = $this->subject;
        $contact->phone = $this->phone;
        $contact->comment = $this->comment;
        $contact->save();

        $this->name = '';
        $this->email = '';
        $this->subject = '';
        $this->phone = '';
        $this->comment = '';

        session()->flash('success', 'Your message has been sent successfully');
    }






    public function render()
    {
        return view('livewire.pages.contact');
    }
}
