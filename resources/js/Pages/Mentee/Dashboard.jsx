import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function MenteeDashboard({ auth }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Mentee Dashboard</h2>}
        >
            <Head title="Mentee Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <h3 className="text-lg font-semibold mb-4">Welcome, {auth.user.name}!</h3>
                            <p>This is your mentee dashboard where you can find mentors and manage your learning journey.</p>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
} 