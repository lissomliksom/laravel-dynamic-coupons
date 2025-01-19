<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class CouponController extends Controller
{
    /**
 * Get the validation rules that apply to the request.
 *
 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
 */
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('coupons.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    // Note: This is a lot of logic for a controller. Would it be better to move it to a service?
    // Note: Maybe code should be grouped into smaller methods for readability and maintainability.
    // Note: Maybe code should be organized into a more structured way, like a switch statement.
    // Note: Maybe code should be divided into: 1) checks, 2) messages, 3) return views.
    public function store(Request $request): View
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $email = $validated['email'];

        // Get users and subscriptions from JSON files, format them as arrays
        $users = json_decode(file_get_contents(database_path('users.json')), true);
        $subscriptions = json_decode(file_get_contents(database_path('subscriptions.json')), true);

         // Find user by email
         $user = collect($users)->firstWhere('email', $email);

         // Case: New user. Offer a welcome discount for subscription.
         if (!$user) {
             return view('coupons.store', [
                 'email' => $email,
                 'message' => 'Du er for øyeblikket ikke abonnent av Avisen. Dersom du ønsker å bli abonnement får du 80% rabatt de første 8 ukene.'
             ]);
         }
 
         // Find subscriptions by user_id
         $userSubscriptions = collect($subscriptions)->where('user_id', $user['user_id']);

         // Get current date. Used for comparison with subscription dates.
         $currentDate = now();
 
         // Case: New subscriber. Offer a welcome discount.
         if ($userSubscriptions->isEmpty()) {
             return view('coupons.store', [
                 'email' => $email,
                 'message' => 'Du er for øyeblikket ikke abonnent av Avisen. Dersom du ønsker å bli abonnement får du 80% rabatt de første 8 ukene.'
             ]);
         }

         // Check for active subscription.
         $hasActiveSubscription = $userSubscriptions->contains(function ($subscription) use ($currentDate) {
            return $currentDate->between($subscription['subscription_start_date'], $subscription['subscription_end_date'] ?? $currentDate);
        });

        // Case: Active subscriber.
        if ($hasActiveSubscription) {
            $hasFutureEnd = $userSubscriptions->contains(function ($subscription) use ($currentDate) {
                return $subscription['subscription_end_date'] && $subscription['subscription_end_date'] > $currentDate;
            });

            // Case: Active subscriber with subscription end date. Offer an incentive to renew subscription.
            if ($hasFutureEnd) {
                return view('coupons.store', [
                    'email' => $email,
                    'message' => 'Du er allerede abonnent og har tilgang til Avisen frem til (end date). Dersom du fornøyer abonnementet ditt får du 10% rabatt på neste periode.'
                ]);
            }

            // Case: Active subscriber with no end date.
            return view('coupons.store', [
                'email' => $email,
                'message' => 'Du er allerede abonnent og har tilgang til Avisen. God lesning!'
            ]);
        }

        // Check for frequent discount usage.
        $frequentDiscounts = $userSubscriptions->where('discount_used', true)->count() > 2;

        // Case: Frequent discount user. Offer a full price subscription.
        if ($frequentDiscounts) {
            return view('coupons.store', [
                'email' => $email,
                'message' => 'Bli abonnement av Avisen for (helt vanlig pris).'
            ]);
        }

        // Check for past (but not active) subscription.
        $hasPastSubscription = $userSubscriptions->contains(function ($subscription) use ($currentDate) {
            return $subscription['subscription_end_date'] && $subscription['subscription_end_date'] < $currentDate;
        });

        // Case: Past subscriber. Offer a discount to come back.
        if ($hasPastSubscription) {
            return view('coupons.store', [
                'email' => $email,
                'message' => 'Du har tidligere vært abonnement av Avisen. Få 20% de første 2 månedene for å komme tilbake.'
            ]);
        }

        // Case: Default / fallback.
        return view('coupons.store', [
            'email' => $email,
            'message' => 'Bli abonnement av Avisen for (helt vanlig pris).'
        ]);
    }
}
