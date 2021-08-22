@extends('layouts.' . $layout, [
    'meta' => $meta,
    'page' => $page ?? null
])

@section('content')  
        <section class="mb-20 counts">
            <div class="w-full max-w-6xl pt-20 mx-auto space-y-6 text-center md:space-y-0 md:space-x-6 md:flex text-primary">
                @foreach ($page['counts']['value'] as $count)
                    <div class="md:w-1/4">
                        <div class="mb-2 text-4xl font-semibold pt-sans">{{ $count['number'] }}</div>
                        <div class="px-6 md:px-0">{{ $count['description'] }}</div>
                    </div>
                @endforeach
            </div>
        </section>
        <section id="o-co-jde">
            <div class="pt-20 text-5xl font-bold text-center pt-sans">
                Klíčové problémy 
            </div>
            <div 
                x-data="{ 
                    active: null,
                    setActive(index) { 
                        if(this.active == index) {
                            this.active = null;
                        }else {
                            this.active = index;
                            setTimeout(() => {
                                $scroll('#problem' + index, { offset: -300 });
                            }, 100);
                        }
                    }
                }"
                class="grid w-full max-w-5xl px-8 mx-auto my-20 cards sm:grid-cols-2 lg:grid-cols-3 lg:px-0"
            >
                @foreach ($page['problems']['value'] as $key => $problem)
                    <div>
                        <div id="problem{{ $loop->iteration }}" @click="setActive({{ $loop->iteration }})" class="w-full max-w-sm mx-auto cursor-pointer flip-card">
                            <div class="inset-0 flex flex-col justify-center flip-card-inner" style="padding-top: 100%">
                                <div class="inset-0 p-3 flip-card-front">
                                    <div class="flex flex-col justify-between h-full">
                                        <div class="w-full pt-6 pl-6 text-7xl opacity-60 pt-sans">
                                            {{ $loop->iteration }}
                                        </div>
                                        <div class="w-7/12 mx-auto text-xl font-light text-center pt-sans">
                                            {{ $problem['title'] }}
                                        </div>
                                        <span class="p-6 mt-6 text-right">
                                            Zjistit více
                                            <img src="http://jakubjanda.cz/theme/img/link-icon.png" alt="" class="inline">
                                        </span>
                                    </div>
                                </div>
                                <div class="inset-0 flip-card-back bg-secondary text-primary">
                                    <div class="h-full p-12 leading-7">
                                        {!! $problem['description'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div 
                            class="py-12 lg:w-300 sm:w-200" 
                            x-show="active == {{ $loop->iteration }}" 
                            :class="{ 
                                'sm:-ml-100': ({{ $loop->index }}+1) % 2 == 0,
                                'lg:-ml-0': {{ $loop->index }} % 3 == 0,
                                'lg:-ml-100': ({{ $loop->index }}+2) % 3 == 0,
                                'lg:-ml-200': ({{ $loop->index }}+1) % 3 == 0
                            }"
                        >
                            <div class="w-full max-w-4xl px-4 mx-auto md:space-x-8 md:flex md:px-0">
                                <div class="leading-7 md:w-5/12">
                                    {!! $problem['description'] !!}
                                </div>
                                <div class="md:w-7/12">
                                    {!! $problem['image'] !!}
                                </div>   
                                   
                            </div>
                            <div class="w-full max-w-4xl px-4 mx-auto text-xs text-right">
                                {!! $problem['source'] ?? null !!}
                            </div> 
                            @foreach ($problem['list']['value'] as $key => $consequence)
                                <div x-data="{open: false}">
                                    <div 
                                        @click="open = !open"
                                        :class="{ 'scale-105 bg-opacity-100': open }"
                                        class="flex items-center justify-between w-full max-w-2xl px-6 py-4 mx-auto my-4 transition duration-200 transform bg-opacity-50 cursor-pointer hover:scale-105 bg-secondary hover:bg-opacity-100"
                                    >
                                        <p>
                                            {{ $consequence['title'] }}
                                        </p>
                                        <div>
                                            <svg x-show="open" class="w-6 h-6 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            <svg x-show="!open" class="w-6 h-6 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div x-show="open" class="w-full max-w-5xl px-2 mx-auto my-4 space-y-3 border-4 border-secondary md:flex md:space-y-0 md:px-0">
                                        <div class="p-6 md:p-12 text-primary">
                                            <p class="mb-4 text-2xl font-semibold">
                                                {{ $consequence['consequence_title'] }}
                                            </p>
                                            <p>
                                                {!! $consequence['consequence'] !!}
                                            </p>
                                            <br>
                                            <p>
                                                {!! $consequence['impact'] !!}
                                            </p>
                                        </div>
                                    </div>
                                    <div x-show="open" class="w-full max-w-5xl p-6 mx-auto border-4 border-opacity-50 border-primary md:p-12 bg-secondary">
                                        <p class="mb-4 text-2xl font-semibold text-primary">
                                            {{ $consequence['solution_title'] }}
                                        </p>
                                        <p class="text-primary">
                                            {!! $consequence['solution'] !!}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach 
            </div>
        </section>
        <section id="zname-reseni" class="mb-20">
            <div class="pt-16 pb-20 text-5xl font-bold text-center pt-sans">
                Jak na to?
            </div>
            <div class="flex-wrap w-full max-w-6xl px-6 mx-auto mt-6 space-y-4 font-light text-white">
                @foreach ($page['solutions']['value'] as $key => $solution)
                    <div x-data="{ open: false }">
                        <div @click="open = !open" class="relative flex items-center w-full max-w-4xl px-6 py-6 mx-auto transition duration-200 transform cursor-pointer bg-primary sm:h-20 md:px-10 hover:scale-105">
                            <div class="mr-2 text-3xl font-normal opacity-25 md:mr-6 md:text-4xl pt-sans">
                                {{ $loop->iteration }}.
                            </div>
                            <div class="flex-grow pl-4 text-lg md:text-xl">
                                {{ $solution['title'] }}
                            </div>
                            <svg x-show="open" class="flex-none hidden w-8 h-8 md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                            <svg x-show="!open" class="flex-none hidden w-8 h-8 md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div x-show="open" class="w-full p-8 mt-4 md:text-lg text-primary">
                            <div class="float-right px-2 space-y-2">
                                <a href="#" class="flex items-center h-10 p-2 space-x-2 font-semibold text-white bg-black rounded-md w-42">
                                    <img class="h-6" src="img/spotify.png">
                                    <p>Spotify</p>
                                </a>
                                <a href="#" class="flex items-center h-10 p-2 space-x-2 font-semibold text-gray-600 bg-gray-100 rounded-md w-42">
                                    <img class="h-6" src="img/apple-podcast.png">
                                    <p>Apple Music</p>
                                </a>
                            </div>
                            <div>{!! $solution['body'] !!}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="mb-20">
            <div class="w-full max-w-3xl mx-auto mt-6 space-y-2 font-light text-white p-14 bg-primary">
                <div class="flex items-center mb-8 space-x-6">
                    <div class="flex-grow">
                        <p class="text-2xl font-medium">Sportovní reforma se mi líbí a chci vědět víc</p>
                        <p class="text-white text-opacity-80">Dejte nám Váš email a my vám pošleme naši online brožuru.</p>
                    </div>
                </div>
                <div 
                    x-data="{
                        loading: false,
                        success: false,
                        fail: false,
                        email: null,
                        send() {
                            this.loading = true;
                            fetch('/send-book', {
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json, text-plain, */*',
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-Token': '{{ csrf_token() }}'
                                },
                                method: 'post',
                                credentials: 'same-origin',
                                body: JSON.stringify({
                                    email: this.email
                                })
                            }).then((response) => {
                                return response.json()
                            }).then((response) => {
                                if(response.status == 'done') {
                                    this.success = true;
                                }else {
                                    this.fail = true;
                                }
                                this.loading = false;
                            });
                        },
                    }" 
                    class="relative flex"
                >
                    <input x-model="email" class="flex-grow px-4 py-4 text-black focus:outline-none" type="text" placeholder="Váš email...">
                    <button @click="send" class="px-6 py-4 font-medium text-white bg-green-600 focus:outline-none">
                        <span>Odeslat</span>
                    </button>
                    <div x-show="loading" style="display:none" class="absolute inset-0 flex items-center justify-center text-black bg-white opacity-40">
                        <svg class="animate-spin" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.75 22c0 .966-.783 1.75-1.75 1.75s-1.75-.784-1.75-1.75.783-1.75 1.75-1.75 1.75.784 1.75 1.75zm-1.75-22c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm10 10.75c.689 0 1.249.561 1.249 1.25 0 .69-.56 1.25-1.249 1.25-.69 0-1.249-.559-1.249-1.25 0-.689.559-1.25 1.249-1.25zm-22 1.25c0 1.105.896 2 2 2s2-.895 2-2c0-1.104-.896-2-2-2s-2 .896-2 2zm19-8c.551 0 1 .449 1 1 0 .553-.449 1.002-1 1-.551 0-1-.447-1-.998 0-.553.449-1.002 1-1.002zm0 13.5c.828 0 1.5.672 1.5 1.5s-.672 1.501-1.502 1.5c-.826 0-1.498-.671-1.498-1.499 0-.829.672-1.501 1.5-1.501zm-14-14.5c1.104 0 2 .896 2 2s-.896 2-2.001 2c-1.103 0-1.999-.895-1.999-2s.896-2 2-2zm0 14c1.104 0 2 .896 2 2s-.896 2-2.001 2c-1.103 0-1.999-.895-1.999-2s.896-2 2-2z"/>
                        </svg>
                    </div>
                    <div x-show="success" @click.away="success = false" style="display:none" class="absolute inset-0 flex items-center justify-center text-white bg-green-600">
                        Brožura byla odeslaná na váš email.
                    </div>
                    <div x-show="fail" @click.away="fail = false" style="display:none" class="absolute inset-0 flex items-center justify-center text-white bg-red-600">
                        Odeslání se nepodařilo, zkuste to prosím později.
                    </div>
                </div>
            </div>
        </section>
        <section id="chci-se-zapojit" class="bg-secondary ">
            <div class="max-w-5xl px-8 mx-auto md:px-0">
                <div class="pt-16 pb-20 text-5xl font-bold text-center pt-sans">
                    Za projektem stojí:
                </div>
                <div class="block pb-8 text-primary">
                    <div class="flex flex-col-reverse items-center justify-between w-full max-w-2xl px-8 py-6 mx-auto mb-4 bg-white md:space-x-6 md:flex-row">
                        <div class="">
                            <a href="https://jakubjanda.cz" class="mb-2 text-xl">
                                <strong>Jakub Janda</strong> - poslanec za ODS
                            </a>
                            <p class="text-sm opacity-60">
                                Jakub Janda se narodil v roce 1978 v obci Čeladná. Již od dětství se věnoval skokům na lyžích, v této disciplíně zaznamenal největší úspěch v sezóně 2005/2006 vítězstvím Světového poháru. Od roku 2017 je poslancem za ODS. Aktivně se věnuje podpoře sportu jak na regionální, tak i na celostátní úrovni.
                            </p>
                            <div class="flex mt-8 space-x-2 bg-opacity-90">
                                <a 
                                    href="https://www.facebook.com/jandysj" 
                                    class="flex items-center justify-center w-12 h-12 text-white transition duration-200 shadow-xl hover:bg-opacity-75"
                                    style="background: rgba(66,103,178, var(--tw-bg-opacity))"
                                >
                                    <img src="http://jakubjanda.cz/theme/img/facebook.svg" alt="" class="h-6"/>
                                </a>
                                <a 
                                    href="https://www.instagram.com/jandys.j/" 
                                    class="flex items-center justify-center w-12 h-12 text-white transition duration-200 bg-cover shadow-xl opacity-90 hover:opacity-75"
                                    style="background-image: url('data:image/jpeg;base64,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')"
                                >  
                                    <img src="http://jakubjanda.cz/theme/img/instagram.svg" alt="" class="h-6"/>
                                </a>
                                <a 
                                    href="https://twitter.com/jandysj" 
                                    class="flex items-center justify-center w-12 h-12 text-white transition duration-200 shadow-xl hover:bg-opacity-75"
                                    style="background: rgba(29,161,242, var(--tw-bg-opacity))"
                                > 
                                    <img src="http://jakubjanda.cz/theme/img/twitter.svg" alt="" class="h-6"/>
                                </a>
                                <a 
                                    href="https://consent.youtube.com/m?continue=https%3A%2F%2Fwww.youtube.com%2Fchannel%2FUCQid7UGiK0dZ3JIgRG5yNXA&gl=CZ&m=0&pc=yt&uxe=23983171&hl=cs&src=1" 
                                    class="flex items-center justify-center w-12 h-12 text-white transition duration-200 shadow-xl hover:bg-opacity-75"
                                    style="background: rgba(255,0,0, var(--tw-bg-opacity))"
                                >
                                    <img src="http://jakubjanda.cz/theme/img/youtube.svg" alt="" class="h-6"/>
                                </a>
                            </div>
                        </div>
                        <div class="flex-none mb-4 md:mb-0">
                            <img class="object-cover w-32 h-32 rounded-full" src="https://img.cncenter.cz/img/3/full/4404432_skoky-na-lyzich-poslanec-jakub-janda-v0.jpg?v=0" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section> 
@endsection
