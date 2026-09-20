<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Profile;
use App\Livewire\Experience;
use App\Livewire\ProjectIndex;
use App\Livewire\ProjectShow;
use App\Livewire\Contact;

Route::get('/', Home::class)->name('home');
Route::get('/profil', Profile::class)->name('profil');
Route::get('/pengalaman', Experience::class)->name('pengalaman');
Route::get('/proyek', ProjectIndex::class)->name('proyek');
Route::get('/proyek/{slug}', ProjectShow::class)->name('proyek.show');
Route::get('/hubungi', Contact::class)->name('hubungi');
