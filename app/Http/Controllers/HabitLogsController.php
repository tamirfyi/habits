<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HabitLog;

class HabitLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $habitLogs = HabitLog::all();
        return $habitLogs;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show a form to create a new habit log entry
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and store the new habit log entry
        $validatedData = $request->validate([
            'habit_id' => 'required|exists:habits,id',
            'log_date' => 'required|date',
            'is_confirmed' => 'required|boolean',
        ]);

        HabitLog::create($validatedData);

        return redirect()->route('habits.index')->with('success', 'Habit log entry created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve and display a specific habit log entry
        $habitLog = HabitLog::findOrFail($id);
        return $habitLog;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'habit_id' => 'required|exists:habits,id',
            'is_confirmed' => 'required|boolean',
        ]);

        $habitLog = HabitLog::where("habit_id", $request->habit_id)->first();
        if ($habitLog) {
            $habitLog->update($validatedData);
            return redirect()->route('habits.index')->with('success', 'Habit log entry updated successfully');
        } else {
            return redirect()->route('habits.index')->with('error', 'Habit log entry not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $habitLog = HabitLog::findOrFail($id);
        $habitLog->delete();

        return redirect()->route('habits.index')->with('success', 'Habit log entry deleted successfully');
    }
}
