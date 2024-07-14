<a href="{{ $to }}" class="menu-sidebar group !pl-16">
    <div
        class="text-sm {{ (request()->is(ltrim($to, '/')) || request()->is(ltrim($to, '/').'/*')) ? 'text-secondary-60 font-bold' : 'text-neutral-70' }}  group-hover:text-secondary-60">
        {{ $title }}
    </div>
</a>
