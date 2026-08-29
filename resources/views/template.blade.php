<!DOCTYPE html>
<html lang="en">

@include('dashboard.includes.head')

<body>

   @include('dashboard.includes.sidebar')

    <!-- MAIN CONTENT -->
    <div class="main-content">

        @yield('main-content')
 
        @include('dashboard.includes.footer')
 
    </div>


<!-- Laravel Echo aur Pusher JS CDN -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.3/dist/echo.iife.js"></script>

{{-- Pusher --}}
<script>
    window.Pusher = Pusher;

    window.Echo = new Echo({
        broadcaster: 'reverb',
        key: '{{ env("REVERB_APP_KEY") }}',
        wsHost: '{{ env("REVERB_HOST") }}',
        wsPort: {{ env("REVERB_PORT") }},
        wssPort: {{ env("REVERB_PORT") }},
        forceTLS: ( '{{ env("REVERB_SCHEME") }}' === 'https' ),
        enabledTransports: ['ws', 'wss'],
    });

    // Example: Agar user ki apni private channel par listen karna ho
    // window.Echo.private('App.Models.User.' + {{ Auth::id() }})
    //     .notification((notification) => {
    //         console.log(notification);
    //         // Yahan aap toast notification ya DOM update kar sakte hain
    //     });
</script>
</body>

</html>
