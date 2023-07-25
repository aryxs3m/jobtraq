<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobStack;
use Illuminate\Http\Request;

class JobStacksController extends Controller
{
    public function index()
    {
        return view('job-stacks.list', [
            'items' => JobStack::all(),
        ]);
    }

    public function create()
    {
        return view('job-stacks.form', [
            'item' => null,
        ]);
    }

    public function update(JobStack $jobStack)
    {
        return view('job-stacks.form', [
            'item' => $jobStack,
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
            $jobStack = JobStack::query()->findOrFail($request->input('id'));
            $jobStack->update($data);
        } else {
            JobStack::create($data);
        }

        return redirect()->back()->with('success', true);
    }
}
