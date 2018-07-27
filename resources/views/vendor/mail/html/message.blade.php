@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ 'Sport Casta' }}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}



    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')

        @endcomponent
    @endslot
@endcomponent
