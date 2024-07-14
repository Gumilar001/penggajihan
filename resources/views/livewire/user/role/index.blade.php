<div>
    <div class="bg-white shadow-sm rounded-3xl w-full p-[30px]">
        <div class="flex items-center gap-4">
            <div class="[&>svg>path]:fill-secondary-100">
                {!! file_get_contents('assets/icons/user.svg') !!}
            </div>
            <div class="font-bold title-page text-black-80">
                Role
            </div>
        </div>
        <div class="flex items-center gap-3 mt-10 mb-5">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" placeholder="Cari Role" wire:model="search"
                        class="w-full px-4 py-3 pr-10 text-xs rounded-lg border-black-20 placeholder:text-black-80 focus:ring-0 focus:border-secondary-60">
                    <div class="absolute h-[46px] top-0 right-4 flex items-center justify-center cursor-pointer">
                        {!! file_get_contents('assets/icons/search.svg') !!}
                    </div>
                </div>
            </div>
            {{-- @can('create role') --}}
                <div class="flex items-center gap-2 sm:flex-wrap">
                    <a href="/user/role/add" class="my-btn my-btn-secondary">
                        Tambah
                    </a>
                </div>
            {{-- @endcan --}}
        </div>

        <div class="mt-5 table-responsive">
            <table>
                <thead>
                    <tr>
                        <th class="text-center w-14">No</th>
                        <th class="whitespace-nowrap">Nama Lengkap</th>
                        <th>Menu</th>
                        <th class="text-center">Status</th>
                        {{-- @canany(['edit role', 'delete role']) --}}
                            <th class="text-center col-action">Aksi</th>
                        {{-- @endcanany --}}
                    </tr>
                </thead>
                <tbody>
                    @if (count($role) > 0)
                        @foreach ($role as $key => $item)
                            <tr>
                                <td class="text-center">
                                    <span class="font-semibold">
                                        {{ $role->firstItem() + $key }}
                                    </span>
                                </td>
                                <td class="">
                                    <span class="capitalize">
                                        {{ $item['name'] }}
                                    </span>
                                </td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        @if (count($item->menu) == 0)
                                            <span class="text-xs italic text-slate-500">
                                                Hak Akses belum diatur
                                            </span>
                                        @else
                                            @foreach ($item->menu as $menuItem)
                                                <div class="[&>svg>path]:fill-secondary-60" data-bs-toggle="tooltip" data-bs-title="{{$menuItem['title']}}">
                                                    {!! file_get_contents('assets/icons/' . $menuItem['icon']) !!}
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="text-xs">
                                        @if ($item['is_active'])
                                            <div
                                                class="inline-block px-3 py-1 text-xs text-center border rounded-lg border-secondary-60 text-secondary-60">
                                                Aktif
                                            </div>
                                        @else
                                            <div
                                                class="inline-block px-3 py-1 text-xs text-center border rounded-lg border-danger-60 text-danger-60">
                                                Tidak Aktif
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                {{-- @canany(['edit role', 'delete role']) --}}
                                    <td class="text-center">
                                        <div class="flex justify-center gap-1">
                                            {{-- @can('edit role') --}}
                                                <a href="/user/role/edit/{{ $item->id }}"
                                                    class="my-btn-action-table my-btn-warning" data-bs-toggle="tooltip"
                                                    title="Edit">
                                                    {!! file_get_contents('assets/icons/outline-pencil-alt.svg') !!}
                                                </a>
                                            {{-- @endcan --}}
                                            {{-- @can('delete role') --}}
                                                <button wire:click="delete({{ $item->id }})"
                                                    class="my-btn-action-table my-btn-danger" data-bs-toggle="tooltip"
                                                    title="Hapus Item">
                                                    {!! file_get_contents('assets/icons/outline-trash.svg') !!}
                                                </button>
                                            {{-- @endcan --}}
                                        </div>
                                    </td>
                                {{-- @endcanany --}}
                            </tr>
                        @endforeach
                </tbody>
            @else
                <tr>
                    <td colspan="5">
                        <x-ui.empty-data message="Tidak Ada Data" />
                    </td>
                </tr>
                @endif
            </table>

            <div class="float-right m-3 mt-6">
                <nav class="flex items-center">
                    <ul class="pagination">
                        {{ $role->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
