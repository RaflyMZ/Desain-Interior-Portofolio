<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $projects = Project::orderBy('urutan')->orderByDesc('tahun')->get();

        return view('livewire.home', compact('projects'))
            ->layout('layouts.app', [
                'title'       => 'Home',
                'description' => 'Portofolio desain interior — ruang yang dirancang dengan presisi dan ketenangan.',
            ]);
    }
}
