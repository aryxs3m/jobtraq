<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPosition;
use Illuminate\Http\Request;

class JobPositionsController extends Controller
{
    public function index()
    {
        return view('job-positions.list', [
            'items' => JobPosition::all(),
        ]);
    }

    public function create()
    {
        return view('job-positions.form', [
            'item' => null,
        ]);
    }

    public function update(JobPosition $jobPosition)
    {
        return view('job-positions.form', [
            'item' => $jobPosition,
        ]);
    }

    public function upsertPost(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|required',
            'keywords' => 'string|required',
        ]);

        $data = [
            'name' => $validated['name'],
            'keywords' => explode(',', $validated['keywords']),
        ];

        if ($request->has('id')) {
            $jobPosition = JobPosition::query()->findOrFail($request->input('id'));
            $jobPosition->update($data);
        } else {
            JobPosition::create($data);
        }

        return redirect()->back()->with('success', true);
    }
}
