import { Head, Link } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

export default function Index({ auth, habits }) {
    return (
        <AuthenticatedLayout
            user={auth}
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Habits
                </h2>
            }
        >
            <Head title="Habits" />
            <div className="flex flex-col items-center justify-center gap-4 py-12">
                <Link
                    className="p-4 text-white bg-blue-500 rounded-full"
                    href={route("habits.create")}
                >
                    New habit
                </Link>
                {habits.map((habit) => {
                    return (
                        <div className="flex justify-center">
                            <p>{habit.name}</p>
                        </div>
                    );
                })}
            </div>
        </AuthenticatedLayout>
    );
}
