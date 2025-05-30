<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, computed } from 'vue';

const selectedExpertise = ref('');
const searchQuery = ref('');

const expertises = [
    'Web Development',
    'Mobile Development',
    'Data Science',
    'UI/UX Design',
    'Digital Marketing',
    'Business Strategy',
    'Career Development'
];

const mentors = ref([
    {
        id: 1,
        name: 'John Doe',
        expertise: 'Web Development',
        rating: 4.8,
        education: 'Master in Computer Science',
        experience: '5 years as Senior Developer',
        email: 'john@example.com',
        schedule: [
            { day: 'Monday', time: '10:00 - 12:00' },
            { day: 'Wednesday', time: '14:00 - 16:00' }
        ]
    },
    {
        id: 2,
        name: 'Jane Smith',
        expertise: 'UI/UX Design',
        rating: 4.9,
        education: 'Bachelor in Design',
        experience: '3 years as UI/UX Designer',
        email: 'jane@example.com',
        schedule: [
            { day: 'Tuesday', time: '13:00 - 15:00' },
            { day: 'Thursday', time: '15:00 - 17:00' }
        ]
    }
]);

const upcomingSessions = ref([
    {
        id: 1,
        mentorName: 'John Doe',
        date: '2024-03-20',
        time: '10:00 - 12:00',
        topic: 'Web Development Basics'
    },
    {
        id: 2,
        mentorName: 'Jane Smith',
        date: '2024-03-21',
        time: '13:00 - 15:00',
        topic: 'UI Design Principles'
    }
]);

const filteredMentors = computed(() => {
    return mentors.value.filter(mentor => {
        const matchesExpertise = !selectedExpertise.value || mentor.expertise === selectedExpertise.value;
        const matchesSearch = !searchQuery.value || 
            mentor.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            mentor.expertise.toLowerCase().includes(searchQuery.value.toLowerCase());
        return matchesExpertise && matchesSearch;
    });
});

const showMentorProfile = ref(false);
const selectedMentor = ref(null);

const viewMentorProfile = (mentor) => {
    selectedMentor.value = mentor;
    showMentorProfile.value = true;
};

const sendEmail = (email) => {
    window.location.href = `mailto:${email}`;
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Mentee Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Search and Filter Section -->
                <div class="mb-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <input
                                v-model="searchQuery"
                                type="text"
                                placeholder="Cari mentor..."
                                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            />
                        </div>
                        <div class="w-full md:w-64">
                            <select
                                v-model="selectedExpertise"
                                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            >
                                <option value="">Semua Bidang Keahlian</option>
                                <option v-for="expertise in expertises" :key="expertise" :value="expertise">
                                    {{ expertise }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Sessions -->
                <div class="mb-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Jadwal Monitoring</h3>
                        <div class="space-y-4">
                            <div v-for="session in upcomingSessions" :key="session.id" 
                                class="border dark:border-gray-700 rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ session.mentorName }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ session.topic }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ session.date }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ session.time }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mentor List -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Daftar Mentor</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div v-for="mentor in filteredMentors" :key="mentor.id" 
                                class="border dark:border-gray-700 rounded-lg p-4">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ mentor.name }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ mentor.expertise }}</p>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-yellow-400">★</span>
                                        <span class="ml-1 text-sm text-gray-600 dark:text-gray-400">{{ mentor.rating }}</span>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ mentor.education }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ mentor.experience }}</p>
                                </div>
                                <div class="mt-4 flex gap-2">
                                    <button @click="viewMentorProfile(mentor)"
                                        class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                                        Lihat Profil
                                    </button>
                                    <button @click="sendEmail(mentor.email)"
                                        class="px-3 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700">
                                        Email
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mentor Profile Modal -->
        <div v-if="showMentorProfile && selectedMentor" 
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-2xl">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        Profil Mentor
                    </h3>
                    <button @click="showMentorProfile = false"
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ selectedMentor.name }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ selectedMentor.expertise }}</p>
                    </div>
                    
                    <div>
                        <h4 class="font-medium text-gray-900 dark:text-gray-100 mb-2">Pendidikan</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ selectedMentor.education }}</p>
                    </div>
                    
                    <div>
                        <h4 class="font-medium text-gray-900 dark:text-gray-100 mb-2">Pengalaman</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ selectedMentor.experience }}</p>
                    </div>
                    
                    <div>
                        <h4 class="font-medium text-gray-900 dark:text-gray-100 mb-2">Jadwal Tersedia</h4>
                        <div class="space-y-2">
                            <div v-for="(schedule, index) in selectedMentor.schedule" :key="index"
                                class="text-sm text-gray-600 dark:text-gray-400">
                                {{ schedule.day }}: {{ schedule.time }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
