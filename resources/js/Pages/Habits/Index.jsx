import { Head, Link, router, usePage } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import Habit from "./Habit";
import { addDays, subDays, format } from "date-fns";
import { StrictMode } from "react";

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
            {/* <div className="flex items-center justify-center gap-10 p-4">
                <button
                    className="px-3 py-2 text-white bg-black rounded-md"
                    onClick={() => switchDay(yesterday)}
                >
                    ystrdy
                </button>
                <p>{today}</p>
                <button
                    className="px-3 py-2 text-white bg-black rounded-md"
                    onClick={() => switchDay(tomorrow)}
                >
                    tmrw
                </button>
            </div> */}
            <div className="flex flex-col items-center justify-center gap-4 py-12">
                <Link
                    className="p-4 text-white bg-blue-500 rounded-full"
                    href={route("habits.create")}
                >
                    New habit
                </Link>
                {habits.map((habit) => {
                    return <Habit key={habit.id} habitData={habit} />;
                })}
            </div>
        </AuthenticatedLayout>
    );
}
