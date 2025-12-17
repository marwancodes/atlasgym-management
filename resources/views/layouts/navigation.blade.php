<nav class="w-[250px] h-screen bg-[#222222] border-r border-zinc-700">
    {{-- Application Logo --}}
    <div class="flex items-center px-6 py-6 border-b border-zinc-700">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-2xl font-bold">
            <x-application-logo class="w-auto h-6 text-gray-800 fill-current" />
            <span class="text-lg font-semibold text-white">ATLAS GYM</span>
        </a>
    </div>

    {{-- Navigation Links --}}
    <ul class="flex flex-col px-4 py-6 space-y-2">
      <x-nav-link href="{{ route('dashboard') }}">
         Dashboard
      </x-nav-link>
      
      <x-nav-link href="{{ route('members.index') }}">
         Members
      </x-nav-link>

      <x-nav-link href="#">
         Subscriptions
      </x-nav-link>

      <x-nav-link href="#">
         Plans
      </x-nav-link>

      <x-nav-link href="#">
         Payments
      </x-nav-link>

      <x-nav-link href="#">
         Attendance
      </x-nav-link>

      <x-nav-link href="#">
         Trainers
      </x-nav-link>


      {{-- Logout --}}
     <form method="POST" action="{{ route('logout')}}">
         @csrf
         <x-nav-link href="{{ route('logout') }}" :active="false" class="text-red-600" onclick="event.preventDefault(); this.closest('form').submit();">
             Logout
         </x-nav-link>
     </form>
    </ul>
</nav>
