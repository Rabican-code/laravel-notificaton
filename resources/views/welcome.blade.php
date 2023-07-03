<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
  </head>
  <body>
    <div class="flex-center position-ref full-height">

        @if (Route::has('login') && Auth::check())
            <div class="top-right links">
                <a href="{{ url('/dashboard') }}">Dashboard</a>
            </div>
        @elseif (Route::has('login') && !Auth::check())
            <div class="top-right links">
                <a href="{{ url('/login') }}">Login</a>
                <a href="{{ url('/register') }}">Register</a>
            </div>
        @endif

    </div>
    <input type="text" id="siteId" name="siteId" placeholder="Website Id"/>
    <button onclick="subscribe()">Subscribe</button>

    <script>
      async function subscribe() {
        let sw = await navigator.serviceWorker.ready;
        let push = await sw.pushManager.subscribe({
          userVisibleOnly: true,
          applicationServerKey:
            'BBZY7Q3KEtZArAAWMLi_qzWHbH4vAoqPpIXnRhmlUaw0PVs1Kt_2fgLhuaVI5i8MWASBKx3d6W6UoH2U3qChw9U'
        });
        console.log(JSON.stringify(push));
        var token = JSON.stringify(push)
        var siteId = $('#siteId').val();
        $.post("save",{siteId:siteId,token:token,_token: '{{csrf_token()}}'});
      }

      if ('serviceWorker' in navigator) {
        addEventListener('load', async () => {
          let sw = await navigator.serviceWorker.register('./sw.js');
          console.log(sw);
        });
      }
    </script>
     <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
  </body>
</html>
