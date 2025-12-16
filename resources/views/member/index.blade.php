<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Members {{ request()->input('archived') == 'true' ? '(Archived)' : '' }}
        </h2>
    </x-slot>
    
    <div class="mx-6 mt-6">

        
        <div class="flex items-center justify-between w-full gap-3 mb-4 md:w-auto">
            <div>
                {{-- Archived / Active Toggle --}}
                @if (request()->has('archived') && request()->input('archived') == 'true')
                    <a href="{{ route('members.index') }}" 
                       class="px-4 py-3 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700">
                        Active Members
                    </a>
                @else
                    <a href="{{ route('members.index', ['archived' => 'true']) }}" 
                       class="px-4 py-3 text-sm font-medium text-white bg-gray-600 rounded-xl hover:bg-gray-700">
                        Archived Members
                    </a>
                @endif
            </div>

            <div class="flex gap-2">
                {{-- Search --}}
                <form action="{{ route('members.index') }}" method="GET" class="flex w-full md:w-auto">
                    <input type="text" name="search" placeholder="Search members..."
                           value="{{ request('search') }}"
                           class="w-full px-4 py-2 border border-gray-300 shadow-sm rounded-l-xl">
    
                    <button type="submit"
                            class="px-4 py-2 text-white bg-gray-600 rounded-r-xl hover:bg-gray-700">
                        Search
                    </button>
                </form>
    
                {{-- Add Member --}}
                <a href="{{ route('members.create') }}"
                   class="px-4 py-3 text-sm font-medium text-white bg-green-600 rounded-xl hover:bg-green-700">
                    Add New Member
                </a>
            </div>
        </div>

        <div class="overflow-x-auto bg-white border border-gray-200 shadow-md rounded-xl">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="border-b bg-gray-50">
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

                <tbody class="divide-y">
                    @forelse ($members as $member)
                        <tr class="hover:bg-gray-50">

                            {{-- Member --}}
                            <td class="px-6 py-4">
                                @if (request()->input('archived') == 'true')
                                    <div class="font-medium text-gray-900">
                                        {{ $member->name }}
                                    </div>
                                    <div class="text-xs text-gray-500">{{ $member->email }}</div>
                                @else
                                    <a href="{{ route('members.show', $member->id) }}">
                                        <div class="font-medium text-gray-900 hover:text-indigo-600">
                                            {{ $member->name }}
                                        </div>
                                        <div class="text-xs text-gray-500">{{ $member->email }}</div>
                                    </a>
                                @endif
                            </td>

                            <td class="px-6 py-4">{{ $member->phone ?? '—' }}</td>
                            <td class="px-6 py-4">{{ $member->address ?? '—' }}</td>

                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $member->status === 'active'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($member->status) }}
                                </span>
                            </td>

                            <td class="px-6 py-4">{{ $member->trainer?->name ?? 'Not Assigned' }}</td>
                            <td class="px-6 py-4">{{ optional($member->created_at)->format('d M Y') }}</td>

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
                                       class="font-medium text-indigo-600 hover:underline">
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

        <div class="mt-4">
            {{ $members->links() }}
        </div>
    </div>
</x-app-layout>
