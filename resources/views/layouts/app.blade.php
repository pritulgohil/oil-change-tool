<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Check whether your vehicle is due for an oil change based on kilometres and time.">
    <meta name="theme-color" content="#0d3b31">
    <title>@yield('title', 'Oil Change Check') · {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type=image/svg+xml">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="site-shell">
        <header class="site-header">
            <a class="brand" href="{{ route('oil-change.create') }}" aria-label="Vehikl Oil Change home">
                <span class="brand-mark" aria-hidden="true"><svg viewBox="0 0 48 48" role="img">
                        <path d="M24 5C18 14 11 21 11 30a13 13 0 0 0 26 0C37 21 30 14 24 5Z" fill="currentColor" />
                        <path d="M18 31c0 3.5 2.7 6 6 6" fill="none" stroke="white" stroke-linecap="round" stroke-width="3" />
                    </svg></span>
                <span>
                    <strong>Vehikl</strong>
                    <small>Oil Change Check</small>
                </span>
            </a>
        </header>
        <main class="main-content">
            @yield('content')
        </main>

        <footer class="site-footer">
            <p>Made using PHP / Laravel. Source code here - <a href="https://github.com/pritulgohil/oil-change-tool/" target="_blank">https://github.com/pritulgohil/oil-change-tool/</a< /p>
        </footer>
    </div>
</body>

</html>