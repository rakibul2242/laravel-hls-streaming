<!DOCTYPE html>
<html>
<head>
  <title>HLS Streaming</title>
  <link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet" />
</head>
<body>
  <h1>Manual HLS Streaming</h1>
  <video id="my-video" class="video-js" controls preload="auto" width="640" height="360" data-setup="{}">
    <source src="{{ route('video.stream', 'playlist.m3u8') }}" type="application/x-mpegURL" />
  </video>
  <script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>
</body>
</html>
