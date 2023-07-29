<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobLevel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JobLevelsController extends Controller
{
    public function index()
    {
        return view('job-levels.list', [
            'items' => JobLevel::all(),
        ]);
    }

    public function create()
    {
        return view('job-levels.form', [
            'item' => null,
        ]);
    }

    public function update(JobLevel $jobLevel)
    {
        return view('job-levels.form', [
            'item' => $jobLevel,
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
            $jobLevel = JobLevel::query()->findOrFail($request->input('id'));
            $jobLevel->update($data);
        } else {
            JobLevel::create($data);
        }

        return redirect()->back()->with('success', true);
    }

    public function delete(JobLevel $jobLevel): RedirectResponse
    {
        $jobLevel->delete();

        return redirect()->back();
    }

    public function order(Request $request)
    {
        return view('job-levels.order', [
            'levels' => JobLevel::query()->orderBy('order')->get(),
        ]);
    }

    public function orderPost(Request $request)
    {
        foreach ($request->post('order') as $order => $id) {
            $level = JobLevel::query()->findOrFail($id);
            $level->order = $order;
            $level->save();
        }

        return redirect()->back();
    }
}
