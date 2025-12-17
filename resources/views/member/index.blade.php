<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            Members {{ request()->input('archived') == 'true' ? '(Archived)' : '' }}
        </h2>
    </x-slot>
    
    <div class="mx-6 mt-6">

        
        <div class="flex items-center justify-between w-full gap-3 mb-4 md:w-auto">
            <div>
                {{-- Archived / Active Toggle --}}
                @if (request()->has('archived') && request()->input('archived') == 'true')
                    <a href="{{ route('members.index') }}"
                        class="inline-flex items-center px-5 py-3 text-sm font-semibold text-white
                                bg-blue-600 rounded-xl
                                shadow-[0_8px_30px_rgba(59,130,246,0.35)]
                                hover:bg-blue-700
                                transition-all duration-200">
                        Active Members
                    </a>
                @else
                    <a href="{{ route('members.index', ['archived' => 'true']) }}"
                        class="inline-flex items-center px-5 py-3 text-sm font-semibold text-white
                                bg-red-600 rounded-xl
                                shadow-[0_8px_30px_rgba(239,68,68,0.35)]
                                hover:bg-red-700
                                transition-all duration-200">
                        Archived Members
                    </a>
                @endif
            </div>

            <div class="flex gap-2">
                {{-- Search --}}
                <form action="{{ route('members.index') }}" method="GET" class="flex w-full md:w-auto">
                    <input type="text" name="search" placeholder="Search members..."
                           value="{{ request('search') }}"
                           class="w-full px-4 py-2 border border-gray-300 shadow-sm text-neutral-500 rounded-l-xl">
    
                    <button type="submit"
                            class="px-4 py-2 text-white bg-neutral-600 rounded-r-xl hover:bg-neutral-700">
                        Search
                    </button>
                </form>
    
                {{-- Add Member --}}
                <a href="{{ route('members.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-3 text-sm font-semibold text-white
                            bg-green-600 rounded-xl
                            shadow-[0_8px_30px_rgba(34,197,94,0.35)]
                            hover:bg-green-700 hover:-translate-y-0.5
                            transition-all duration-200">
                    <!-- Plus Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 4v16m8-8H4" />
                    </svg>

                    Add New Member
                </a>

            </div>
        </div>

        <div class="overflow-x-auto border shadow-md border-neutral-700 bg-neutral-800 rounded-xl">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="text-gray-400 border-b bg-neutral-900">
                    <tr>
                        <th class="px-6 py-3 font-semibold">Member</th>
                        <th class="px-6 py-3 font-semibold">Contact</th>
                        <th class="px-6 py-3 font-semibold">Address</th>
                        <th class="px-6 py-3 font-semibold">Status</th>
                        <th class="px-6 py-3 font-semibold">Trainer</th>
                        <th class="px-6 py-3 font-semibold">Joined</th>
                        <th class="px-6 py-3 font-semibold text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-neutral-700">
                    @forelse ($members as $member)
                        <tr class="hover:bg-neutral-600/20">

                            {{-- Member --}}
                            <td class="px-6 py-4">
                                @if (request()->input('archived') == 'true')
                                    <div class="font-medium text-white">
                                        {{ $member->name }}
                                    </div>
                                    <div class="text-xs text-gray-500">{{ $member->email }}</div>
                                @else
                                    <a href="{{ route('members.show', $member->id) }}">
                                        <div class="font-medium text-white hover:text-blue-500">
                                            {{ $member->name }}
                                        </div>
                                        <div class="text-xs text-gray-500">{{ $member->email }}</div>
                                    </a>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-white">{{ $member->phone ?? '—' }}</td>
                            <td class="px-6 py-4 text-white">{{ $member->address ?? '—' }}</td>

                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $member->status === 'active'
                                        ? 'bg-green-100 text-green-600'
                                        : 'bg-red-100 text-red-600' }}">
                                    {{ ucfirst($member->status) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-white">{{ $member->trainer?->name ?? 'Not Assigned' }}</td>
                            <td class="px-6 py-4 text-white">{{ optional($member->created_at)->format('d M Y') }}</td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 space-x-3 text-right">

                                @if (request()->has('archived') && request()->input('archived') == 'true')
                                    {{-- Restore --}}
                                    <form action="{{ route('members.restore', $member->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                                onclick="return confirm('Restore this member?')"
                                                class="font-medium text-green-600 hover:underline">
                                            Restore
                                        </button>
                                    </form>
                                @else
                                    {{-- Edit --}}
                                    <a href="{{ route('members.edit', $member->id) }}"
                                       class="font-medium text-blue-500 hover:underline">
                                        Edit
                                    </a>

                                    {{-- Archive --}}
                                    <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Archive this member?')"
                                                class="font-medium text-red-600 hover:underline">
                                            Archive
                                        </button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                No members found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex justify-center mt-6">
            {{ $members->links('pagination::tailwind') }}
        </div>

    </div>
</x-app-layout>
