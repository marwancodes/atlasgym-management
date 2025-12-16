<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\Trainer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Base query (Active by default)
        $query = Member::latest();

        // Archived
        if ($request->input('archived') === 'true') {
            $query->onlyTrashed();
        }

        $members = $query
            ->paginate(5)
            ->onEachSide(1);

        return view('member.index', compact('members'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trainers = Trainer::all();
        $plans = SubscriptionPlan::all();

        

        return view('member.create', compact('trainers', 'plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            /*
            |--------------------------------------------------------------------------
            | 1. Create Member
            |--------------------------------------------------------------------------
            */
            $member = Member::create([
                'userId'    => Auth::id(),
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'address'    => $request->address,
                'trainerId' => $request->trainerId,
                'join_date'  => $request->join_date,
                'status'     => $request->status,
            ]);

            /*
            |--------------------------------------------------------------------------
            | 2. Create Subscription
            |--------------------------------------------------------------------------
            */
            $plan = SubscriptionPlan::findOrFail($request->planId);

            $subscription = Subscription::create([
                'memberId'   => $member->id,
                'planId'     => $plan->id,
                'start_date' => $request->subscription_start_date,
                'end_date'   => Carbon::parse($request->subscription_start_date)
                                    ->addDays($plan->duration_in_days),
                'status'     => $request->subscription_status,
            ]);

            /*
            |--------------------------------------------------------------------------
            | 3. Create Payment
            |--------------------------------------------------------------------------
            */
            Payment::create([
                'memberId'       => $member->id,
                'subscriptionId' => $subscription->id,
                'amount'         => $request->payment_amount,
                'payment_method' => $request->payment_method,
                'payment_date'   => $request->payment_date,
                'status'         => $request->payment_status,
            ]);
        });

        return redirect()
            ->route('members.index')
            ->with('success', 'Member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $member = Member::findOrFail($id);

        return view('member.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $member = Member::with([
        'trainer',
        'subscriptions.plan',
        'payments'
    ])->findOrFail($id);

    $trainers = Trainer::all();
    $plans = SubscriptionPlan::all();

    // Get current or latest subscription
    $subscription = $member->subscriptions()
        ->latest('start_date')
        ->first();

    // Get latest payment
    $payment = $member->payments()
        ->latest('payment_date')
        ->first();

    return view('member.edit', compact(
        'member',
        'trainers',
        'plans',
        'subscription',
        'payment'
    ));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::transaction(function () use ($request, $id) {

            $member = Member::findOrFail($id);

            /*
            |--------------------------------------------------------------------------
            | 1. Update Member
            |--------------------------------------------------------------------------
            */
            $member->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'address'   => $request->address,
                'trainerId' => $request->trainerId,
                'join_date' => $request->join_date,
                'status'    => $request->status,
            ]);

            /*
            |--------------------------------------------------------------------------
            | 2. Update Subscription
            |--------------------------------------------------------------------------
            */
            $subscription = $member->subscriptions()
                ->latest('start_date')
                ->first();

            if ($subscription) {
                $plan = SubscriptionPlan::findOrFail($request->planId);

                $subscription->update([
                    'planId'     => $plan->id,
                    'start_date' => $request->subscription_start_date,
                    'end_date'   => Carbon::parse($request->subscription_start_date)
                                        ->addDays($plan->duration_in_days),
                    'status'     => $request->subscription_status,
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | 3. Update Payment (latest)
            |--------------------------------------------------------------------------
            */
            $payment = $member->payments()->latest()->first();

            if ($payment) {
                $payment->update([
                    'amount'         => $request->payment_amount,
                    'payment_method' => $request->payment_method,
                    'payment_date'   => $request->payment_date,
                    'status'         => $request->payment_status,
                ]);
            }
        });

        return redirect()
            ->route('members.index')
            ->with('success', 'Member updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::transaction(function () use ($id) {

            $member = Member::findOrFail($id);

            /*
            |--------------------------------------------------------------------------
            | Soft delete related data FIRST (optional but recommended)
            |--------------------------------------------------------------------------
            */

            // Soft delete subscriptions
            $member->subscriptions()->delete();

            // Soft delete payments
            $member->payments()->delete();

            // Soft delete attendance
            $member->attendance()->delete();

            /*
            |--------------------------------------------------------------------------
            | Soft delete member
            |--------------------------------------------------------------------------
            */
            $member->delete();
        });

        return redirect()
            ->route('members.index')
            ->with('success', 'Member archived successfully.');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id)
    {
        DB::transaction(function () use ($id) {

            $member = Member::withTrashed()->findOrFail($id);

            /*
            |--------------------------------------------------------------------------
            | Restore related data FIRST
            |--------------------------------------------------------------------------
            */

            // Restore subscriptions
            $member->subscriptions()->withTrashed()->restore();

            // Restore payments
            $member->payments()->withTrashed()->restore();

            // Restore attendance
            $member->attendance()->withTrashed()->restore();

            /*
            |--------------------------------------------------------------------------
            | Restore member
            |--------------------------------------------------------------------------
            */
            $member->restore();
        });

        return redirect()
            ->route('members.index', ['archived' => 'true'])
            ->with('success', 'Member restored successfully.');
    }

}
