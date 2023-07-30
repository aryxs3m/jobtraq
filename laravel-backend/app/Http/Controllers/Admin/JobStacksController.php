<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPosition;
use App\Models\JobStack;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JobStacksController extends Controller
{
    public function index()
    {
        return view('job-stacks.list', [
            'items' => JobStack::query()->with('jobPosition')->get(),
        ]);
    }

    public function create()
    {
        return view('job-stacks.form', [
            'item' => null,
            'positions' => JobPosition::all(),
        ]);
    }

    public function update(JobStack $jobStack)
    {
        return view('job-stacks.form', [
            'item' => $jobStack,
            'positions' => JobPosition::all(),
        ]);
    }

    public function upsertPost(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|required',
            'keywords' => 'string|required',
            'job_position' => 'nullable|integer|exists:job_positions,id',
        ]);

        $data = [
            'name' => $validated['name'],
            'keywords' => explode(',', $validated['keywords']),
            'job_position_id' => $validated['job_position'],
        ];

        if ($request->has('id')) {
            $jobStack = JobStack::query()->findOrFail($request->input('id'));
            $jobStack->update($data);
        } else {
            JobStack::create($data);
        }

        return redirect()->back()->with('success', true);
    }

    public function delete(JobStack $jobStack): RedirectResponse
    {
        $jobStack->delete();

        return redirect()->back();
    }
}
