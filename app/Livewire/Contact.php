<?php

namespace App\Livewire;

use App\Models\Contact as ContactModel;
use Livewire\Component;

class Contact extends Component
{
    public function render()
    {
        $contact = ContactModel::first();

        return view('livewire.contact', compact('contact'))
            ->layout('layouts.app', [
                'title'       => 'Hubungi',
                'description' => 'Informasi kontak dan saluran komunikasi studio desain interior.',
            ]);
    }
}
