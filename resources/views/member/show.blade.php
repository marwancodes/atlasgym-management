<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-white">Member Details</h2>
            <a href="{{ route('members.index') }}"
               class="text-sm font-medium text-white transition hover:text-blue-600">
                ← Back to Members
            </a>
        </div>
    </x-slot>

    <div class="max-w-6xl p-6 mx-auto space-y-8">

        <!-- Member Overview -->
        <div class="p-6 border border-zinc-700 shadow-md bg-[#222222] rounded-xl">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">{{ $member->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $member->email }}</p>
                </div>

                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    {{ $member->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ ucfirst($member->status) }}
                </span>
            </div>
        </div>

        <!-- Details Grid -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

            <!-- Personal Info -->
            <div class="p-6 bg-[#222222] border border-zinc-700 shadow-md rounded-xl">
                <h4 class="mb-4 text-lg font-semibold text-white">Personal Information</h4>

                <dl class="space-y-4 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Phone</dt>
                        <dd class="font-medium text-white">{{ $member->phone ?? '—' }}</dd>
                    </div>

                    <div class="flex justify-between">
                        <dt class="text-gray-500">Address</dt>
                        <dd class="max-w-xs font-medium text-right text-white">{{ $member->address ?? '—' }}</dd>
                    </div>

                    <div class="flex justify-between">
                        <dt class="text-gray-500">Join Date</dt>
                        <dd class="font-medium text-white">{{ optional($member->created_at)->format('d M Y') ?? '—' }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Trainer Info -->
            <div class="p-6 bg-[#222222] border border-zinc-700 shadow-md rounded-xl">
                <h4 class="mb-4 text-lg font-semibold text-white">Trainer</h4>

                @if ($member->trainer)
                    <div class="space-y-2 text-sm">
                        <p class="font-medium text-white">{{ $member->trainer->name }}</p>
                        <p class="text-gray-500">{{ $member->trainer->email }}</p>
                        <p class="text-gray-500">Specialization: {{ $member->trainer->specialisation ?? '—' }}</p>
                    </div>
                @else
                    <p class="text-sm text-gray-500">No trainer assigned.</p>
                @endif
            </div>
        </div>

        <!-- Subscriptions -->
        <div class="p-6 bg-[#222222] border border-zinc-700 shadow-md rounded-xl">
            <h4 class="mb-4 text-lg font-semibold text-white">Subscriptions</h4>

            @if ($member->subscriptions->count())
                <div class="overflow-x-auto">
                    <table class="w-full text-sm border-collapse">
                        <thead class="text-gray-600 border-b border-gray-300">
                            <tr>
                                <th class="py-3 text-left">Plan</th>
                                <th class="py-3 text-left">Start</th>
                                <th class="py-3 text-left">End</th>
                                <th class="py-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($member->subscriptions as $subscription)
                                <tr class="transition hover:bg-zinc-700">
                                    <td class="py-2 font-medium text-white">{{ $subscription->plan->name }}</td>
                                    <td class="py-2 text-white">{{ $subscription->start_date->format('d M Y') }}</td>
                                    <td class="py-2 text-white">{{ $subscription->end_date->format('d M Y') }}</td>
                                    <td class="py-2">
                                        <span
                                            class="px-2 py-1 rounded-full text-xs font-medium
                                            {{ $subscription->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                            {{ ucfirst($subscription->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-sm text-gray-500">No subscriptions found.</p>
            @endif
        </div>

        <!-- Actions -->
        <div class="flex flex-wrap justify-end gap-3">
            <a href="{{ route('members.edit', $member->id) }}"
               class="px-5 py-2 text-sm font-medium text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">
                Edit Member
            </a>

            {{-- Archive --}}
            <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                    onclick="return confirm('Archive this member?')"
                    class="px-5 py-2 text-sm font-medium text-white transition bg-red-600 border rounded-lg hover:bg-red-700">
                    Archive
                </button>
            </form>
        </div>

    </div>
</x-app-layout>
