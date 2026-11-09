<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\ProjectMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }

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
                'slug'        => 'hotel-bisnis',
                'title'       => 'Hotel Bisnis',
                'kategori'    => 'Hospitality',
                'deskripsi'   => "Proyek ini merupakan perancangan interior pada hotel bisnis di Sukabumi yang mencakup guest room — kamar tidur dan walk-in closet — serta fasilitas MICE berupa prefunction area dan ballroom. Perancangan dipadukan dengan identitas lokal pesisir Sukabumi melalui interpretasi motif Batik Gurilaps, sehingga menghasilkan desain yang fungsional, elegan, dan memperkuat karakter tempat.",
                'client'      => null,
                'tahun'       => 2025,
                'cover_image' => 'images/projects/hotel-bisnis/ballroom.png',
                'urutan'      => 3,
                'media'       => [
                    [
                        'path'      => 'images/projects/hotel-bisnis/walk-in-closet.png',
                        'caption'   => 'Walk-in Closet — Dark Contemporary',
                        'deskripsi' => "Desain walk-in closet ini mengusung konsep Dark Contemporary yang menonjolkan kesan elegan, eksklusif, dan maskulin melalui perpaduan warna gelap, material bertekstur, serta pencahayaan yang terarah.\n\nDominasi warna cokelat tua dan hitam pada panel dinding serta furnitur menciptakan karakter ruang yang kuat dan intim. Sentuhan tekstur kayu pada lantai memberikan keseimbangan visual, sementara penggunaan material kaca pada kabinet menghadirkan kesan modern sekaligus memperlihatkan koleksi pakaian secara terorganisasi.\n\nPencahayaan aksen pada dinding dan pencahayaan tersembunyi pada area display menjadi elemen utama dalam membangun suasana ruang. Kontras antara cahaya hangat dan permukaan gelap mempertegas detail material serta menciptakan kedalaman visual tanpa menghilangkan kesan minimalis.\n\nTata letak ruang dirancang dengan pendekatan fungsional melalui integrasi area penyimpanan tertutup dan display terbuka. Hasilnya adalah walk-in closet yang tidak hanya berfungsi sebagai area penyimpanan, tetapi juga menghadirkan pengalaman ruang yang personal, rapi, dan berkelas.",
                    ],
                    [
                        'path'      => 'images/projects/hotel-bisnis/prefunction-area.png',
                        'caption'   => 'Prefunction Area — Konsep Rimba',
                        'deskripsi' => "Area prefunction mengusung pendekatan Sense of Place dengan tema Rimba, terinspirasi dari kekayaan alam dan vegetasi Sukabumi. Karakter ini diwujudkan melalui material kayu, warna alami, tekstur organik, serta interpretasi Batik Gurilaps untuk memperkuat identitas lokal dalam balutan desain modern dan elegan.\n\nPenataan furnitur fleksibel, sirkulasi terorganisasi, pencahayaan, dan dukungan teknologi dirancang untuk menunjang kenyamanan serta fungsi ruang sebagai area transisi menuju ballroom.",
                    ],
                    [
                        'path'      => 'images/projects/hotel-bisnis/ballroom.png',
                        'caption'   => 'Ballroom — Konsep Laut',
                        'deskripsi' => "Ballroom mengusung pendekatan Sense of Place dengan tema Laut, terinspirasi dari karakter pesisir Sukabumi. Identitas lokal diterapkan melalui interpretasi motif Batik Gurilaps dan elemen visual yang terinspirasi dari pergerakan air serta perjalanan penyu menuju laut, dalam balutan desain modern dan elegan.\n\nUntuk menunjang kebutuhan MICE, ruang dirancang fleksibel melalui penggunaan partisi otomatis, pencahayaan yang dapat disesuaikan, sistem tata udara, dan elemen akustik guna meningkatkan kenyamanan serta kualitas kegiatan.",
                    ],
                ],
            ],
            [
                'slug'        => 'dasyid-house',
                'title'       => 'Dasyid House',
                'kategori'    => 'Residential',
                'deskripsi'   => "Perancangan interior hunian modern dengan konsep Dasyid House yang menekankan kesederhanaan, fungsi, dan keseimbangan antara ruang interior maupun exterior. Desain ini dirancang untuk menciptakan suasana hunian yang nyaman, sejuk, dan harmonis bagi penghuninya.",
                'client'      => null,
                'tahun'       => 2025,
                'cover_image' => 'images/projects/dasyid-house/kamar-tidur.png',
                'urutan'      => 1,
                'media'       => [
                    [
                        'path'      => 'images/projects/dasyid-house/kamar-tidur.png',
                        'caption'   => 'Master Bedroom — Skandinavian',
                        'deskripsi' => "Desain kamar tidur ini menggunakan konsep Skandinavian yang memungkinkan fungsionalitas, kesederhanaan, material kayu alami, serta palet warna netral untuk menyediakan suasana kamar tidur yang bersih dan menyederhanakan. Penggunaan furnitur dengan bentuk sederhana dan garis yang bersih memungkinkan karakter Skandinavian, sementara lemari built-in dan rak terbuka dirancang untuk mengoptimalkan penggunaan ruang tanpa mengganggu estetika. Elemen panel kayu pada area tempat tidur memberikan kesan hangat, sementara tekstur material memberikan elemen fungsional untuk kebutuhan penyimpanan tanpa mengganggu kemegahan ruang. Pencahayaan difusikan sebagai alat untuk menciptakan suasana pagi yang lebih segar, tenang, dan harmonis.",
                    ],
                ],
            ],
            [
                'slug'        => 'kitchen-set-mr-o',
                'title'       => 'Kitchen Set Mr. O',
                'kategori'    => 'Residential',
                'deskripsi'   => "Pengembangan desain ini merupakan bagian dari kelanjutan proyek interior di VEINELAB, dengan revisi pada detail, komposisi warna, dan elemen furnitur untuk menyelaraskan kebutuhan serta preferensi klien. Konsep modern dipadu dengan sentuhan material kayu untuk menghasilkan suasana ruang yang hangat, modern, dan segar. Penggunaan warna lembut pada dinding, plafon, dan lantai, serta ruang makanan dan ruang keluar saling terhubung dengan harmonis. Setiap elemen furniture direncanakan berdasarkan kebutuhan pengguna, menciptakan kenyamanan serta efisiensi ruang. Hasil revisi kemudian divisualisasikan dalam bentuk render untuk diajukan kepada klien sebagai bahan evaluasi dan pengembangan desain lebih lanjut.",
                'client'      => null,
                'tahun'       => 2025,
                'cover_image' => 'images/projects/kitchen-set-mr-o/Enscape_2026-03-22-22-43-02_P5.jpg',
                'urutan'      => 2,
                'media'       => [
                    [
                        'path'      => 'images/projects/kitchen-set-mr-o/Enscape_2026-03-22-22-43-02_P5.jpg',
                        'caption'   => 'Kitchen Set Mr. O — Tampilan Utama',
                        'deskripsi' => "Render utama Kitchen Set Mr. O dengan konsep modern kayu.",
                    ],
                    [
                        'path'      => 'images/projects/kitchen-set-mr-o/Enscape_2026-03-13-14-03-44.jpg',
                        'caption'   => 'Kitchen Set Mr. O — Detail Dapur',
                        'deskripsi' => "Detail perancangan dapur dan elemen furnitur Kitchen Set Mr. O.",
                    ],
                    [
                        'path'      => 'images/projects/kitchen-set-mr-o/Enscape_2026-03-14-20-58-11.jpg',
                        'caption'   => 'Kitchen Set Mr. O — Ruang Makan',
                        'deskripsi' => "Tampilan ruang makanan yang terintegrasi dengan konsep Kitchen Set Mr. O.",
                    ],
                    [
                        'path'      => 'images/projects/kitchen-set-mr-o/Enscape_2026-03-17-17-06-23 (1).jpg',
                        'caption'   => 'Kitchen Set Mr. O — Sudut Ruangan',
                        'deskripsi' => "Sudut ruangan dan detail pencahayaan pada Kitchen Set Mr. O.",
                    ],
                ],
            ],
            [
                'slug'        => 'house-mr-s',
                'title'       => 'House Mr. S',
                'kategori'    => 'Residential',
                'deskripsi'   => "Perancangan interior hunian untuk klien pribadi dengan identitas House Mr. S. Konsep desain menyajikan ruang hunian yang nyaman, fungsional, dan harmonis dengan sentuhan personal yang mencerminkan karakter pemilik, melalui tata letak ruang yang efisien dan pilihan material yang berkualitas.",
                'client'      => null,
                'tahun'       => 2025,
                'cover_image' => null,
                'urutan'      => 5,
                'media'       => [],
            ],
            [
                'slug'        => 'kitchen-set-mr-l',
                'title'       => 'Kitchen Set Mr. L',
                'kategori'    => 'Residential',
                'deskripsi'   => "Perancangan interior dapur untuk klien pribadi dengan identitas Kitchen Set Mr. L. Konsep desain dirancang untuk mengoptimalkan fungsi dapur dengan tata letak yang ergonomis, kombinasi material yang cocok, serta sentuhan estetika yang mencerminkan gaya hidup pemilik hunian.",
                'client'      => null,
                'tahun'       => 2025,
                'cover_image' => null,
                'urutan'      => 6,
                'media'       => [],
            ],
            [
                'slug'        => 'house-mr-a',
                'title'       => 'House Mr. A',
                'kategori'    => 'Residential',
                'deskripsi'   => "Perancangan interior hunian untuk klien pribadi dengan identitas House Mr. A. Konsep desain menciptakan suasana hunian yang modern, nyaman, dan sejuk dengan perhatian pada tata letak ruang, pencahayaan, serta pilihan material yang mendukung kenyamanan penghuni sehari-hari.",
                'client'      => null,
                'tahun'       => 2025,
                'cover_image' => null,
                'urutan'      => 7,
                'media'       => [],
            ],
            [
                'slug'        => 'project-internship',
                'title'       => 'Project Internship',
                'kategori'    => 'Internship',
                'deskripsi'   => "Kumpulan hasil pekerjaan dan visualisasi 3D yang dihasilkan selama program magang (internship) di bidang desain interior. Meliputi berbagai proses dari pengembangan konsep, pemodelan 3D, hingga rendering interior untuk berbagai tipe ruang.",
                'client'      => null,
                'tahun'       => 2025,
                'cover_image' => null,
                'urutan'      => 4,
                'media'       => [],
            ],
        ];

        foreach ($projects as $data) {
            $mediaList = $data['media'] ?? [];
            unset($data['media']);

            $project = Project::create($data);

            foreach ($mediaList as $order => $media) {
                ProjectMedia::create([
                    'project_id'  => $project->id,
                    'type'        => 'image',
                    'source'      => 'client',
                    'path_or_url' => $media['path'],
                    'caption'     => $media['caption'] ?? null,
                    'deskripsi'   => $media['deskripsi'] ?? null,
                    'order'       => $order,
                ]);
            }
        }

        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }
}
