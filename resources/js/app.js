import './bootstrap';
import AOS from 'aos';
import 'aos/dist/aos.css';

// Inisialisasi AOS setelah Livewire navigate selesai
document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
        duration: 700,
        easing: 'ease-out-quart',
        once: true,
        offset: 60,
    });
});

// Re-init AOS setelah Livewire navigate (wire:navigate)
document.addEventListener('livewire:navigated', () => {
    AOS.refreshHard();
});
