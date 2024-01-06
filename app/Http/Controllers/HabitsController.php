<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\HabitLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HabitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $habits = Habit::orderBy('created_at', 'desc')->get();

        $currentDate = Carbon::now()->toDateString();

        foreach ($habits as $habit) {
            $habitLog = HabitLog::where('habit_id', $habit->id)->whereDate('created_at', $currentDate)->get();
            if ($habitLog->count() > 0) {
                $habit->log = $habitLog;
            } else {
                $habit->log = [];
            }
        }

        return Inertia::render('Habits/Index', [
            'habits' => $habits
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Habits/CreateHabit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $habit = new Habit;
        $habit->name = $request->name;
        $habit->user_id = auth()->id();
        $habit->save();

        $habitLog = new HabitLog;
        $habitLog->habit_id = $habit->id;
        $habitLog->save();

        return redirect()->route('habits.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
