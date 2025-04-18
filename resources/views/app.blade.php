<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- SERVER SIDE INERTIA SETUP --}}
    @viteReactRefresh
    @vite('resources/js/app.jsx')
    @inertiaHead

    @routes
</head>

<body>
    @inertia
</body>

</html>
