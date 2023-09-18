<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\JobStacksDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobStackRequest;
use App\Models\JobPosition;
use App\Models\JobStack;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class JobStacksController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(JobStacksDataTable $dataTable): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|JsonResponse
    {
        $this->authorize('view job-stacks');

        return $dataTable->render('job-stacks.list');
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('add job-stacks');

        return view('job-stacks.create', [
            'item' => null,
            'positions' => JobPosition::all(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(JobStack $jobStack): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('edit job-stacks');

        return view('job-stacks.update', [
            'item' => $jobStack,
            'positions' => JobPosition::all(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(JobStackRequest $request): RedirectResponse
    {
        $this->authorize('add job-stacks');

        $this->handleSave($request);

        return redirect()->back()->with('success', true);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(JobStack $jobStack, JobStackRequest $request): RedirectResponse
    {
        $this->authorize('edit job-stacks');

        $this->handleSave($request, $jobStack);

        return redirect()->back()->with('success', true);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(JobStack $jobStack): RedirectResponse
    {
        $this->authorize('delete job-stacks');

        $jobStack->delete();

        return redirect()->back();
    }

    private function handleSave(JobStackRequest $request, JobStack $jobStack = null): void
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
