<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <!-- Scripts -->
    @routes
    @vite([
    'resources/js/app.js',
    "resources/js/Pages/{$page['component']}.vue",
    'resources/css/app.css'
    ])
    @inertiaHead
</head>

<body class="h-full antialiased">
    @inertia
    <script>
        function getInitialTheme() {
            // Get the theme from localStorage or fall back to 'theme-blue'
            const theme = localStorage.getItem('theme') || 'theme-blue';
            // Add the theme class to the html element
            document.documentElement.classList.add(theme);
        }

        // Call the function to set the initial theme
        getInitialTheme();
    </script>
</body>

</html>