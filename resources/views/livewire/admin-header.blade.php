<div class="relative w-full">
    <div class="flex items-center justify-end">
        

        <div class="flex items-center gap-8">
            <a href="/notifikasi" class="relative cursor-pointer">
                <span class="{{ request()->is('notifikasi') ? '[&>svg>path]:fill-secondary-60' : '' }}">
                    {!! file_get_contents('assets/icons/notification.svg') !!}
                </span>
                @if ($notifikasi ?? '' > 0)
                    <div
                        class="bg-secondary-60 text-white rounded-full w-6 h-[26px] flex items-center justify-center text-xs absolute -top-2.5 -right-2">
                        {{ $notifikasi ?? '' }}
                    </div>
                @endif
            </a>
            <div class="flex justify-center">
                <div>
                    <div class="relative dropdown">
                        <div class="flex items-center gap-2 cursor-pointer" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            @if (Auth::user()->photo)
                                <img src="{{ Auth::user()->photo }}" alt="img" class="w-10 h-10 rounded-full"
                                    id="imgProfileHeader" />
                            @else
                                <img src="{{ asset('assets/images/default-avatar.svg') }}" alt="img"
                                    class="w-10 h-10 rounded-full" id="imgProfileHeader" />
                            @endif
                            {!! file_get_contents('assets/icons/dropdown.svg') !!}
                        </div>
                        <ul aria-labelledby="dropdownMenuButton1"
                            class="absolute z-50 hidden float-left py-2 m-0 mt-1 text-base text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu min-w-max bg-clip-padding">
                            <li>
                                <div
                                    class="dropdown-item text-sm py-2 px-4 font-semibold block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-white cursor-default pointer-events-none text-ellipsis max-w-[200px] flex-col">
                                    {{ Auth::user()->name }}
                                    <small class="block font-normal capitalize text-black-60">
                                        {{ Auth::user()->roles->pluck('name')->toArray()[0]??'-' }}
                                    </small>
                                </div>
                            </li>
                            <li>
                                <a href="/setting"
                                    class="block w-full px-4 py-2 text-sm font-normal text-gray-700 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-100">
                                    Account Setting
                                </a>
                            </li>
                            <li>
                                <a href="/logout"
                                    class="block w-full px-4 py-2 text-sm font-normal text-gray-700 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-100">
                                    Signout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- <div wire:ignore>
    {{ json_encode($searchResults) }}
</div> --}}
{{-- 
@if (!is_null($searchResults))
    <div class="card">
        <div class="card-header"><b>{{ $searchResults->count() }} results found for "{{ $search }}"</b></div>

        <div class="card-body">

            @foreach ($searchResults->groupByType() as $type => $modelSearchResults)
                <h2>{{ ucfirst($type) }}</h2>

                @foreach ($modelSearchResults as $searchResult)
                    <ul>
                        <li><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a></li>
                    </ul>
                @endforeach
            @endforeach

        </div>
    </div>
@endif --}}

@push('script')
    <script>
        $(document).ready(function() {
            $(".search-trigger").click(function() {
                $(".search-menu").addClass('show')
                $("body").addClass('overflow-hidden')
                setTimeout(() => {
                    $(".search-menu input").click()
                }, 100);
            })

            $(".search-menu .backdrop").click(function() {
                $(".search-menu").removeClass('show')
                $("body").removeClass('overflow-hidden')
            })
        })
    </script>
@endpush
