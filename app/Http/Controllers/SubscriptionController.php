<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Subscription as StripeSubscription;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plans = Subscription::all();
        return view('subscriptions.index', compact('plans'));
    }

    public function subscribe(Request $request, Subscription $plan)
    {
        $user = auth()->user();

        if ($user->subscribed('default')) {
            return redirect()->back()->with('error', 'You are already subscribed to a plan.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $user->newSubscription('default', $plan->stripe_plan)
                ->create($request->stripeToken);

            return redirect()->route('dashboard')->with('success', 'Subscription successful!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function cancel()
    {
        $user = auth()->user();

        if (!$user->subscribed('default')) {
            return redirect()->back()->with('error', 'You are not subscribed to any plan.');
        }

        $user->subscription('default')->cancel();

        return redirect()->route('dashboard')->with('success', 'Your subscription has been cancelled.');
    }

    public function resume()
    {
        $user = auth()->user();

        if (!$user->subscription('default')->onGracePeriod()) {
            return redirect()->back()->with('error', 'You do not have a cancelled subscription to resume.');
        }

        $user->subscription('default')->resume();

        return redirect()->route('dashboard')->with('success', 'Your subscription has been resumed.');
    }
}
