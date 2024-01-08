<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HabitLog;
use Carbon\Carbon;

class HabitLogsController extends Controller
{
    /**
     * Checks off a habit, creating a new habit log if it does not already exist
     */
    public function check(Request $request, string $id, string $date = null)
    {
        $validatedData = $request->validate([
            'is_confirmed' => 'required|boolean',
        ]);


        $habitLog = HabitLog::whereDate('created_at', Carbon::now())->firstOrNew([
            'habit_id' => $id,
        ]);

        $habitLog->is_confirmed = $validatedData['is_confirmed'];
        $habitLog->save();

        return redirect()->route('habits.index')->with('success', 'Habit log entry updated successfully');
    }
}
