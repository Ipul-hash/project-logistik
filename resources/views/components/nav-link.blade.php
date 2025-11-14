@props(['route', 'icon' => 'home', 'text' => '', 'active' => false])

@php
    $isActive = request()->routeIs($route);
    $classes = $isActive
        ? 'flex items-center space-x-3 px-4 py-2 rounded-lg bg-teal-700 text-white font-semibold transition-all duration-200'
        : 'flex items-center space-x-3 px-4 py-2 rounded-lg text-teal-200 hover:bg-teal-800 hover:text-white transition-all duration-200';
@endphp

<a href="{{ route($route) }}" class="{{ $classes }}">
    <!-- Icon -->
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        @switch($icon)
            @case('home')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 4l9 5.75V20a2 2 0 01-2 2H5a2 2 0 01-2-2V9.75z" />
                @break

            @case('users')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5m10-8a4 4 0 100-8 4 4 0 000 8z" />
                @break

            @case('cog')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.591 1.066 1.724 1.724 0 012.23.45 1.724 1.724 0 001.066 2.591c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.591 1.724 1.724 0 01-.45 2.23 1.724 1.724 0 00-2.591 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.591-1.066 1.724 1.724 0 01-2.23-.45 1.724 1.724 0 00-1.066-2.591c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.591 1.724 1.724 0 01.45-2.23 1.724 1.724 0 012.591-1.066z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8.25a3.75 3.75 0 110 7.5 3.75 3.75 0 010-7.5z" />
                @break

            @case('banknotes')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12V7a2 2 0 00-2-2H5a2 2 0 00-2 2v5m18 0v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5m18 0H3" />
                @break

            @case('scale')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18m0-9H5l7-9 7 9h-7z" />
                @break

            @case('clipboard-document-list')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V7a2 2 0 012-2h2l1-2h4l1 2h2a2 2 0 012 2v11a2 2 0 01-2 2z" />
                @break

            @default
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
        @endswitch
    </svg>

    <!-- Text -->
    <span>{{ $text }}</span>
</a>
