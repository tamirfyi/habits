import React, { useState } from "react";
import { router, useForm } from "@inertiajs/react";
import { clsx } from "clsx";

const Habit = ({ habitData }) => {
    const { name, log } = habitData;
    const [confirmed, setConfirmed] = useState(log[0].is_confirmed);

    const toggle = () => {
        const newConfirmed = !confirmed;
        setConfirmed(newConfirmed);
        router.patch(
            route("habit-logs.update", {
                id: log[0].id,
                habit_id: habitData.id,
                is_confirmed: newConfirmed,
            })
        );
    };

    return (
        <button
            onClick={toggle}
            className={clsx(
                "flex flex-col justify-center gap-6 p-4 text-center transition rounded-md hover:cursor-default ease active:origin-center active:scale-90",
                {
                    "bg-green-600 text-white": confirmed,
                    "bg-white text-black": !confirmed,
                }
            )}
        >
            <p className="text-lg font-bold">{name}</p>
        </button>
    );
};

export default Habit;
