<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobLevelRequest;
use App\Models\JobLevel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JobLevelsController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('job-levels.list', [
            'items' => JobLevel::all(),
        ]);
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('job-levels.create', [
            'item' => null,
        ]);
    }

    public function edit(JobLevel $jobLevel): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('job-levels.update', [
            'item' => $jobLevel,
        ]);
    }

    public function store(JobLevelRequest $request): RedirectResponse
    {
        $this->handleSave($request);

        return redirect()->back()->with('success', true);
    }

    public function update(JobLevelRequest $request, JobLevel $jobLevel): RedirectResponse
    {
        $this->handleSave($request, $jobLevel);

        return redirect()->back()->with('success', true);
    }

    public function destroy(JobLevel $jobLevel): RedirectResponse
    {
        $jobLevel->delete();

        return redirect()->back();
    }

    public function order(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('job-levels.order', [
            'levels' => JobLevel::query()->orderBy('order')->get(),
        ]);
    }

    public function orderPost(Request $request): RedirectResponse
    {
        foreach ($request->post('order') as $order => $id) {
            /** @var JobLevel $level */
            $level = JobLevel::query()->findOrFail($id);
            $level->order = $order;
            $level->save();
        }

        return redirect()->back();
    }

    private function handleSave(JobLevelRequest $request, JobLevel $jobLevel = null): void
    {
        $request = [
            'name' => $request->validated('name'),
            'keywords' => explode(',', $request->validated('keywords')),
        ];

        if (null !== $jobLevel) {
            $jobLevel->update($request);
        } else {
            JobLevel::query()->create($request);
        }
    }
}
