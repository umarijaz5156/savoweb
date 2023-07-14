<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="./images/favicon-logo.png" type="image/x-icon" />
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('output.css') }}">
    <link rel="stylesheet" href="{{ asset('custom.css') }}">

    <!-- Swipper Slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <!-- /* Font Awsome Cdn */ -->
    <link href="https://cdn.jsdelivr.net/gh/duyplus/fontawesome-pro/css/all.min.css" rel="stylesheet" type="text/css" />
    {{-- <link rel="stylesheet" href="../src/js/sal.min.css"> --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/css/custom.css', 'resources/js/custom.js'])
    @livewireStyles
</head>




<body x-data="{ showBar: false }">
    @include('web.includes.navbar')

    <main>
        {{ $slot }}
    </main>

    @include('web.includes.footer')
    @stack('modals')
    @stack('scripts')
    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>
    <script src="
https://cdn.jsdelivr.net/npm/flag-icon-css@4.1.7/svgo.config.min.js
"></script>
    <script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('src/js/app.js') }}"></script>

    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFBzDvElEMKSfJ5z1IC-UAYUOcQ9xljk0&libraries=places&callback=initAutocomplete"
    async
    defer
  ></script>


</body>

</html>
