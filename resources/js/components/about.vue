<template>
<article class="bg-gradient-to-t from-gray-500 to-gray-800 min-h-screen">
        <section class="pl-4 pt-16">
                <h1 class="text-4xl text-center pb-8">{{ $title }}</h1>
                <p>This weather web site has been made to impress APAX Software members.</p>
                <p>Technologies used: Larevel, Tailwindcss, OpenWeatherMap, and sqlite.</p>

                <!-- <a href="/logout" class="text-lg mx-2 text-white hover:text-green-500 transition">
                        {{ $dashboard::getUserName() }}
                        </a> -->
        </section>
        
</article>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
