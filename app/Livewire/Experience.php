<?php

namespace App\Livewire;

use App\Models\Certificate as CertificateModel;
use App\Models\Experience as ExperienceModel;
use Livewire\Component;

class Experience extends Component
{
    public function render()
    {
        $experiences  = ExperienceModel::orderBy('urutan')->orderByDesc('tahun_mulai')->get();
        $certificates = CertificateModel::orderBy('urutan')->orderByDesc('id')->get();

        return view('livewire.experience', compact('experiences', 'certificates'))
            ->layout('layouts.app', [
                'title'       => 'Pengalaman & Sertifikasi',
                'description' => 'Perjalanan karier, proyek, dan sertifikasi profesional di bidang desain interior.',
            ]);
    }
}
