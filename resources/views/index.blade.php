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
        <section id="chci-se-zapojit" class="mb-20">
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
        <section class="bg-secondary ">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
                                    </svg>
                                </a>
                                <a 
                                    href="https://www.instagram.com/jandys.j/" 
                                    class="flex items-center justify-center w-12 h-12 text-white transition duration-200 bg-cover shadow-xl opacity-90 hover:opacity-75"
                                    style="background-image: url('data:image/jpeg;base64,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')"
                                >  
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                </a>
                                <a 
                                    href="https://twitter.com/jandysj" 
                                    class="flex items-center justify-center w-12 h-12 text-white transition duration-200 shadow-xl hover:bg-opacity-75"
                                    style="background: rgba(29,161,242, var(--tw-bg-opacity))"
                                > 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                    </svg>
                                </a>
                                <a 
                                    href="https://consent.youtube.com/m?continue=https%3A%2F%2Fwww.youtube.com%2Fchannel%2FUCQid7UGiK0dZ3JIgRG5yNXA&gl=CZ&m=0&pc=yt&uxe=23983171&hl=cs&src=1" 
                                    class="flex items-center justify-center w-12 h-12 text-white transition duration-200 shadow-xl hover:bg-opacity-75"
                                    style="background: rgba(255,0,0, var(--tw-bg-opacity))"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4.652 0h1.44l.988 3.702.916-3.702h1.454l-1.665 5.505v3.757h-1.431v-3.757l-1.702-5.505zm6.594 2.373c-1.119 0-1.861.74-1.861 1.835v3.349c0 1.204.629 1.831 1.861 1.831 1.022 0 1.826-.683 1.826-1.831v-3.349c0-1.069-.797-1.835-1.826-1.835zm.531 5.127c0 .372-.19.646-.532.646-.351 0-.554-.287-.554-.646v-3.179c0-.374.172-.651.529-.651.39 0 .557.269.557.651v3.179zm4.729-5.07v5.186c-.155.194-.5.512-.747.512-.271 0-.338-.186-.338-.46v-5.238h-1.27v5.71c0 .675.206 1.22.887 1.22.384 0 .918-.2 1.468-.853v.754h1.27v-6.831h-1.27zm2.203 13.858c-.448 0-.541.315-.541.763v.659h1.069v-.66c.001-.44-.092-.762-.528-.762zm-4.703.04c-.084.043-.167.109-.25.198v4.055c.099.106.194.182.287.229.197.1.485.107.619-.067.07-.092.105-.241.105-.449v-3.359c0-.22-.043-.386-.129-.5-.147-.193-.42-.214-.632-.107zm4.827-5.195c-2.604-.177-11.066-.177-13.666 0-2.814.192-3.146 1.892-3.167 6.367.021 4.467.35 6.175 3.167 6.367 2.6.177 11.062.177 13.666 0 2.814-.192 3.146-1.893 3.167-6.367-.021-4.467-.35-6.175-3.167-6.367zm-12.324 10.686h-1.363v-7.54h-1.41v-1.28h4.182v1.28h-1.41v7.54zm4.846 0h-1.21v-.718c-.223.265-.455.467-.696.605-.652.374-1.547.365-1.547-.955v-5.438h1.209v4.988c0 .262.063.438.322.438.236 0 .564-.303.711-.487v-4.939h1.21v6.506zm4.657-1.348c0 .805-.301 1.431-1.106 1.431-.443 0-.812-.162-1.149-.583v.5h-1.221v-8.82h1.221v2.84c.273-.333.644-.608 1.076-.608.886 0 1.18.749 1.18 1.631v3.609zm4.471-1.752h-2.314v1.228c0 .488.042.91.528.91.511 0 .541-.344.541-.91v-.452h1.245v.489c0 1.253-.538 2.013-1.813 2.013-1.155 0-1.746-.842-1.746-2.013v-2.921c0-1.129.746-1.914 1.837-1.914 1.161 0 1.721.738 1.721 1.914v1.656z"/>
                                    </svg>
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
