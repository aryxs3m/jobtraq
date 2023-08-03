<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobStackRequest;
use App\Models\JobPosition;
use App\Models\JobStack;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JobStacksController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('job-stacks.list', [
            'items' => JobStack::query()->with('jobPosition')->get(),
        ]);
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('job-stacks.create', [
            'item' => null,
            'positions' => JobPosition::all(),
        ]);
    }

    public function edit(JobStack $jobStack): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('job-stacks.update', [
            'item' => $jobStack,
            'positions' => JobPosition::all(),
        ]);
    }

    public function store(JobStackRequest $request): RedirectResponse
    {
        $this->handleSave($request);

        return redirect()->back()->with('success', true);
    }

    public function update(JobStack $jobStack, JobStackRequest $request): RedirectResponse
    {
        $this->handleSave($request, $jobStack);

        return redirect()->back()->with('success', true);
    }

    public function destroy(JobStack $jobStack): RedirectResponse
    {
        $jobStack->delete();

        return redirect()->back();
    }

    private function handleSave(JobStackRequest $request, ?JobStack $jobStack = null): void
    {
        $data = [
            'name' => $request->validated('name'),
            'keywords' => explode(',', $request->validated('keywords')),
            'job_position_id' => $request->validated('job_position'),
        ];

        if (null !== $jobStack) {
            $jobStack->update($data);
        } else {
            JobStack::query()->create($data);
        }
    }
}
