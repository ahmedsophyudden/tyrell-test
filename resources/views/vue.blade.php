<!--
=========================================================
* Vue Argon Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://creative-tim.com/product/vue-argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <link rel="icon" href="<%= BASE_URL %>favicon.png" />
  <title> Basic Laravel 8 Vue 3 Bootstrap</title>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <script>
    window.Laravel = {
      csrfToken: '{{ csrf_token() }}'
    };
    window._asset = "{{ asset('') }}";
  </script>

  <script src="{{ mix('css/app.css') }}"></script>
  <style>
    .swal2-container {
      z-index: 9999 !important;
    }
  </style>
</head>

<body class="bg-gray-100">
  <noscript>
    <strong>We're sorry but Vue Argon Dashboard 2 doesn't work properly without
      JavaScript enabled. Please enable it to continue.</strong>
  </noscript>
  <div id="app" class="g-sidenav-show">
    <App></App>
  </div>
  <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>