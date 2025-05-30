<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    name: '',
    phone: '',
    email: '',
    password: '',
    gender: '',
    education: '',
    job: '',
    expertise: '',
    reason: '',
    file: null,
});

const fileName = ref('');
function handleFile(e) {
    const file = e.target.files[0];
    form.file = file;
    fileName.value = file ? file.name : '';
}

const submit = () => {
    form.post(route('register.mentor'), {
        onFinish: () => form.reset('password', 'file'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Daftar Mentor" />
        <div class="max-w-full w-full mx-auto mt-6 mb-8 bg-white dark:bg-gray-900 rounded-2xl shadow-xl p-8 md:p-16 border border-blue-100 dark:border-blue-900">
            <div class="mb-8 text-center">
                <div class="flex justify-center mb-2">
                    <span class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 text-3xl shadow"><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor' class='w-10 h-10'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 14l9-5-9-5-9 5 9 5zm0 7v-7m0 0L3 9m9 5l9-5'/></svg></span>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-blue-700 dark:text-blue-300 mb-1">Daftar Sebagai Mentor</h1>
                <p class="text-gray-500 dark:text-gray-300 text-sm md:text-base">Bergabunglah dan bantu mentee berkembang dengan pengalaman dan keahlian Anda!</p>
            </div>
            <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-5">
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <InputLabel for="name" value="Nama Lengkap" />
                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div>
                        <InputLabel for="phone" value="No HP" />
                        <TextInput id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required autocomplete="tel" />
                        <InputError class="mt-2" :message="form.errors.phone" />
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <InputLabel for="email" value="Email" />
                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div>
                        <InputLabel for="password" value="Password" />
                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <InputLabel for="gender" value="Jenis Kelamin" />
                        <select id="gender" v-model="form.gender" required class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-400">
                            <option value="" disabled>Pilih jenis kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.gender" />
                    </div>
                    <div>
                        <InputLabel for="education" value="Pendidikan Terakhir" />
                        <select id="education" v-model="form.education" required class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-400">
                            <option value="" disabled>Pilih Pendidikan Terakhir</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA_SMK">SMA/SMK</option>
                            <option value="PerguruanTinggi">Perguruan Tinggi</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.education" />
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <InputLabel for="job" value="Pekerjaan Saat Ini" />
                        <TextInput id="job" type="text" class="mt-1 block w-full" v-model="form.job" required />
                        <InputError class="mt-2" :message="form.errors.job" />
                    </div>
                    <div>
                        <InputLabel for="expertise" value="Bidang Keahlian" />
                        <TextInput id="expertise" type="text" class="mt-1 block w-full" v-model="form.expertise" required />
                        <InputError class="mt-2" :message="form.errors.expertise" />
                    </div>
                </div>
                <div>
                    <InputLabel for="reason" value="Alasan Anda Ingin Menjadi Mentor" />
                    <textarea id="reason" v-model="form.reason" required class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-400" rows="3"></textarea>
                    <InputError class="mt-2" :message="form.errors.reason" />
                </div>
                <div>
                    <InputLabel for="file" value="Upload File Pendukung (Opsional)" />
                    <label for="file" class="cursor-pointer flex items-center px-4 py-2 mt-1 block w-1/2 text-sm font-semibold text-blue-700 bg-blue-50 rounded-full border border-blue-100 hover:bg-blue-100 dark:bg-blue-900 dark:text-blue-200 dark:border-blue-800 dark:hover:bg-blue-800 transition">
                        <input id="file" type="file" class="hidden" @change="handleFile" />
                        <span>{{ fileName || 'Upload File' }}</span>
                    </label>
                    <InputError class="mt-2" :message="form.errors.file" />
                </div>
                <div class="flex items-center justify-between mt-6">
                    <Link :href="route('login')" class="rounded-md text-sm text-gray-600 underline hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-blue-200 dark:focus:ring-offset-gray-900">
                        Sudah punya akun?
                    </Link>
                    <PrimaryButton class="ms-4 bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 text-base rounded-lg shadow" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </GuestLayout>
</template> 