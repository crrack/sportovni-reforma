@yield('content', 'loading')

@if (isset($meta['url']))
    <div 
        x-data="{
            init() {
                document.title = '{{ $meta['page_title'] ?? null }}';
                document.getElementsByTagName('meta')['title'].content = '{{ $meta['meta_title'] ?? null }}';
                document.getElementsByTagName('meta')['description'].content = '{{ $meta['meta_description'] ?? null }}';
                document.getElementsByTagName('meta')['keywords'].content = '{{ $meta['meta_keywords'] ?? null }}';
                document.title = '{{ $meta['page_title'] ?? null }}';
            }
        }"
        x-init="init()"
    >

    </div>
@else
    <div></div>
@endif
