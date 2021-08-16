@extends('layouts.' . $layout, [
    'meta' => $meta,
    'page' => $page ?? null
])

@section('content')  
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
                            <div @click="$scroll('#zname-reseni', {offset: 50})" class="cursor-pointer hover:text-white">Známe řešení</div>
                            <div @click="$scroll('#chci-se-zapojit', {offset: 50})" class="cursor-pointer hover:text-white">Chci se zapojit</div>
                        </div>
                        <div @click="open = true" class="text-white md:hidden">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                            </svg>
                        </div>
                        <div x-show="open" class="fixed inset-0 z-40 flex flex-col items-center justify-center space-y-8 text-3xl font-semibold bg-white bg-opacity-90 text-primary">
                            <div @click="open = false" @click="$scroll('#o-co-jde', {offset: 25})" class="cursor-pointer hover:text-gray-800">O co jde?</div>
                            <div @click="open = false" @click="$scroll('#zname-reseni', {offset: 25})" class="cursor-pointer hover:text-gray-800">Známe řešení</div>
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
                        <div class="flex items-center pb-12 mt-12 space-x-6 text-lg tracking-wider pt-sans">
                            <div @click="$scroll('#preambule', {offset: 50})" class="hidden px-10 py-5 text-white bg-opacity-75 cursor-pointer md:inline-block hover:text-white bg-primary">
                                Chci vědět více
                            </div>
                            <img src="img/signature.png" class="h-16 bg-white">
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
                <div class="float-right w-full max-w-sm p-12">
                    <img src="img/photo.png"/>
                </div>
                <div>
                    {!! $page['preambule'] !!}
                </div>
            </div>
        </section>
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
                                    <div x-show="open" class="w-full max-w-5xl px-2 py-4 mx-auto space-y-3 md:flex md:space-y-0 md:space-x-3 md:px-0">
                                        <div class="p-6 border-4 md:p-12 md:w-1/2 text-primary border-secondary">
                                            <p class="mb-4 text-2xl font-semibold">
                                                {{ $consequence['consequence_title'] }}
                                            </p>
                                            <p>
                                                {!! $consequence['consequence'] !!}
                                            </p>
                                        </div>
                                        <div class="p-6 border-4 md:p-12 md:w-1/2 text-primary border-secondary">
                                            <p class="mb-4 text-2xl font-semibold">
                                                {{ $consequence['impact_title'] }}
                                            </p>
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
        {{-- <section id="zname-reseni" class="pt-16 pb-20">
            <div class="w-full max-w-4xl mx-auto">
                <div class="flex flex-col items-center px-4 space-x-6 sm:flex-row lg:px-0">
                    <div class="font-light">
                        <p class="mb-4 text-4xl font-bold pt-sans">
                            Podívejte se na naši online brožuru
                        </p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Cumque, neque, officia voluptatum ab, quisquam aliquid voluptatibus omnis illo quidem vitae quaerat sit facilis dolor. 
                        Nisi est nulla accusantium odio quos.
                    </div>
                    <div class="pt-4 sm:pt-0">
                        <button class="px-12 py-5 text-lg font-medium text-white bg-green-600">
                            Zobrazit
                        </button>
                    </div>
                </div>
            </div>
        </section> --}}
        <section class="mb-20">
            <div class="w-full max-w-3xl mx-auto mt-6 space-y-2 font-light text-white p-14 bg-primary">
                <div class="flex items-center mb-8 space-x-6">
                    <div class="flex-grow">
                        <p class="text-2xl font-medium">Sportovní reforma se mi líbí a chci vědět víc</p>
                        <p class="text-white text-opacity-80">Dejte nám Váš email a my vám pošleme naši online brožuru.</p>
                    </div>
                </div>
                <div class="flex">
                    <input class="flex-grow px-4 py-4 text-black focus:outline-none" type="text" placeholder="Váš email...">
                    <button class="px-6 py-4 font-medium text-white bg-green-600">
                        Odeslat
                    </button>
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
        <section class="py-20 bg-secondary ">
            <div class="max-w-4xl mx-auto">
                Copyright © 2021 Reforma Sportu
            </div>
        </section> 
    </div>
@endsection
