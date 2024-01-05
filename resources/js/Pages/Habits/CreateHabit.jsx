import { Head, useForm } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

export default function CreateHabit({ auth }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: "",
    });

    const submit = (e) => {
        e.preventDefault();
        post(route("habits.store"));
    };

    return (
        <AuthenticatedLayout
            user={auth}
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Habits
                </h2>
            }
        >
            <Head title="Create Habit" />
            <div className="flex items-center justify-center">
                <form onSubmit={submit}>
                    <div className="mt-4">
                        <label htmlFor="name">Habit Name</label>
                        <input
                            id="name"
                            type="text"
                            className="block w-full mt-1"
                            value={data.name}
                            onChange={(e) => setData("name", e.target.value)}
                        />
                        {errors.name && (
                            <p className="mt-1 text-xs text-red-500">
                                {errors.name}
                            </p>
                        )}
                    </div>

                    <div className="flex items-center justify-end mt-4">
                        <button
                            type="submit"
                            className="ms-4"
                            disabled={processing}
                        >
                            Confirm
                        </button>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
