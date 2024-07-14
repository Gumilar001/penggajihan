<div class="w-[255px] h-full bg-white fixed shadow-md max-[900px]:-left-[255px] transition-[left] duration-200"
    id="sidebar">
    <div class="mt-20 ml-[35px]" style="    margin-left: 35px;">
        {!! file_get_contents('assets/images/auth/logo.svg') !!}
    </div>

    <div class="py-4 mt-5">
        <div id="wrapperSidebarMenu" class="h-[calc(100vh-155px)] relative [&_a_.text-sm]:!text-xs">
            <div class="flex flex-col h-full">
                <div>
                    <div data-bs-toggle="collapse" data-bs-target="#collapsePenggajihan" aria-expanded="false"
                        aria-controls="collapsePenggajihan" class="{{ Request::segment(1) != 'penggajihan' ? 'collapsed' : '' }}">
                        <div>
                            <x-layout.sidebar.menu to="#" parent="penggajihan" menuType="dropdown">
                                <x-slot name="icon">
                                    {!! file_get_contents('assets/icons/payment.svg') !!}
                                </x-slot>
                                <x-slot name="title">Penggajihan</x-slot>
                            </x-layout.sidebar.menu>
                        </div>
                    </div>
                    <div class="collapse {{ Request::segment(1) == 'penggajihan' ? 'show' : null }}" id="collapsePenggajihan">
                        <div class="block">
                            <x-layout.sidebar.sub-menu to="/penggajihan/tni">
                                <x-slot name="title">Penggajihan TNI</x-slot>
                            </x-layout.sidebar.sub-menu>
                            <x-layout.sidebar.sub-menu to="/penggajihan/pns">
                                <x-slot name="title">Penggajihan PNS</x-slot>
                            </x-layout.sidebar.sub-menu>
                        </div>
                    </div>
                </div>
                <div>
                    <div data-bs-toggle="collapse" data-bs-target="#collapsePersonel" aria-expanded="false"
                        aria-controls="collapsePersonel" class="{{ Request::segment(1) != 'personel' ? 'collapsed' : '' }}">
                        <div>
                            <x-layout.sidebar.menu to="#" parent="personel" menuType="dropdown">
                                <x-slot name="icon">
                                    {!! file_get_contents('assets/icons/user.svg') !!}
                                </x-slot>
                                <x-slot name="title">Data Personel</x-slot>
                            </x-layout.sidebar.menu>
                        </div>
                    </div>
                    <div class="collapse {{ Request::segment(1) == 'personel' ? 'show' : null }}" id="collapsePersonel">
                        <div class="block">
                            <x-layout.sidebar.sub-menu to="/personel/tni">
                                <x-slot name="title">TNI</x-slot>
                            </x-layout.sidebar.sub-menu>
                            <x-layout.sidebar.sub-menu to="/personel/pns">
                                <x-slot name="title">PNS</x-slot>
                            </x-layout.sidebar.sub-menu>
                            <x-layout.sidebar.sub-menu to="/personel/pangkat">
                                <x-slot name="title">Pangkat</x-slot>
                            </x-layout.sidebar.sub-menu>
                        </div>
                    </div>
                </div>
                <div>
                    <div data-bs-toggle="collapse" data-bs-target="#collapseLaporan" aria-expanded="false"
                        aria-controls="collapseLaporan" class="{{ Request::segment(1) != 'laporan' ? 'collapsed' : '' }}">
                        <div>
                            <x-layout.sidebar.menu to="#" parent="laporan" menuType="dropdown">
                                <x-slot name="icon">
                                    {!! file_get_contents('assets/icons/document.svg') !!}
                                </x-slot>
                                <x-slot name="title">Laporan</x-slot>
                            </x-layout.sidebar.menu>
                        </div>
                    </div>
                    <div class="collapse {{ Request::segment(1) == 'laporan' ? 'show' : null }}" id="collapseLaporan">
                        <div class="block">
                            <x-layout.sidebar.sub-menu to="/laporan/tni">
                                <x-slot name="title">Laporan TNI</x-slot>
                            </x-layout.sidebar.sub-menu>
                            <x-layout.sidebar.sub-menu to="/laporan/pns">
                                <x-slot name="title">Laporan PNS</x-slot>
                            </x-layout.sidebar.sub-menu>
                        </div>
                    </div>
                </div>
                
                {{-- @canany($listUsers) --}}
                    <div>
                        <div data-bs-toggle="collapse" data-bs-target="#collapseUser" aria-expanded="false"
                            aria-controls="collapseUser" class="{{ Request::segment(1) != 'user' ? 'collapsed' : '' }}">
                            <div>
                                <x-layout.sidebar.menu to="#" parent="user" menuType="dropdown">
                                    <x-slot name="icon">
                                        {!! file_get_contents('assets/icons/user.svg') !!}
                                    </x-slot>
                                    <x-slot name="title">User</x-slot>
                                </x-layout.sidebar.menu>
                            </div>
                        </div>
                        <div class="collapse {{ Request::segment(1) == 'user' ? 'show' : null }}" id="collapseUser">
                            <div class="block">
                                <x-layout.sidebar.sub-menu to="/user/account">
                                    <x-slot name="title">User Account</x-slot>
                                </x-layout.sidebar.sub-menu>
                                <x-layout.sidebar.sub-menu to="/user/role">
                                    <x-slot name="title">Role</x-slot>
                                </x-layout.sidebar.sub-menu>
                            </div>
                        </div>
                    </div>
                {{-- @endcanany --}}
                <div class="mt-auto">
                    <x-layout.sidebar.menu to="/logout">
                        <x-slot name="icon">
                            {!! file_get_contents('assets/icons/signout.svg') !!}
                        </x-slot>
                        <x-slot name="title">Signout</x-slot>
                    </x-layout.sidebar.menu>
                </div>

            </div>
        </div>
    </div>

</div>


@push('script')
    <script>
        $(document).ready(function() {
            const ps = new PerfectScrollbar('#wrapperSidebarMenu', {
                wheelSpeed: 0.5,
            });

            var pathname = window.location.pathname;
            if (pathname == '/' && $('.menu-sidebar').first()[0].innerText != 'Dashboard') {
                var type = $('.menu-sidebar').first().attr('data-type')
                if(type=='dropdown') {
                    $(".collapse .menu-sidebar").first()[0].click();
                }else {
                    $('.menu-sidebar').first()[0].click();
                }
            }
        })
    </script>
@endpush
