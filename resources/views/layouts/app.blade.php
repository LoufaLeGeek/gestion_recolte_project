<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Gestion Production Agricole</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --primary-color: #2e7d32;
            --secondary-color: #4caf50;
            --light-green: #e8f5e9;
        }
        
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans h-screen overflow-hidden flex flex-col">
    <!-- Navigation -->
    @include('partials.header')

    <div class="flex flex-1 overflow-hidden">
    <!-- Sidebar -->
    @include('partials.sidebar')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto p-1">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-300 flex justify-between items-center">
                    {{ session('success') }}
                    <button type="button" class="text-green-700 hover:text-green-900">&times;</button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300 flex justify-between items-center">
                    {{ session('error') }}
                    <button type="button" class="text-red-700 hover:text-red-900">&times;</button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
    <!-- Footer -->
    @include('partials.footer')

    @stack('scripts')
</body>
