<html>
    <head>
        <title>{{ $meta['page_title'] ?? null }}</title>
        <meta name="title" content="{{ $meta['seo_title'] ?? null }}">
        <meta name="description" content="{{ $meta['seo_description'] ?? null }}">
        <meta name="keywords" content="{{ $meta['seo_keywords'] ?? null }}">
        <meta charset="UTF-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400;500;700&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@1.2.x/dist/scroll.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    </head>
    <body 
        x-data="{
            menu_open: false,
            version_dropdown: false,
            loading: false,
            fill(page) {
                this.loading = true;

                var char = '?';
                if(page.includes('?')) char = '&';

                window.history.pushState(page, '{{ $meta['page_title'] ?? null }}', page);
                console.log(page);
                fetch('{{ url('/') }}' + page + char + 'type=fetch')
                .then((response) => {
                    if (!response.ok) {
                        console.log(response.status);
                    }
                    return response.text();
                }).then((html) => {
                    document.getElementById('app_main').innerHTML = html;  
                });

                this.loading = false;
                this.menu_open = false;

                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            },
            init() {
                window.onpopstate = () => {
                    location.reload();
                    //this.fill(window.location.pathname);
                };
            }
        }"
        @fill.window="fill($event.detail)"
        x-init="init"
    >
        <div x-show="loading" class="fixed inset-0 z-50 flex items-center justify-center text-4xl bg-white bg-opacity-90">
            <svg class="animate-spin" xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24">
                <path d="M14 22c0 1.104-.896 2-2 2s-2-.896-2-2 .896-2 2-2 2 .896 2 2zm-2-22c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm10 10c1.104 0 2 .896 2 2s-.896 2-2.001 2c-1.103 0-1.999-.895-1.999-2s.896-2 2-2zm-22 2c0 1.105.896 2 2 2s2-.895 2-2c0-1.104-.896-2-2-2s-2 .896-2 2zm19-9c1.104 0 2 .896 2 2s-.896 2-2.001 2c-1.103 0-1.999-.895-1.999-2s.896-2 2-2zm0 14c1.104 0 2 .896 2 2s-.896 2-2.001 2c-1.103 0-1.999-.895-1.999-2s.896-2 2-2zm-14-14c1.104 0 2 .896 2 2s-.896 2-2.001 2c-1.103 0-1.999-.895-1.999-2s.896-2 2-2zm0 14c1.104 0 2 .896 2 2s-.896 2-2.001 2c-1.103 0-1.999-.895-1.999-2s.896-2 2-2z"/>
            </svg>
        </div>
        <div id="app_body">
            <div class="index">
                <section id="top" class="bg-bottom bg-cover header" style="background-image: url('img/header.jpg')">
                    <div 
                        x-data="{ 
                            open: false, 
                            navScroll: false,
                        }"
                        @scroll.window="if (document.body.getBoundingClientRect().top < -100){ navScroll = true }else{ navScroll = false}"
                        class="z-30 flex flex-col justify-between h-full bg-primary bg-opacity-70"
                    >
                        <div 
                            class="fixed z-30 w-full py-2 bg-opacity-0 bg-primary"  
                            :class="{ 'bg-opacity-95': navScroll }"
                        >
                            <div class="flex items-center justify-between w-full max-w-6xl px-8 mx-auto tracking-wide pt-sans">
                                <div @click="$scroll('#top')" class="py-3 text-3xl font-semibold text-white cursor-pointer">
                                    sportovni-reforma.cz
                                </div>
                                <div class="hidden px-12 py-6 space-x-12 font-semibold tracking-wide text-gray-100 uppercase md:flex">
                                    <div @click="$scroll('#o-co-jde', {offset: 50})" class="cursor-pointer hover:text-white">O co jde?</div>
                                    <div @click="$scroll('#zname-reseni', {offset: 50})" class="cursor-pointer hover:text-white">Jak na to?</div>
                                    <div @click="$scroll('#chci-se-zapojit', {offset: 50})" class="cursor-pointer hover:text-white">Chci se zapojit</div>
                                </div>
                                <div @click="open = true" class="text-white md:hidden">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                                    </svg>
                                </div>
                                <div x-show="open" class="fixed inset-0 z-40 flex flex-col items-center justify-center space-y-8 text-3xl font-semibold bg-white bg-opacity-90 text-primary">
                                    <div @click="open = false" @click="$scroll('#o-co-jde', {offset: 25})" class="cursor-pointer hover:text-gray-800">O co jde?</div>
                                    <div @click="open = false" @click="$scroll('#zname-reseni', {offset: 25})" class="cursor-pointer hover:text-gray-800">Jak na to?</div>
                                    <div @click="open = false" @click="$scroll('#chci-se-zapojit', {offset: 25})" class="cursor-pointer hover:text-gray-800">Chci se zapojit</div>
                                </div>
                                <div x-show="open" @click="open = false" class="fixed top-0 right-0 z-50 px-8 py-6 text-black md:hidden">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="w-full max-w-6xl px-8 mx-auto mt-24 text-white xl:mt-48">
                            <h1 class="text-4xl font-bold leading-tight sm:text-5xl md:text-8xl pt-sans">
                                {{ $page['title'] }}
                            </h1>
                            <h4 class="mt-8 text-2xl md:text-4xl">
                                {{ $page['description'] }}
                            </h4>
                        </div>
                        <div class="flex flex-col justify-between flex-grow w-full max-w-6xl px-8 mx-auto md:flex-row">
                            <div class="mt-12 md:mt-18 md:w-7/12">
                                <div class="text-xl italic font-light text-white">
                                    {{ $page['header_text'] }}
                                </div>
                                <div class="flex items-center pb-12 mt-12 space-x-6 text-lg tracking-wider whitespace-nowrap pt-sans">
                                    <div @click="$scroll('#preambule', {offset: 50})" class="hidden px-10 py-5 text-white bg-opacity-75 cursor-pointer whitespace-nowrap md:block hover:text-white bg-primary">
                                        Chci vědět více
                                    </div>
                                    <div class="">
                                        <img src="img/signature.png" style="height:72px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="preambule">
                    <div class="pt-16 pb-10 text-5xl font-bold text-center pt-sans">
                        Proč řešit sport?
                    </div>
                    <div class="w-full max-w-6xl px-6 mx-auto mt-6 space-x-6 font-light">
                        <div class="float-right w-full max-w-sm p-12 lg:max-w-lg">
                            <img src="img/photo.png"/>
                        </div>
                        <div>
                            {!! $page['preambule'] !!}
                        </div>
                    </div>
                </section>
                <div id="app_main">
                    <div>
                        @yield('content', 'loading')
                    </div>
                </div> 
                <section class="py-20 bg-secondary ">
                    <div class="max-w-4xl mx-auto">
                        Copyright © 2021 Reforma Sportu
                    </div>
                </section> 
            </div>         
        </div>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-205581385-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-205581385-1');
        </script>
    </body>
</html>