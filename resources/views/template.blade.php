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

</body>

</html>
