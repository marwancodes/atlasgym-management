<nav class=" inset-y-0 left-0 w-[260px]
            bg-gradient-to-b from-gray-950 via-gray-950 to-black
            border-r border-white/10
            shadow-[10px_0_40px_rgba(0,0,0,0.6)]">

    <!-- Logo -->
    <div class="relative px-6 py-6 border-b border-white/10">
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 group">

            <div
                class="flex items-center justify-center w-10 h-10 transition shadow-lg rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-indigo-500/30 group-hover:scale-105">
                <x-application-logo class="w-6 h-6 text-white fill-current" />
            </div>

            <div>
                <p class="text-lg font-bold tracking-wide text-white">
                    ATLAS GYM
                </p>
                <p class="text-xs tracking-widest text-gray-400 uppercase">
                    Admin Panel
                </p>
            </div>
        </a>
    </div>

    <!-- Navigation -->
    <ul class="px-4 py-6 space-y-1">

        <!-- Section -->
        <li class="px-3 mb-2 text-xs font-semibold tracking-widest text-gray-500 uppercase">
            Main
        </li>

        <x-nav-link href="{{ route('dashboard') }}">
            <span class="flex items-center gap-3">
                📊 <span>Dashboard</span>
            </span>
        </x-nav-link>

        <x-nav-link href="{{ route('members.index') }}">
            <span class="flex items-center gap-3">
                👥 <span>Members</span>
            </span>
        </x-nav-link>

        <x-nav-link href="{{ route('subscriptions.index') }}">
            <span class="flex items-center gap-3">
                🎟 <span>Subscriptions</span>
            </span>
        </x-nav-link>

        <x-nav-link href="{{ route('subscription-plans.index') }}">
            <span class="flex items-center gap-3">
                💎 <span>Plans</span>
            </span>
        </x-nav-link>

        <!-- Divider -->
        <li class="my-4 border-t border-white/10"></li>

        <!-- Section -->
        <li class="px-3 mb-2 text-xs font-semibold tracking-widest text-gray-500 uppercase">
            Management
        </li>

        <x-nav-link href="#">
            <span class="flex items-center gap-3">
                💳 <span>Payments</span>
            </span>
        </x-nav-link>

        <x-nav-link href="#">
            <span class="flex items-center gap-3">
                🗓 <span>Attendance</span>
            </span>
        </x-nav-link>

        <x-nav-link href="#">
            <span class="flex items-center gap-3">
                🏋️ <span>Trainers</span>
            </span>
        </x-nav-link>
        
        <!-- Logout -->
        <div class="absolute bottom-0 w-[220px] py-6 border-t border-white/10">
         <form method="POST" action="{{ route('logout') }}">
             @csrf
             <button
                 onclick="event.preventDefault(); this.closest('form').submit();"
                 class="flex items-center w-[220px] gap-3 px-4 py-3 text-sm font-medium text-red-400 transition rounded-xl hover:bg-red-500/10 hover:text-red-300">
                 🚪 <span >Logout</span>
             </button>
         </form>
        </div>
    </ul>


</nav>
