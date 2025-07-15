<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class=" font-sans antialiased bg-base-200 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-8 bg-base-100 rounded shadow">
        {{ $slot }}
    </div>
</body>
</html>