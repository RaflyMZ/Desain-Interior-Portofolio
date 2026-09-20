<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class ProjectShow extends Component
{
    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $project = Project::with('media')->where('slug', $this->slug)->firstOrFail();

        return view('livewire.project-show', compact('project'))
            ->layout('layouts.app', [
                'title'       => $project->title,
                'description' => $project->deskripsi ?? "Proyek {$project->title} oleh Studio Interior.",
            ]);
    }
}
