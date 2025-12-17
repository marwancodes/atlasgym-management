<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-white">Edit Member</h2>
    </x-slot>

    <div class="max-w-6xl p-6 mx-auto">
        <form action="{{ route('members.update', $member->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- ================= Personal Information ================= -->
            <div class="p-6 bg-[#222222] border border-zinc-700 shadow-md rounded-xl">
                <h3 class="mb-6 text-lg font-semibold text-white">Personal Information</h3>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-zinc-400">Name</label>
                        <input type="text" name="name"
                               value="{{ old('name', $member->name) }}"
                               required
                               class="w-full px-4 py-2 transition border rounded-lg shadow-sm border-zinc-700 focus:ring-indigo-500 focus:border-indigo-500 bg-zinc-800 text-zinc-500">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-zinc-400">Email</label>
                        <input type="email" name="email"
                               value="{{ old('email', $member->email) }}"
                               required
                               class="w-full px-4 py-2 transition border rounded-lg shadow-sm border-zinc-700 focus:ring-indigo-500 focus:border-indigo-500 bg-zinc-800 text-zinc-500">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-zinc-400">Phone</label>
                        <input type="text" name="phone"
                               value="{{ old('phone', $member->phone) }}"
                               class="w-full px-4 py-2 transition border rounded-lg shadow-sm border-zinc-700 focus:ring-indigo-500 focus:border-indigo-500 bg-zinc-800 text-zinc-500">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-zinc-400">Address</label>
                        <input type="text" name="address"
                               value="{{ old('address', $member->address) }}"
                               class="w-full px-4 py-2 transition border rounded-lg shadow-sm border-zinc-700 focus:ring-indigo-500 focus:border-indigo-500 bg-zinc-800 text-zinc-500">
                    </div>
                </div>
            </div>

            <!-- ================= Membership Details ================= -->
            <div class="p-6 bg-[#222222] border border-zinc-700 shadow-md rounded-xl">
                <h3 class="mb-6 text-lg font-semibold text-white">Membership Details</h3>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-zinc-400">Trainer</label>
                        <select name="trainerId" required
                                class="w-full px-4 py-2 transition border rounded-lg shadow-sm border-zinc-700 focus:ring-indigo-500 focus:border-indigo-500 bg-zinc-800 text-zinc-500">
                            @foreach($trainers as $trainer)
                                <option value="{{ $trainer->id }}"
                                    @selected($trainer->id === $member->trainerId)>
                                    {{ $trainer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-zinc-400">Join Date</label>
                        <input type="date" name="join_date"
                               value="{{ $member->join_date?->toDateString() }}"
                               required
                               class="w-full px-4 py-2 transition border rounded-lg shadow-sm border-zinc-700 focus:ring-indigo-500 focus:border-indigo-500 bg-zinc-800 text-zinc-500">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-zinc-400">Status</label>
                        <select name="status" required
                                class="w-full px-4 py-2 transition border rounded-lg shadow-sm border-zinc-700 focus:ring-indigo-500 focus:border-indigo-500 bg-zinc-800 text-zinc-500">
                            <option value="active" @selected($member->status === 'active')>Active</option>
                            <option value="inactive" @selected($member->status === 'inactive')>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- ================= Subscription ================= -->
            <div class="p-6 bg-[#222222] border border-zinc-700 shadow-md rounded-xl">
                <h3 class="mb-6 text-lg font-semibold text-white">Subscription</h3>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-zinc-400">Plan</label>
                        <select name="planId" required
                                class="w-full px-4 py-2 transition border rounded-lg shadow-sm border-zinc-700 focus:ring-indigo-500 focus:border-indigo-500 bg-zinc-800 text-zinc-500">
                            @foreach($plans as $plan)
                                <option value="{{ $plan->id }}"
                                    @selected($subscription->planId === $plan->id)>
                                    {{ $plan->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-zinc-400">Start Date</label>
                        <input type="date" name="subscription_start_date"
                               value="{{ $subscription->start_date?->toDateString() }}"
                               required
                               class="w-full px-4 py-2 transition border rounded-lg shadow-sm border-zinc-700 focus:ring-indigo-500 focus:border-indigo-500 bg-zinc-800 text-zinc-500">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-zinc-400">Subscription Status</label>
                        <select name="subscription_status" required
                                class="w-full px-4 py-2 transition border rounded-lg shadow-sm border-zinc-700 focus:ring-indigo-500 focus:border-indigo-500 bg-zinc-800 text-zinc-500">
                            <option value="active" @selected($subscription->status === 'active')>Active</option>
                            <option value="expired" @selected($subscription->status === 'expired')>Expired</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- ================= Payment ================= -->
            <div class="p-6 bg-[#222222] border border-zinc-700 shadow-md rounded-xl">
                <h3 class="mb-6 text-lg font-semibold text-white">Payment</h3>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-zinc-400">Amount</label>
                        <input type="number" step="0.01" name="payment_amount"
                               value="{{ $payment?->amount }}"
                               required
                               class="w-full px-4 py-2 transition border rounded-lg shadow-sm border-zinc-700 focus:ring-indigo-500 focus:border-indigo-500 bg-zinc-800 text-zinc-500">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-zinc-400">Payment Method</label>
                        <select name="payment_method" required
                                class="w-full px-4 py-2 transition border rounded-lg shadow-sm border-zinc-700 focus:ring-indigo-500 focus:border-indigo- bg-zinc-800 text-zinc-500">
                            <option value="cash" @selected($payment?->payment_method === 'cash')>Cash</option>
                            <option value="card" @selected($payment?->payment_method === 'card')>Card</option>
                            <option value="bank_transfer" @selected($payment?->payment_method === 'bank_transfer')>
                                Bank Transfer
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-zinc-400">Payment Date</label>
                        <input type="date" name="payment_date"
                               value="{{ $payment?->payment_date?->toDateString() }}"
                               required
                               class="w-full px-4 py-2 transition border rounded-lg shadow-sm border-zinc-700 focus:ring-indigo-500 focus:border-indigo-500 bg-zinc-800 text-zinc-500">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-zinc-400">Payment Status</label>
                        <select name="payment_status" required
                                class="w-full px-4 py-2 transition border rounded-lg shadow-sm border-zinc-700 focus:ring-indigo-500 focus:border-indigo-500 bg-zinc-800 text-zinc-500">
                            <option value="paid" @selected($payment?->status === 'paid')>Paid</option>
                            <option value="pending" @selected($payment?->status === 'pending')>Pending</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- ================= Actions ================= -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('members.index') }}"
                   class="px-5 py-2 text-sm font-medium transition border rounded-lg text-zinc-900 border-zinc-700 hover:bg-zinc-600 bg-zinc-700">
                    Cancel
                </a>

                <button type="submit"
                        class="px-5 py-2 text-sm font-medium text-white transition bg-blue-600 rounded-lg hover:bg-blue-700"> Update Member
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

