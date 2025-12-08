<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LeaveRequest;
use App\Models\Leave;


class LeaveController extends Controller
{
     public function store(LeaveRequest $request)
    {
        $validated = $request->validated();
        $leave = Leave::create($validated);
        return $leave;
    }

      public function index()
    {
        return Leave::all();
    }

    public function byEmployeeLeave(string $id)
{
    $leave = Leave::where('user_id', $id)
        ->get();

    return $leave;
}

public function pendingLeave()
{
    $leave = Leave::where('statuts', 'pending')
        ->get();


    return $leave;
}


}
