<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(?Doctor $doctor = null)
    {
        if ($doctor && $doctor->exists) {
            $schedules = $doctor->schedules()->orderBy('day_of_week')->get();
        } else {
            $schedules = Schedule::with('doctor.user')->orderBy('day_of_week')->paginate(20);
        }
        $doctors = Doctor::with('user')->where('is_available', true)->get();
        return view('admin.schedules.index', compact('doctor', 'schedules', 'doctors'));
    }

    public function store(Request $request)
    {
        $dayMap = [
            'monday' => 1, 'tuesday' => 2, 'wednesday' => 3,
            'thursday' => 4, 'friday' => 5, 'saturday' => 6, 'sunday' => 0,
        ];

        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'day_of_week' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        $dayValue = is_numeric($request->day_of_week)
            ? (int) $request->day_of_week
            : ($dayMap[$request->day_of_week] ?? null);

        if ($dayValue === null) {
            return redirect()->back()->with('error', 'Hari tidak valid.');
        }

        Schedule::create([
            'doctor_id' => $request->doctor_id,
            'day_of_week' => $dayValue,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_available' => true,
        ]);

        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
