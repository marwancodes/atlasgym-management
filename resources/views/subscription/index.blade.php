<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            Subscriptions
        </h2>
    </x-slot>
    
    <div class="px-6 py-6 mx-auto max-w-7xl">

        {{-- Success message --}}
        {{-- <x-toast-notification /> --}}

        @if($subscriptions->isEmpty())
            <div class="p-6 text-center text-gray-500 bg-white border shadow rounded-xl">
                No subscriptions found.
            </div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($subscriptions as $subscription)
                    <div class="w-full max-w-md p-8 bg-gray-900/80 backdrop-blur
                    border border-gray-700 rounded-2xl shadow-[0_20px_60px_rgba(0,0,0,0.6)]">

                        <!-- Member -->
                        <div class="mb-4">
                            <a href="{{ route('members.show', $subscription->memberId) }}" class="text-lg font-semibold text-gray-400 hover:text-indigo-500">
                                {{ $subscription->member?->name ?? 'Unknown Member' }}
                            </a>
                            <p class="text-sm text-gray-500">
                                {{ $subscription->member?->email }}
                            </p>
                        </div>

                        <!-- Plan -->
                        <div class="mb-3">
                            <span class="text-sm font-medium text-gray-500">Plan</span>
                            <p class="font-semibold text-gray-900">
                                {{ $subscription->plan?->name ?? '—' }}
                            </p>
                        </div>

                        <!-- Dates -->
                        <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                            <div>
                                <span class="text-gray-500">Start</span>
                                <p class="font-medium text-gray-300">
                                    {{ $subscription->start_date?->format('d M Y') }}
                                </p>
                            </div>

                            <div>
                                <span class="text-gray-500">End</span>
                                <p class="font-medium text-gray-300">
                                    {{ $subscription->end_date?->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                {{ $subscription->status === 'active'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($subscription->status) }}
                            </span>
                        </div>

                        <!-- Payments -->
                        <div class="pt-4 border-t border-gray-100">
                            <p class="mb-2 text-sm font-medium text-gray-500">
                                Payments
                            </p>

                            @forelse ($subscription->payments as $payment)
                                <div class="flex justify-between mb-1 text-sm">
                                    <span class="text-gray-300">
                                        £{{ number_format($payment->amount, 2) }}
                                    </span>

                                    <span
                                        class="font-medium
                                        {{ $payment->status === 'paid'
                                            ? 'text-green-600'
                                            : 'text-yellow-600' }}">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-sm text-gray-400">
                                    No payments recorded
                                </p>
                            @endforelse
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>