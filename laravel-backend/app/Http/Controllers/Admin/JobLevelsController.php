<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\JobLevelsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobLevelRequest;
use App\Models\JobLevel;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JobLevelsController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(JobLevelsDataTable $dataTable): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|JsonResponse
    {
        $this->authorize('view job-levels');

        return $dataTable->render('job-levels.list');
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('add job-levels');

        return view('job-levels.create', [
            'item' => null,
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(JobLevel $jobLevel): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('edit job-levels');

        return view('job-levels.update', [
            'item' => $jobLevel,
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(JobLevelRequest $request): RedirectResponse
    {
        $this->authorize('add job-levels');

        $this->handleSave($request);

        return redirect()->back()->with('success', true);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(JobLevelRequest $request, JobLevel $jobLevel): RedirectResponse
    {
        $this->authorize('edit job-levels');

        $this->handleSave($request, $jobLevel);

        return redirect()->back()->with('success', true);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(JobLevel $jobLevel): RedirectResponse
    {
        $this->authorize('delete job-levels');

        $jobLevel->delete();

        return redirect()->back();
    }

    /**
     * @throws AuthorizationException
     */
    public function order(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('order job-levels');

        return view('job-levels.order', [
            'levels' => JobLevel::query()->orderBy('order')->get(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function orderPost(Request $request): RedirectResponse
    {
        $this->authorize('order job-levels');

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
