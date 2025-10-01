<?php

namespace App\Http\Controllers;

use App\Http\Requests\BackgroundUploadRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class BackgroundController extends Controller
{
    public function upload(BackgroundUploadRequest $request)
    {
        $destinationPath = public_path('image/bg.webp');

        if (File::exists($destinationPath)) {
            File::delete($destinationPath);
        }

        $request->file('background')->move(public_path('image'), 'bg.webp');

        return back()->with('success', 'Background image updated successfully.');
    }
}
