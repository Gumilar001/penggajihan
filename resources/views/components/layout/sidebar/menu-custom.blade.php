@if (Request::segment(1) == str_replace('/', '', $to) || Request::segment(1) == $parent)
    <a href="{{ $to }}" class="menu-sidebar custom-active group bg-secondary-10 before:bg-secondary-50" data-type="{{ $menuType }}">
        <div class="wrapper-icon">
            {{ $icon }}
        </div>
        <div class="text-sm text-secondary-60 font-bold flex flex-1 items-center justify-between">
            {{ $title }}

            @if ($parent != 1)
                <div class="relative left-3">
                    <span class="icon-dropdown-menu [&>svg>path]:stroke-secondary-60">
                        {!! file_get_contents('assets/icons/chevron-down.svg') !!}
                    </span>
                </div>
            @endif
        </div>
    </a>
@else
    <a href="{{ $to }}" class="menu-sidebar group" data-type="{{ $menuType }}">
        <div class="wrapper-icon">
            {{ $icon }}
        </div>
        <div class="text-sm text-neutral-70 group-hover:text-secondary-60 flex flex-1 items-center justify-between">
            {{ $title }}

            @if ($parent != 1)
                <div class="relative left-3">
                    <span
                        class="icon-dropdown-menu [&>svg>path]:stroke-neutral-70 group-hover:[&>svg>path]:stroke-secondary-60">
                        {!! file_get_contents('assets/icons/chevron-down.svg') !!}
                    </span>
                </div>
            @endif
        </div>
    </a>
@endif
