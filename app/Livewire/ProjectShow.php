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

        $nativeDescriptions = [
            'dasyid-house' => "Desain kamar tidur ini mengusung konsep Scandinavian yang mengutamakan kesederhanaan, kenyamanan, dan fungsionalitas. Perpaduan warna netral, material kayu bernuansa natural, serta pencahayaan alami dari bukaan jendela menciptakan suasana ruang yang hangat, tenang, dan nyaman.\n\nPenggunaan furnitur dengan bentuk sederhana dan garis yang bersih memperkuat karakter Scandinavian, sementara lemari built-in dan rak terbuka dirancang untuk mengoptimalkan penyimpanan tanpa mengurangi kesan lapang. Elemen panel kayu pada area tempat tidur turut memberikan kesatuan visual, sehingga keseluruhan ruang terasa harmonis dan tetap fungsional untuk kebutuhan sehari-hari.\n\nJendela besar yang menghadap langsung ke taman menghadirkan pemandangan hijau yang menyegarkan sekaligus memaksimalkan masuknya cahaya alami ke dalam ruang. Kehadiran elemen alam ini menciptakan suasana bangun pagi yang lebih segar, tenang, dan nyaman, sehingga penghuni dapat memulai hari dengan perasaan lebih rileks.",
        ];

        $deskripsi = $nativeDescriptions[$project->slug] ?? $project->deskripsi;

        return view('livewire.project-show', [
            'project'   => $project,
            'deskripsi' => $deskripsi,
        ])->layout('layouts.app', [
            'title'       => $project->title,
            'description' => $deskripsi ?? "Proyek {$project->title} oleh Studio Interior.",
        ]);
    }
}
