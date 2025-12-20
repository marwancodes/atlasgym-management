<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-white">
                ➕ Create Subscription Plan
            </h2>

            <a href="{{ route('subscription-plans.index') }}"
               class="text-sm font-medium text-gray-300 hover:text-white">
                ← Back to Plans
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl px-6 py-10 mx-auto">

        <!-- Card -->
        <div class="relative overflow-hidden bg-gray-900 border border-gray-800 rounded-3xl
                    shadow-[0_25px_70px_rgba(0,0,0,0.7)]">


            <form method="POST" action="{{ route('subscription-plans.store') }}" class="p-8 space-y-8">
                @csrf

                <!-- Title -->
                <div>
                    <h3 class="text-2xl font-bold text-white">
                        Subscription Details
                    </h3>
                    <p class="mt-1 text-sm text-gray-400">
                        Define a new plan for your members.
                    </p>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-700 border-dashed"></div>

                <!-- Name -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">
                        Plan Name
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        placeholder="e.g. Monthly Pro"
                        class="w-full px-4 py-3 text-sm text-white bg-gray-800 border border-gray-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">

                    @error('name')
                        <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price + Duration -->
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-300">
                            Price ($)
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            name="price"
                            value="{{ old('price') }}"
                            required
                            placeholder="49.99"
                            class="w-full px-4 py-3 text-sm text-white bg-gray-800 border border-gray-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">

                        @error('price')
                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-300">
                            Duration (days)
                        </label>
                        <input
                            type="number"
                            name="duration_in_day"
                            value="{{ old('duration_in_day') }}"
                            required
                            placeholder="30"
                            class="w-full px-4 py-3 text-sm text-white bg-gray-800 border border-gray-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">

                        @error('duration_in_day')
                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">
                        Description
                    </label>
                    <textarea
                        name="description"
                        rows="4"
                        placeholder="Describe what this plan includes..."
                        class="w-full px-4 py-3 text-sm text-white bg-gray-800 border border-gray-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('description') }}</textarea>

                    @error('description')
                        <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-3 pt-4">
                    <a href="{{ route('subscription-plans.index') }}"
                       class="px-5 py-3 text-sm font-medium text-gray-300 transition border border-gray-700 rounded-xl hover:bg-gray-800">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="px-6 py-3 text-sm font-semibold text-black
                               bg-gradient-to-r from-green-400 to-emerald-500
                               rounded-xl shadow-lg
                               hover:shadow-green-500/30 hover:scale-[1.03]
                               transition">
                        Create Plan
                    </button>
                </div>

            </form>
        </div>

    </div>
</x-app-layout>
