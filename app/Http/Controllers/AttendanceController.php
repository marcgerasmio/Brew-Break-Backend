<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use Carbon\Carbon;
class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(AttendanceRequest $request)
    {
        $validated = $request->validated();
        $attendance = Attendance::create($validated);
        return $attendance;
    }

    public function update(AttendanceRequest $request, $id)
{
    // Validate the request
    $validated = $request->validated();

    // Find the existing attendance record
    $attendance = Attendance::findOrFail($id);

    // Update the record with validated data
    $attendance->update($validated);

    // Return the updated record
    return $attendance;
}


    /**
     * Display the specified resource.
     */
     public function todayAttendance(string $date)
{
    $attendance = Attendance::where('date', $date)
        ->with('user:id,name')
        ->get();

    return $attendance;
}

  public function byEmployeeAttendance(string $id)
    {
        $attendance = Attendance::where('user_id', $id)
            ->with('user:id,name')
            ->get();

        return $attendance;
    }

    public function byMonth(string $monthYear)
{
    $date = Carbon::createFromFormat('Y-m', $monthYear);

    $attendance = Attendance::whereYear('date', $date->year)
        ->whereMonth('date', $date->month)
        ->with('user:id,name')
        ->get();

    return $attendance;
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
