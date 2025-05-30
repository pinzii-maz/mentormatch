<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';


const features = [
    {
        icon: "🎯",
        title: "Temukan Mentor",
        desc: "Cari mentor sesuai bidang dan pengalaman yang kamu butuhkan.",
    },
    {
        icon: "📅",
        title: "Jadwalkan Sesi",
        desc: "Atur jadwal konsultasi dengan mudah dan fleksibel.",
    },
    {
        icon: "💬",
        title: "Chat & Konsultasi",
        desc: "Diskusi langsung dengan mentor melalui chat atau video call.",
    },
    {
        icon: "⭐",
        title: "Review & Rating",
        desc: "Beri penilaian dan ulasan untuk pengalaman terbaik.",
    },
];

const testimonials = [
    {
        name: "Rina, Mahasiswa",
        text: "MentorMatch sangat membantu aku menemukan mentor yang tepat untuk skripsi! Prosesnya mudah dan mentornya ramah.",
        img: "https://randomuser.me/api/portraits/women/44.jpg",
    },
    {
        name: "Budi, Fresh Graduate",
        text: "Sesi mentoring di MentorMatch bikin aku lebih siap menghadapi dunia kerja. Highly recommended!",
        img: "https://randomuser.me/api/portraits/men/32.jpg",
    },
    {
        name: "Sari, Mentor",
        text: "Saya senang bisa berbagi pengalaman dan membantu mentee berkembang. Platformnya mudah digunakan.",
        img: "https://randomuser.me/api/portraits/women/68.jpg",
    },
];

const testiIdx = ref(0);
function nextTesti() { testiIdx.value = (testiIdx.value + 1) % testimonials.length; }
function prevTesti() { testiIdx.value = (testiIdx.value - 1 + testimonials.length) % testimonials.length; }
</script>

<template>
  <div class="min-h-screen flex flex-col bg-gradient-to-br from-blue-50 via-white to-purple-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <!-- Navbar -->
    <nav class="relative px-6 py-4 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm">
      <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between">
          <!-- Logo and Brand -->
          <div class="flex items-center space-x-3">
            <ApplicationLogo />
            <span class="text-2xl font-bold text-blue-700 dark:text-blue-300 tracking-tight">MentorMatch</span>
          </div>

          <!-- Desktop Menu -->
          <div class="hidden md:flex items-center space-x-4">
            <Link :href="route('login')" class="text-blue-700 dark:text-blue-200 font-semibold hover:underline">Login</Link>
            <ColorSchemeToggle />
          </div>

          <!-- Mobile Menu Button -->
          <button @click="isMenuOpen = !isMenuOpen" class="md:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path v-if="!isMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Mobile Menu -->
        <div v-show="isMenuOpen" class="md:hidden mt-4 py-4 border-t border-gray-200 dark:border-gray-700">
          <div class="flex flex-col gap-4">
            <Link :href="route('login')" class="text-blue-700 dark:text-blue-200 font-semibold hover:underline">Login</Link>
            <div class="flex items-center gap-2">
              <span class="text-gray-600 dark:text-gray-300">Theme:</span>
              <ColorSchemeToggle />
            </div>
          </div>
        </div>
      </div>
    </nav>

        <!-- Hero Section -->
        <section
            class="flex flex-col-reverse md:flex-row items-center justify-between gap-8 px-6 py-12 max-w-7xl mx-auto w-full"
        >
            <div class="flex-1">
                <h1
                    class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-4 leading-tight"
                >
                    Temukan Mentor
                    <span class="text-blue-600">Terbaik</span> untuk Masa
                    Depanmu
                </h1>
                <p
                    class="text-lg text-gray-600 dark:text-gray-300 mb-6 max-w-xl"
                >
                    MentorMatch menghubungkan kamu dengan para mentor
                    profesional di berbagai bidang. Mulai perjalanan belajarmu,
                    konsultasi karir, atau kembangkan skill bersama mentor
                    pilihan!
                </p>
                <div class="flex gap-4 flex-wrap">
                    <Link :href="route('register')">
                        <PrimaryButton
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 text-lg"
                            >Gabung sebagai Mentee</PrimaryButton
                        >
                    </Link>
                    <Link :href="route('register.mentor')">
                        <PrimaryButton
                            class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 text-lg"
                            >Gabung sebagai Mentor</PrimaryButton
                        >
                    </Link>
                </div>
            </div>
            <div class="flex-1 flex justify-center">
                <img
                    src="https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&w=500&q=80"
                    alt="Mentoring"
                    class="rounded-2xl shadow-lg w-full max-w-xs md:max-w-md"
                />
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-12 px-6 max-w-7xl mx-auto w-full">
            <h2
                class="text-2xl md:text-3xl font-bold text-center mb-8 text-gray-800 dark:text-white"
            >
                Fitur Unggulan MentorMatch
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <div
                    v-for="f in features"
                    :key="f.title"
                    class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 flex flex-col items-center text-center hover:scale-105 transition-transform"
                >
                    <div class="text-4xl mb-3">{{ f.icon }}</div>
                    <div
                        class="font-semibold text-lg text-blue-700 dark:text-blue-300 mb-1"
                    >
                        {{ f.title }}
                    </div>
                    <div class="text-gray-500 dark:text-gray-300">
                        {{ f.desc }}
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonial Carousel -->
        <section class="py-12 px-6 max-w-3xl mx-auto w-full">
            <h2
                class="text-2xl md:text-3xl font-bold text-center mb-8 text-gray-800 dark:text-white"
            >
                Apa Kata Mereka?
            </h2>
            <div
                class="relative bg-white dark:bg-gray-800 rounded-xl shadow p-8 flex flex-col items-center"
            >
                <img
                    :src="testimonials[testiIdx].img"
                    :alt="testimonials[testiIdx].name"
                    class="w-20 h-20 rounded-full border-4 border-blue-200 dark:border-blue-700 mb-4"
                />
                <p
                    class="text-lg italic text-gray-700 dark:text-gray-200 mb-2 text-center"
                >
                    "{{ testimonials[testiIdx].text }}"
                </p>
                <div class="font-semibold text-blue-700 dark:text-blue-300">
                    {{ testimonials[testiIdx].name }}
                </div>
                <div class="flex gap-2 mt-4">
                    <button
                        @click="prevTesti"
                        class="rounded-full bg-blue-100 dark:bg-blue-900 p-2 hover:bg-blue-200 dark:hover:bg-blue-700 transition"
                    >
                        <span class="text-xl">‹</span>
                    </button>
                    <button
                        @click="nextTesti"
                        class="rounded-full bg-blue-100 dark:bg-blue-900 p-2 hover:bg-blue-200 dark:hover:bg-blue-700 transition"
                    >
                        <span class="text-xl">›</span>
                    </button>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer
            class="mt-auto py-6 text-center text-gray-500 dark:text-gray-400 bg-transparent"
        >
            MentorMatch &copy; {{ new Date().getFullYear() }} &middot; Temukan
            mentor, kembangkan potensimu!
        </footer>
    </div>
</template>
