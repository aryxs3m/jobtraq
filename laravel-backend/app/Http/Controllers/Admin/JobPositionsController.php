<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobPositionRequest;
use App\Models\JobPosition;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class JobPositionsController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('job-positions.list', [
            'items' => JobPosition::all(),
        ]);
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('job-positions.create', [
            'item' => null,
            'positions' => JobPosition::all(),
        ]);
    }

    public function edit(JobPosition $jobPosition): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('job-positions.update', [
            'item' => $jobPosition,
            'positions' => JobPosition::all(),
        ]);
    }

    public function store(JobPositionRequest $request): RedirectResponse
    {
        $this->handleSave($request);

        return redirect()->back()->with('success', true);
    }

    public function update(JobPosition $jobPosition, JobPositionRequest $request)
    {
        $this->handleSave($request, $jobPosition);

        return redirect()->back()->with('success', true);
    }

    public function destroy(JobPosition $jobPosition): RedirectResponse
    {
        $jobPosition->delete();

        return redirect()->back();
    }

    private function handleSave(JobPositionRequest $request, JobPosition $jobPosition = null): void
    {
        $request = [
            'name' => $request->validated('name'),
            'job_position_id' => $request->validated('job_position_id'),
            'hidden_in_statistics' => $request->validated('hidden_in_statistics'),
            'keywords' => explode(',', $request->validated('keywords')),
        ];

        if (null !== $jobPosition) {
            $jobPosition->update($request);
        } else {
            JobPosition::query()->create($request);
        }
    }
}
