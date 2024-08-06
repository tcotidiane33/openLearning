<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function process(Request $request, Course $course)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = Charge::create([
                'amount' => $course->price * 100, // Amount in cents
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => "Payment for course: {$course->title}",
            ]);

            // Enroll user in the course after successful payment
            auth()->user()->enrolledCourses()->attach($course);

            return redirect()->route('courses.show', $course)->with('success', 'Payment successful and enrolled in the course.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function success()
    {
        return view('payments.success');
    }

    public function cancel()
    {
        return view('payments.cancel');
    }

    public function webhook(Request $request)
    {
        // Handle Stripe webhook
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, config('services.stripe.webhook_secret')
            );
        } catch(\UnexpectedValueException $e) {
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                // Handle successful payment
                break;
            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response()->json(['success' => true]);
    }
}
