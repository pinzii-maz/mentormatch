<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from 'vue';

const showProfileModal = ref(false);
const showScheduleModal = ref(false);

const profile = ref({
    name: 'John Doe',
    email: 'john@example.com',
    phone: '+1234567890',
    expertise: ['Web Development', 'Mobile Development'],
    education: [
        {
            degree: 'Master in Computer Science',
            institution: 'University of Technology',
            year: '2018-2020'
        },
        {
            degree: 'Bachelor in Computer Science',
            institution: 'State University',
            year: '2014-2018'
        }
    ],
    experience: [
        {
            position: 'Senior Developer',
            company: 'Tech Corp',
            period: '2020-Present'
        },
        {
            position: 'Developer',
            company: 'StartUp Inc',
            period: '2018-2020'
        }
    ]
});

const schedule = ref([
    {
        id: 1,
        day: 'Monday',
        startTime: '10:00',
        endTime: '12:00',
        mentee: 'Alice Smith',
        topic: 'Web Development Basics'
    },
    {
        id: 2,
        day: 'Wednesday',
        startTime: '14:00',
        endTime: '16:00',
        mentee: 'Bob Johnson',
        topic: 'Mobile App Development'
    }
]);

const availableExpertises = [
    'Web Development',
    'Mobile Development',
    'Data Science',
    'UI/UX Design',
    'Digital Marketing',
    'Business Strategy',
    'Career Development'
];

const newEducation = ref({
    degree: '',
    institution: '',
    year: ''
});

const newExperience = ref({
    position: '',
    company: '',
    period: ''
});

const newSchedule = ref({
    day: '',
    startTime: '',
    endTime: ''
});

const addEducation = () => {
    profile.value.education.push({ ...newEducation.value });
    newEducation.value = { degree: '', institution: '', year: '' };
};

const addExperience = () => {
    profile.value.experience.push({ ...newExperience.value });
    newExperience.value = { position: '', company: '', period: '' };
};

const addSchedule = () => {
    schedule.value.push({
        id: schedule.value.length + 1,
        ...newSchedule.value,
        mentee: 'Belum ada mentee',
        topic: 'Belum ada topik'
    });
    newSchedule.value = { day: '', startTime: '', endTime: '' };
    showScheduleModal.value = false;
};
</script>

<template>
    <Head title="Dashboard Mentor" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Dashboard Mentor
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Profile Section -->
                <div class="mb-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Profil</h3>
                            <button @click="showProfileModal = true" 
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Edit Profil
                            </button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-gray-100 mb-2">Informasi Pribadi</h4>
                                <p class="text-gray-600 dark:text-gray-400">{{ profile.name }}</p>
                                <p class="text-gray-600 dark:text-gray-400">{{ profile.email }}</p>
                                <p class="text-gray-600 dark:text-gray-400">{{ profile.phone }}</p>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-gray-100 mb-2">Bidang Keahlian</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span v-for="exp in profile.expertise" :key="exp"
                                        class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-100 rounded-full text-sm">
                                        {{ exp }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Schedule Section -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Jadwal Monitoring</h3>
                            <button @click="showScheduleModal = true"
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                Tambah Jadwal
                            </button>
                        </div>
                        <div class="space-y-4">
                            <div v-for="session in schedule" :key="session.id"
                                class="border dark:border-gray-700 rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ session.day }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ session.startTime }} - {{ session.endTime }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Mentee: {{ session.mentee }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ session.topic }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Modal -->
        <div v-if="showProfileModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-2xl">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Edit Profil</h3>
                
                <!-- Expertise -->
                <div class="mb-4">
                    <h4 class="font-medium mb-2 text-gray-900 dark:text-gray-100">Bidang Keahlian</h4>
                    <div class="flex flex-wrap gap-2">
                        <label v-for="exp in availableExpertises" :key="exp" class="inline-flex items-center">
                            <input type="checkbox" v-model="profile.expertise" :value="exp"
                                class="rounded border-gray-300 dark:border-gray-700">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">{{ exp }}</span>
                        </label>
                    </div>
                </div>

                <!-- Education -->
                <div class="mb-4">
                    <h4 class="font-medium mb-2 text-gray-900 dark:text-gray-100">Riwayat Pendidikan</h4>
                    <div class="space-y-4">
                        <div v-for="(edu, index) in profile.education" :key="index"
                            class="border dark:border-gray-700 rounded p-3">
                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ edu.degree }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ edu.institution }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ edu.year }}</p>
                        </div>
                        <div class="border dark:border-gray-700 rounded p-3">
                            <input v-model="newEducation.degree" placeholder="Gelar"
                                class="w-full mb-2 rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                            <input v-model="newEducation.institution" placeholder="Institusi"
                                class="w-full mb-2 rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                            <input v-model="newEducation.year" placeholder="Tahun"
                                class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                            <button @click="addEducation"
                                class="mt-2 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Tambah Pendidikan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Experience -->
                <div class="mb-4">
                    <h4 class="font-medium mb-2 text-gray-900 dark:text-gray-100">Pengalaman Kerja</h4>
                    <div class="space-y-4">
                        <div v-for="(exp, index) in profile.experience" :key="index"
                            class="border dark:border-gray-700 rounded p-3">
                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ exp.position }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ exp.company }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ exp.period }}</p>
                        </div>
                        <div class="border dark:border-gray-700 rounded p-3">
                            <input v-model="newExperience.position" placeholder="Jabatan"
                                class="w-full mb-2 rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                            <input v-model="newExperience.company" placeholder="Perusahaan"
                                class="w-full mb-2 rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                            <input v-model="newExperience.period" placeholder="Periode"
                                class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                            <button @click="addExperience"
                                class="mt-2 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Tambah Pengalaman
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    <button @click="showProfileModal = false"
                        class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        Batal
                    </button>
                    <button @click="showProfileModal = false"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>

        <!-- Schedule Modal -->
        <div v-if="showScheduleModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Tambah Jadwal</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hari</label>
                        <select v-model="newSchedule.day" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                            <option value="">Pilih hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Waktu Mulai</label>
                        <input type="time" v-model="newSchedule.startTime" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Waktu Selesai</label>
                        <input type="time" v-model="newSchedule.endTime" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button @click="showScheduleModal = false"
                        class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        Batal
                    </button>
                    <button @click="addSchedule"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Tambah Jadwal
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
