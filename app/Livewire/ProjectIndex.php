<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class ProjectIndex extends Component
{
    public string $filter = '';

    public function render()
    {
        $projects = Project::when($this->filter, fn($q) => $q->where('kategori', $this->filter))
            ->orderBy('urutan')
            ->orderByDesc('tahun')
            ->get();

        $kategori = Project::distinct()->pluck('kategori')->filter()->sort()->values();

        return view('livewire.project-index', compact('projects', 'kategori'))
            ->layout('layouts.app', [
                'title'       => 'Proyek',
                'description' => 'Galeri proyek desain interior — dari hunian hingga ruang komersial.',
            ]);
    }
}
