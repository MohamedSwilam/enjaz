<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" href="{{ asset('icon.svg') }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Enjaz Test</title>
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('loader.css') }}" />
  @vite(['resources/ts/main.ts'])
</head>

<body>
  <div id="app">
    <div id="loading-bg">
      <div class="loading-logo">
        <!-- SVG Logo -->
          <img
              id="loader-logo"
              src="/logo.svg"
              alt="Logo"
          />
      </div>
      <div class=" loading">
        <div class="effect-1 effects"></div>
        <div class="effect-2 effects"></div>
        <div class="effect-3 effects"></div>
      </div>
    </div>
  </div>

  <script>
    const primaryColor = localStorage.getItem('enjaz-initial-loader-color') || '#7367F0'
    const loaderColor = localStorage.getItem('enjaz-initial-loader-bg') || '#FFFFFF'

    if (loaderColor === '#FFFFFF')
        document.getElementById('loader-logo').src = '/logo.svg'
    else
        document.getElementById('loader-logo').src = '/logo-light.svg'

    if (loaderColor)
      document.documentElement.style.setProperty('--initial-loader-bg', loaderColor)

    if (primaryColor)
      document.documentElement.style.setProperty('--initial-loader-color', primaryColor)
  </script>
</body>

</html>
