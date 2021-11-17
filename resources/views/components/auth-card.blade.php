<div class="flex flex-col sm:justify-center items-center pt-12 sm:pt-0 bg-gradient-to-t from-gray-500 to-gray-800 min-h-screen">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
