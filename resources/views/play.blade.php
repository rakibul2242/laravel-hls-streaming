<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Play Video - {{ $name }}</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet" />
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex flex-col items-center p-6 font-sans">

  <div class="w-full max-w-5xl bg-slate-800 rounded-lg shadow-lg p-6 space-y-6">

    <a href="{{ route('video.uploadForm') }}"
       class="inline-block mb-4 text-emerald-400 hover:text-emerald-600 font-semibold transition">
      &larr; Back to Upload
    </a>

    <h1 class="text-2xl font-semibold text-emerald-400 mb-6 text-center md:text-left">Playing: {{ $name }}</h1>

    <div class="flex flex-col md:flex-row gap-8">

      <div class="flex-1 aspect-video rounded-md overflow-hidden ring-2 ring-emerald-500 shadow-md">
        <video
          id="video-player"
          class="video-js vjs-theme-forest w-full h-full"
          controls
          preload="auto"
          data-setup="{}"
        >
          <source src="{{ asset("storage/hls/{$name}/playlist.m3u8") }}" type="application/x-mpegURL" />
          <p class="vjs-no-js p-4 text-slate-100 bg-slate-900 rounded">Please enable JavaScript to view the video.</p>
        </video>
      </div>
      @if(!empty($videos) && count($videos) > 0)
      <section class="w-full md:w-64 bg-slate-700 rounded-md p-4 max-h-[360px] overflow-y-auto shadow-inner">
        <h2 class="text-lg font-semibold mb-3 text-emerald-300">Available Videos</h2>
        <ul class="space-y-2">
          @foreach($videos as $video)
          <li>
            <a href="{{ route('video.play', ['name' => $video]) }}"
               class="block px-3 py-2 rounded hover:bg-emerald-600 transition
               {{ $video === $name ? 'bg-emerald-600 font-bold text-slate-100' : 'text-emerald-200' }}">
              {{ $video }}
            </a>
          </li>
          @endforeach
        </ul>
      </section>
      @endif

    </div>

  </div>

  <script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>

</body>

</html>
