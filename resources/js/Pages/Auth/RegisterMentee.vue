<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    phone: '',
    email: '',
    password: '',
    password_confirmation: '',
    gender: '',
    education: '',
});

const submit = () => {
    form.post(route('register.mentee.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Daftar Mentee" />

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <div class="mb-8 text-center">
                <div class="flex justify-center mb-2">
                    <span class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300 text-3xl shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10 h-10">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </span>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-green-700 dark:text-green-300 mb-1">Daftar Sebagai Mentee</h1>
                <p class="text-gray-500 dark:text-gray-300 text-sm md:text-base">Bergabunglah dan temukan mentor yang tepat untuk mengembangkan potensimu!</p>
            </div>

            <form @submit.prevent="submit" class="space-y-5">
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
                        <InputLabel for="password_confirmation" value="Konfirmasi Password" />
                        <TextInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>
                    <div>
                        <InputLabel for="gender" value="Jenis Kelamin" />
                        <select id="gender" v-model="form.gender" required class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-green-400">
                            <option value="" disabled>Pilih jenis kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.gender" />
                    </div>
                </div>

                <div>
                    <InputLabel for="education" value="Pendidikan Terakhir" />
                    <select id="education" v-model="form.education" required class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-green-400">
                        <option value="" disabled>Pilih Pendidikan Terakhir</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA_SMK">SMA/SMK</option>
                        <option value="PerguruanTinggi">Perguruan Tinggi</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.education" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <Link :href="route('login')" class="rounded-md text-sm text-gray-600 underline hover:text-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-green-200 dark:focus:ring-offset-gray-900">
                        Sudah punya akun?
                    </Link>
                    <PrimaryButton class="ms-4 bg-green-600 hover:bg-green-700 text-white px-8 py-2 text-base rounded-lg shadow" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template> 