<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImageRequest;
use App\Models\Image;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('images.list', [
            'images' => Image::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageRequest $request): RedirectResponse
    {
        $image = new Image();
        $image->path = $request->file('image')->store('public');
        $image->filename = $request->file('image')->getClientOriginalName();
        $image->size = $request->file('image')->getSize();
        $image->mime = $request->file('image')->getMimeType();
        $image->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image): RedirectResponse
    {
        Storage::delete($image->path);
        $image->delete();

        return redirect()->back();
    }
}