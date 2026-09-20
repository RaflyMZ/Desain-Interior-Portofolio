<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\ProjectMedia;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Profil ─────────────────────────────
        Profile::truncate();
        Profile::create([
            'nama'             => 'Ghiyas',
            'bio'              => "Saya menempuh pendidikan Sarjana Desain Interior di Universitas Telkom. Memiliki pengalaman dalam desain ruang di beberapa organisasi kampus maupun di luar dan menduduki posisi seperti tim display dan penanggung jawab desain.\n\nMemiliki kemampuan berpikir kreatif dengan barang-barang yang ada di sekitar & mampu mewujudkan ruang imajinasi menjadi kenyataan melalui software 3D. Memiliki minat berkarir di bidang desain interior atau di industri kreatif khususnya di bidang desain dan seni.\n\nMemiliki semangat belajar dan siap berkontribusi kreatif di lingkungan profesional melalui program magang atau kerja.",
            'foto'             => 'images/profile/ghiyas.jpg',
            'filosofi_desain'  => 'Kesederhanaan bukan kekurangan — ia adalah keberanian untuk melepaskan yang tidak perlu.',
        ]);

        // ─── Kontak ──────────────────────────────
        Contact::truncate();
        Contact::create([
            'email'         => 'ghiyas.rizwan@gmail.com',
            'telepon'       => null,
            'alamat'        => null,
            'instagram_url' => 'https://instagram.com/ghiyasrn',
            'whatsapp'      => null,
            'linkedin_url'  => 'https://www.linkedin.com/in/ghiyasrizwan/',
        ]);

        // ─── Pengalaman ───────────────────────────
        Experience::truncate();
        $experiences = [
            [
                'title'          => 'Interior Design Intern',
                'company'        => 'VEINELAB',
                'periode'        => 'Mei 2025 — Agustus 2025',
                'tahun_mulai'    => 2025,
                'tahun_selesai'  => 2025,
                'ringkasan'      => 'Terlibat dalam berbagai proses desain interior mulai dari pengembangan konsep, visualisasi 3D (rendering foto & video), penyusunan gambar kerja & teknikal furnitur, hingga perancangan area Master Bedroom, Living Room, serta fasilitas publik/kesehatan.',
                'deskripsi'      => "Selama menjalani pengalaman kerja di VEINELAB, saya terlibat dalam berbagai proses desain interior, mulai dari pengembangan konsep, visualisasi, hingga penyusunan gambar teknikal. Pekerjaan yang dilakukan meliputi pembuatan gambar kerja dan gambar teknikal furniture, rendering ruang dan furniture berbasis foto, serta video rendering untuk kebutuhan visualisasi dan konten.\n\nDalam proses desain, saya juga berkesempatan mengembangkan desain area Master Bedroom yang terdiri dari area tidur, kamar mandi, dan walk-in closet, serta mengerjakan desain Living Room dengan mempertimbangkan kebutuhan pengguna, fungsi ruang.\n\nSebagian besar proyek yang dikerjakan berada dalam lingkup home living, khususnya hunian dan furniture. Selain itu, saya juga terlibat dalam pengerjaan gambar teknikal untuk proyek di luar lingkup hunian, seperti fasilitas rumah sakit, terutama pada aspek furniture dan kebutuhan dokumentasi teknisnya.",
                'gallery'        => [
                    [
                        'title'       => '3D Model',
                        'image'       => 'images/experience/sub-judul-1.jpg',
                        'description' => 'Konsep & visualisasi rendering berbasis foto & video.',
                    ],
                    [
                        'title'       => 'Gambar Teknikal',
                        'image'       => 'images/experience/sub-judul-2.jpg',
                        'description' => 'Gambar kerja teknikal furniture & detail fabrikasi.',
                    ],
                    [
                        'title'       => 'Visual Render',
                        'image'       => 'images/experience/sub-judul-3.jpg',
                        'description' => 'Perancangan interior Master Bedroom & Living Room.',
                    ],
                ],
                'urutan'         => 1,
            ],
        ];

        foreach ($experiences as $data) {
            Experience::create($data);
        }

        // ─── Sertifikasi ──────────────────────────
        $certificates = [
            [
                'title'      => 'SketchUp for Interior Design Training',
                'issuer'     => 'SketchUp Indonesia (PT. Vexa Dinamika Teknologi) · Telkom University',
                'tanggal'    => 'November 2024',
                'deskripsi'  => "Pelatihan kompetensi pemodelan 3D dan visualisasi interior profesional, mencakup:\n• SketchUp All Features & Advanced Modeling\n• Interior Design Workflow\n• Enscape Photorealistic Rendering\n• SketchUp LayOut Documentation\n\nHasil Penilaian: Final Grade 95.2 (Grade A / Sangat Memuaskan) — Assessor: Rizky Ramadityo, M.Ars.",
                'file_url'   => 'files/sertifikat-sketchup-training-ghiyas-rizwan.pdf',
                'urutan'     => 1,
            ],
        ];

        Certificate::truncate();
        foreach ($certificates as $cert) {
            Certificate::create($cert);
        }

        // ─── Proyek ───────────────────────────────
        ProjectMedia::truncate();
        Project::truncate();

        $projects = [
            [
                'slug'        => 'area-bisnis-hotel-bintang-4',
                'title'       => 'Area Bisnis Hotel Bintang 4',
                'kategori'    => 'Hospitality',
                'deskripsi'   => 'Desain area bisnis terpadu pada hotel bintang 4, mencakup executive business lounge, ruang rapat eksklusif (boardroom), dan co-working hub. Konsep memadukan estetika modern kontemporer dengan sentuhan material alami bernuansa hangat—panel kayu akustik, pencahayaan arsitektural tersembunyi (warm ambient lighting), dan furnitur ergonomis mewah—untuk menciptakan suasana kerja yang produktif, elegan, dan prestisius bagi para tamu bisnis.',
                'client'      => 'Grand Horizon Hotel & Resort',
                'tahun'       => 2024,
                'cover_image' => 'images/projects/hotel-business-lounge/0_6aa27c9faab3a.jpg',
                'urutan'      => 1,
                'media'       => [
                    'images/projects/hotel-business-lounge/0_6aa27c9faab3a.jpg',
                    'images/projects/hotel-business-lounge/1_6aa27ca03aa7a.jpg',
                    'images/projects/hotel-business-lounge/2_6aa27ca0c20c9.jpg',
                    'images/projects/modern-boardroom-meeting-room/4_6aa27eb9370fe.jpg',
                    'images/projects/modern-boardroom-meeting-room/5_6aa27ebac6b2c.jpg',
                ],
            ],
            [
                'slug'        => 'kamar-dan-lobby-hotel-bintang-3',
                'title'       => 'Kamar & Lobby Hotel Bintang 3',
                'kategori'    => 'Hospitality',
                'deskripsi'   => 'Pengembangan interior terintegrasi untuk lobby utama dan kamar tamu (deluxe & standard guest room) pada hotel bintang 3 berkonsep urban modern. Menghadirkan welcoming experience yang hangat pada area lobby melalui reception desk beraksen pencahayaan dinamis dan seating area yang nyaman, serta tata ruang kamar yang efisien, menenangkan, dan fungsional dengan palet warna earthy tones dan furnitur modular custom.',
                'client'      => 'The Urban Haven Hotel',
                'tahun'       => 2023,
                'cover_image' => 'images/projects/hotel-lobby-modern-interior/1_6aa27ecd7a1cf.jpg',
                'urutan'      => 2,
                'media'       => [
                    'images/projects/hotel-lobby-modern-interior/1_6aa27ecd7a1cf.jpg',
                    'images/projects/hotel-lobby-modern-interior/2_6aa27edac6bb9.jpg',
                    'images/projects/hotel-lobby-modern-interior/3_6aa27ee851980.jpg',
                    'images/projects/modern-hotel-bedroom-interior/4_6aa27f1cba0b1.jpg',
                    'images/projects/modern-hotel-bedroom-interior/5_6aa27f1d977c2.jpg',
                    'images/projects/modern-hotel-bedroom-interior/6_6aa27f1e2dc4f.jpg',
                ],
            ],
            [
                'slug'        => 'minimalist-residential-living-room',
                'title'       => 'Minimalist Residential Living Room',
                'kategori'    => 'Residential',
                'deskripsi'   => 'Perancangan ruang keluarga bernuansa minimalis modern dengan pencahayaan alami optimal, material kayu alami hangat, dan tata letak yang lapang untuk menciptakan atmosfer relaksasi bagi keluarga.',
                'client'      => 'Private Residence',
                'tahun'       => 2024,
                'cover_image' => 'images/projects/minimalist-residential-living-room-interior/1_6a8d995a9afab.jpg',
                'urutan'      => 3,
                'media'       => [
                    'images/projects/minimalist-residential-living-room-interior/1_6a8d995a9afab.jpg',
                    'images/projects/minimalist-residential-living-room-interior/2_6a8d995b043d0.jpg',
                    'images/projects/minimalist-residential-living-room-interior/3_6a8d995b479d8.jpg',
                    'images/projects/minimalist-residential-living-room-interior/4_6a8d995b7e657.jpg',
                    'images/projects/minimalist-residential-living-room-interior/5_6a8d995bc82e9.jpg',
                ],
            ],
            [
                'slug'        => 'luxury-penthouse-suite',
                'title'       => 'Luxury Penthouse Suite',
                'kategori'    => 'Residential',
                'deskripsi'   => 'Konsep interior penthouse modern mewah dengan pemandangan panorama kota, material marmer premium, aksen metalik elegan, dan integrasi pencahayaan ambient untuk menciptakan kemewahan kontemporer.',
                'client'      => 'Skyline Residences',
                'tahun'       => 2024,
                'cover_image' => 'images/projects/luxury-penthouse-interior-design/1_6a8d61929f6d9.jpg',
                'urutan'      => 4,
                'media'       => [
                    'images/projects/luxury-penthouse-interior-design/1_6a8d61929f6d9.jpg',
                    'images/projects/luxury-penthouse-interior-design/2_6a8d61933692b.jpg',
                    'images/projects/luxury-penthouse-interior-design/3_6a8d6193a0877.jpg',
                    'images/projects/luxury-penthouse-interior-design/4_6a8d619405bf7.jpg',
                    'images/projects/luxury-penthouse-interior-design/5_6a8d6194684b4.jpg',
                ],
            ],
            [
                'slug'        => 'bamboo-sanctuary-restaurant',
                'title'       => 'Bamboo Sanctuary Restaurant',
                'kategori'    => 'Commercial',
                'deskripsi'   => 'Desain restoran berkonsep arsitektur biofilik memadukan elemen bambu artisanal, pencahayaan temaram hangat, dan tanaman indoor untuk pengalaman bersantap yang menenangkan dan autentik.',
                'client'      => 'Sanctuary Dining Group',
                'tahun'       => 2023,
                'cover_image' => 'images/projects/restaurant-interior-bamboo/1_6a8d61d3252b5.jpg',
                'urutan'      => 5,
                'media'       => [
                    'images/projects/restaurant-interior-bamboo/1_6a8d61d3252b5.jpg',
                    'images/projects/restaurant-interior-bamboo/2_6a8d61d4830cb.jpg',
                    'images/projects/restaurant-interior-bamboo/3_6a8d61d632480.jpg',
                    'images/projects/restaurant-interior-bamboo/4_6a8d61d7a50a1.jpg',
                ],
            ],
            [
                'slug'        => 'creative-studio-modern-office',
                'title'       => 'Creative Studio & Workspace',
                'kategori'    => 'Commercial',
                'deskripsi'   => 'Desain ruang kerja kolaboratif dengan konsep open space ergonomis, meeting pods kedap suara, dan area breakout kreatif untuk meningkatkan produktivitas dan kenyamanan kerja tim.',
                'client'      => 'Innova Creative Hub',
                'tahun'       => 2023,
                'cover_image' => 'images/projects/modern-office-interior/1_6a8d614ac20e9.jpg',
                'urutan'      => 6,
                'media'       => [
                    'images/projects/modern-office-interior/1_6a8d614ac20e9.jpg',
                    'images/projects/modern-office-interior/2_6a8d614b9bcfb.jpg',
                    'images/projects/modern-office-interior/3_6a8d614c2ef3e.jpg',
                    'images/projects/modern-office-interior/4_6a8d614c91d10.jpg',
                ],
            ],
        ];

        foreach ($projects as $data) {
            $mediaList = $data['media'] ?? [];
            unset($data['media']);

            $project = Project::create($data);

            foreach ($mediaList as $order => $mediaPath) {
                ProjectMedia::create([
                    'project_id'  => $project->id,
                    'type'        => 'image',
                    'source'      => 'client',
                    'path_or_url' => $mediaPath,
                    'order'       => $order,
                ]);
            }
        }
    }
}
