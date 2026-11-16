<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $nativeCovers = [
            'house-mr-s'       => 'images/projects/house-mr-s/mr-s-1.png',
            'kitchen-set-mr-l' => 'images/projects/kitchen-set-mr-l/kitchen-set-mr-l.png',
            'house-mr-a'       => 'images/projects/house-mr-a/mr-a-1.png',
            'hotel-bisnis'     => 'images/projects/hotel-bisnis/ballroom.png',
        ];

        $projects = Project::orderBy('urutan')->orderByDesc('tahun')->get()
            ->map(function ($project) use ($nativeCovers) {
                if (isset($nativeCovers[$project->slug])) {
                    $project->cover_image = $nativeCovers[$project->slug];
                }
                return $project;
            })
            ->filter(fn ($project) => !empty($project->cover_image) && $project->slug !== 'project-internship')
            ->values();

        return view('livewire.home', compact('projects'))
            ->layout('layouts.app', [
                'title'       => 'Home',
                'description' => 'Portofolio desain interior — ruang yang dirancang dengan presisi dan ketenangan.',
            ]);
    }

}
