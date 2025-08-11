<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Upload & Manage Videos</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-900 text-slate-100 min-h-screen flex flex-col items-center p-6 font-sans">

  <div class="w-full max-w-5xl bg-slate-800 rounded-lg shadow-lg p-6 space-y-6 flex flex-col md:flex-row gap-10">

    <section class="w-full md:w-3/5 pr-0 md:pr-8">
      <header class="mb-6 text-center md:text-left">
        <h1 class="text-3xl font-extrabold text-emerald-400 tracking-tight drop-shadow-sm">Upload Your Video</h1>
        <p class="mt-1 text-emerald-300 text-sm">Supported formats: MP4, MKV, AVI</p>
      </header>

      <form action="{{ route('video.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        <label for="video-upload" class="block text-sm font-semibold text-emerald-300 mb-1">Choose Video File</label>

        <label
          for="video-upload"
          class="cursor-pointer flex flex-col items-center justify-center border-2 border-dashed border-emerald-600 rounded-md bg-slate-700 hover:border-emerald-400 transition p-10 text-emerald-400 hover:text-emerald-300"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 15a4 4 0 004 4h10a4 4 0 004-4v-3a4 4 0 00-4-4H9l-4 4v3z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7l-4-4m0 0L8 7m4-4v12" />
          </svg>
          <span class="text-base font-semibold">Click to select a file or drag and drop</span>
          <input id="video-upload" name="video" type="file" required accept="video/mp4,video/x-matroska,video/avi" class="sr-only" />
        </label>

        <button type="submit"
          class="w-full rounded-md bg-emerald-600 py-2.5 text-slate-100 text-base font-semibold shadow-lg hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-400 transition">
          Upload & Convert
        </button>
      </form>
    </section>

    <section class="w-full md:w-2/5 bg-slate-700 rounded-md p-4 overflow-hidden md:pl-8">
      <h2 class="text-lg font-semibold mb-3 text-emerald-300 border-b border-emerald-600 pb-2">Available Videos</h2>
      @if(count($videos) > 0)
      <ul class="space-y-2 max-h-[420px] overflow-y-auto">
        @foreach($videos as $video)
        <li>
          <a href="{{ route('video.play', ['name' => $video]) }}"
            class="block rounded-md px-4 py-3 bg-emerald-600 text-slate-100 font-semibold hover:bg-emerald-800 transition text-sm">
            {{ $video }}
          </a>
        </li>
        @endforeach
      </ul>
      @else
      <p class="text-emerald-400 italic text-center md:text-left mt-4 text-sm">No videos uploaded yet.</p>
      @endif
    </section>

  </div>

</body>

</html>
