<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            Subscription Plans
        </h2>
    </x-slot>
    

    <div class="grid gap-10 p-6 sm:grid-cols-2 lg:grid-cols-3">

        <!-- Add New Plan Ticket -->
        <a href="{{ route('subscription-plans.create') }}"
        class="group relative flex items-center justify-center rounded-3xl overflow-hidden
                bg-gradient-to-br from-indigo-600/20 via-purple-600/20 to-pink-600/20
                border border-white/20
                backdrop-blur-xl
                shadow-[0_30px_80px_rgba(0,0,0,0.7)]
                transition-all duration-500
                hover:-translate-y-2 hover:shadow-indigo-500/40">

            <!-- Glow -->
            <div
                class="absolute -inset-[1px] rounded-3xl
                    bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500
                    opacity-30 blur group-hover:opacity-70
                    transition duration-500">
            </div>

            <!-- Content -->
            <div class="relative z-10 p-10 text-center">
                <div
                    class="flex items-center justify-center w-16 h-16 mx-auto mb-4 text-white transition rounded-full shadow-lg bg-gradient-to-r from-indigo-500 to-purple-500 group-hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4v16m8-8H4"/>
                    </svg>
                </div>

                <h3 class="text-xl font-bold text-white">
                    Add New Plan
                </h3>

                <p class="mt-2 text-sm text-gray-300">
                    Create a new subscription ticket
                </p>
            </div>
        </a>


        @foreach ($plans as $plan)
            <div
                class="group relative rounded-3xl overflow-hidden
                    bg-gradient-to-br from-gray-900 via-gray-900 to-gray-800
                    
                    border border-white/10
                    backdrop-blur-xl
                    shadow-[0_30px_80px_rgba(0,0,0,0.7)]
                    transition-all duration-500
                    hover:-translate-y-2 hover:shadow-indigo-500/20">

                <!-- Glow border -->
                <div
                    class="absolute -inset-[1px] rounded-3xl
                        bg-gradient-to-r from-indigo-500/30 via-purple-500/30 to-pink-500/30
                        opacity-0 group-hover:opacity-100 blur
                        transition duration-500">
                </div>

                <!-- Ticket perforation -->
                <div class="absolute w-8 h-8 -translate-y-1/2 rounded-full bg-purple-400/10 top-1/2 -left-4"></div>
                <div class="absolute w-8 h-8 -translate-y-1/2 rounded-full bg-purple-400/10 top-1/2 -right-4"></div>
                

                <!-- Tear line -->
                <div class="absolute left-0 w-full border-t border-dashed top-1/2 border-white/20"></div>

                <!-- Content -->
                <div class="relative z-10 p-8 text-center">
                    <!-- Plan name -->
                    <h3 class="text-2xl font-extrabold tracking-tight text-white">
                        {{ $plan->name }}
                    </h3>

                    <!-- Description -->
                    <p class="h-20 my-3 text-sm leading-relaxed text-gray-400">
                        {{ $plan->description }}
                    </p>

                    <!-- Price -->
                    <div class="mt-20 mb-8">
                        <span class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">
                            ${{ $plan->price }}
                        </span>
                        <p class="mt-2 text-sm text-gray-400">
                            {{ $plan->duration_in_day }} days access
                        </p>
                    </div>

                    <!-- Badge -->
                <span
                    class="inline-block px-4 py-1 text-xs font-semibold text-green-400 rounded-full bg-green-400/10">
                    Popular Plan
                </span>
                </div>
            </div>
        @endforeach
    </div>


    

</x-app-layout>