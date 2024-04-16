<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">
<x-nav sticky class="lg:hidden">
    <x-slot:brand>
        <div class="ml-5 pt-5">MRLP</div>
    </x-slot:brand>
    <x-slot:actions>
        <label for="main-drawer" class="lg:hidden mr-3">
            <x-icon name="o-bars-3" class="cursor-pointer"/>
        </label>
    </x-slot:actions>
</x-nav>

{{-- NAVBAR --}}
<x-main full-width>

    <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">
        <div class="ml-5 pt-5">
            <div class="flex flex-col items-center">
                <x-avatar :image="asset('images/logo.png')" class="!w-20"/>
                <div class="">MRLP</div>
                <div class="text-gray-500 text-xs">Minimalistic Remote Learning Platform</div>
            </div>

            {{--            asset('storage/images/cMxbNSteMBjGknPQSGxPgmJCVn4FjQYzj8TjNvn3.png')--}}
        </div>
        <x-menu activate-by-route>
            @if($user = auth()->user())
                <x-menu-separator/>
                @php $admin = $user->name; @endphp
                <x-menu-sub title="{{$admin}}" icon="o-user">
                    <x-menu-item title="LogOut" icon="o-power" link="/logout"/>
                    {{--                    <x-menu-item title="Profile" icon="o-archive-box" link="/profile"/>--}}
                </x-menu-sub>
                <x-menu-separator/>
            @endif
            @AdminOrProf
            <x-menu-item title="Courses" icon="phosphor.read.cv.logo.fill" link="/courses"/>
            @endAdminOrProf
            @if(auth()->check() && auth()->user()->user_type === 'admin')
                <x-menu-item title="Professors" icon="phosphor.chalkboard.teacher" link="/professors"/>
                <x-menu-item title="Students" icon="phosphor.student.fill" link="/students"/>
            @endif
            {{--            <x-menu-sub title="Settings" icon="o-cog-6-tooth">--}}
            {{--                <x-menu-item title="Wifi" icon="o-wifi" link="####"/>--}}
            {{--                <x-menu-item title="Archives" icon="o-archive-box" link="####"/>--}}
            {{--            </x-menu-sub>--}}
        </x-menu>
    </x-slot:sidebar>
    <x-slot:content>
        {{ $slot }}
    </x-slot:content>
</x-main>

{{-- Toast --}}
<x-toast/>

</body>
