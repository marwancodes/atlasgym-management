<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900">Create Member</h2>
    </x-slot>

    <div class="max-w-6xl p-6 mx-auto">
        <form action="{{ route('members.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- ================= Personal Information ================= -->
            <div class="p-6 bg-white border border-gray-200 shadow-md rounded-xl">
                <h3 class="mb-6 text-lg font-semibold text-gray-800">Personal Information</h3>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               placeholder="John Doe"
                               class="w-full px-4 py-2 transition border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               required>
                        @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               placeholder="john@example.com"
                               class="w-full px-4 py-2 transition border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               required>
                        @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               placeholder="+44 123 456 789"
                               class="w-full px-4 py-2 transition border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Address</label>
                        <input type="text" name="address" value="{{ old('address') }}"
                               placeholder="123 Street, City"
                               class="w-full px-4 py-2 transition border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
            </div>

            <!-- ================= Membership Details ================= -->
            <div class="p-6 bg-white border border-gray-200 shadow-md rounded-xl">
                <h3 class="mb-6 text-lg font-semibold text-gray-800">Membership Details</h3>

                <div class="grid gap-4 md:grid-cols-2">
                    <select name="trainerId" required
                            class="w-full px-4 py-2 transition border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">— Select Trainer —</option>
                        @foreach($trainers as $trainer)
                            <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                        @endforeach
                    </select>

                    <input type="date" name="join_date" required
                           class="w-full px-4 py-2 transition border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />

                    <select name="status" required
                            class="w-full px-4 py-2 transition border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <!-- ================= Subscription ================= -->
            <div class="p-6 bg-white border border-gray-200 shadow-md rounded-xl">
                <h3 class="mb-6 text-lg font-semibold text-gray-800">Subscription</h3>

                <div class="grid gap-4 md:grid-cols-2">
                    <select name="planId" required
                            class="w-full px-4 py-2 transition border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">— Select Plan —</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->name }} ({{ $plan->duration_in_day }} hours)</option>
                        @endforeach
                    </select>

                    <input type="date" name="subscription_start_date" required
                           class="w-full px-4 py-2 transition border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />

                    <select name="subscription_status" required
                            class="w-full px-4 py-2 transition border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="active">Active</option>
                        <option value="expired">Expired</option>
                    </select>
                </div>
            </div>

            <!-- ================= Payment ================= -->
            <div class="p-6 bg-white border border-gray-200 shadow-md rounded-xl">
                <h3 class="mb-6 text-lg font-semibold text-gray-800">Payment</h3>

                <div class="grid gap-4 md:grid-cols-2">
                    <input type="number" step="0.01" name="payment_amount" required
                           placeholder="Amount (£)"
                           class="w-full px-4 py-2 transition border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />

                    <select name="payment_method" required
                            class="w-full px-4 py-2 transition border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="cash">Cash</option>
                        <option value="card">Card</option>
                        <option value="bank_transfer">Bank Transfer</option>
                    </select>

                    <input type="date" name="payment_date" required
                           class="w-full px-4 py-2 transition border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ now()->toDateString() }}" />

                    <select name="payment_status" required
                            class="w-full px-4 py-2 transition border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="paid">Paid</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>

            <!-- ================= Actions ================= -->
            <div class="flex flex-wrap justify-end gap-3">
                <a href="{{ route('members.index') }}"
                   class="px-5 py-2 text-sm font-medium text-gray-700 transition border border-gray-300 rounded-lg hover:bg-gray-50">
                    Cancel
                </a>

                <button type="submit"
                        class="px-5 py-2 text-sm font-medium text-white transition bg-indigo-600 rounded-lg hover:bg-indigo-700">
                    Create Member
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
