<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistem Informasi Voting') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    <!-- Header/Navbar -->
    <x-home.header />

    <!-- Hero Section -->
    <x-home.hero />

    <!-- Stats Section -->
    <x-home.stats />

    <!-- Kandidat Section -->
    <x-home.kandidat />

    <!-- Tata Cara Section -->
    <x-home.tata-cara />


    <!-- Footer -->
    <x-home.footer />
</body>

</html>
