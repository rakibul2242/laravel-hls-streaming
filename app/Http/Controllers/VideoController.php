<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{

    public function uploadForm()
    {
        $folders = Storage::disk('public')->directories('hls');
        $videos = array_map(fn($folder) => basename($folder), $folders);

        return view('upload', ['videos' => $videos]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimetypes:video/mp4,video/x-matroska,video/avi',
        ]);

        // Store original video on local disk
        $originalPath = $request->file('video')->store('videos');

        $videoName = pathinfo($request->file('video')->getClientOriginalName(), PATHINFO_FILENAME);
        $hlsFolder = "hls/{$videoName}";

        // Convert to HLS format using laravel-ffmpeg
        FFMpeg::fromDisk('local')
            ->open($originalPath)
            ->exportForHLS()
            ->addFormat((new X264)->setKiloBitrate(800))
            ->toDisk('public')
            ->save("{$hlsFolder}/playlist.m3u8");

        return redirect()->route('video.play', ['name' => $videoName]);
    }

    public function play($name)
    {
        $videoFolders = Storage::disk('public')->directories('hls');
        $videos = array_map(fn($folder) => basename($folder), $videoFolders);

        return view('play', compact('name', 'videos'));
    }
}
