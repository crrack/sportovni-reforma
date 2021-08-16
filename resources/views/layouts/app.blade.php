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
            <div id="app_main">
                <div>
                    @yield('content', 'loading')
                </div>
            </div>          
        </div>
    </body>
</html>