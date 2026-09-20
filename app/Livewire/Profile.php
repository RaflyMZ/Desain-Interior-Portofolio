<?php

namespace App\Livewire;

use App\Models\Profile as ProfileModel;
use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        $profile = ProfileModel::first();

        return view('livewire.profile', compact('profile'))
            ->layout('layouts.app', [
                'title'       => 'Profil',
                'description' => 'Kenali filosofi dan perjalanan desainer di balik studio ini.',
            ]);
    }
}
