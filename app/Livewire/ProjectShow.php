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
            'hotel-bisnis' => "Suasana hall lift pada perancangan ini terinspirasi dari Gunung Pangrango di Sukabumi, sebagai salah satu identitas alam yang kuat dan inspirasi motif batik Pancasona. Konsep ini bertujuan menghadirkan pengalaman ruang yang membuat pengunjung seolah berada di puncak gunung, dengan suasana luas yang menyerupai pemandangan deretan bukit dan pegunungan di sekitarnya.\n\nSuasana area prefunction yang ingin diciptakan pada perancangan ini terinspirasi dari suasana rimba, dengan mengambil referensi dari kawasan Lembah Purba yang berada di wilayah Sukabumi, tepatnya di kawasan Geopark Ciletuh. Pengunjung dapat merasakan suasana visual yang merepresentasikan hutan rimba yang dikombinasikan dengan konsep luxury melalui penggunaan material batu alam, dan detail finishing elegan.\n\nSuasana area ballroom dan ruang rapat terinspirasi dari Pantai Pangumbahan Sukabumi. Pengunjung saat memasuki area ballroom dan ruang rapat akan dihadirkan dengan suasana sejuk, dan berangin yang terinspirasi dari elemen laut yang menjadi bagian dari konsep Gurilaps. Suasana tersebut bertujuan menciptakan pengalaman ruang yang nyaman dan menenangkan.",
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
