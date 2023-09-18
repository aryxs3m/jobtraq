<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\JobPositionsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobPositionRequest;
use App\Models\JobPosition;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class JobPositionsController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(JobPositionsDataTable $dataTable): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|JsonResponse
    {
        $this->authorize('view job-positions');

        return $dataTable->render('job-positions.list');
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('add job-positions');

        return view('job-positions.create', [
            'item' => null,
            'positions' => JobPosition::all(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(JobPosition $jobPosition): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('edit job-positions');

        return view('job-positions.update', [
            'item' => $jobPosition,
            'positions' => JobPosition::all(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(JobPositionRequest $request): RedirectResponse
    {
        $this->authorize('add job-positions');

        $this->handleSave($request);

        return redirect()->back()->with('success', true);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(JobPosition $jobPosition, JobPositionRequest $request)
    {
        $this->authorize('edit job-positions');

        $this->handleSave($request, $jobPosition);

        return redirect()->back()->with('success', true);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(JobPosition $jobPosition): RedirectResponse
    {
        $this->authorize('delete job-positions');

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
