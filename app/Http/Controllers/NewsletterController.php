<?php
// app/Http/Controllers/NewsletterController.php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ]);

        NewsletterSubscriber::create([
            'email' => $request->email,
            'is_active' => true,
            'token' => Str::random(60),
        ]);

        return back()->with('success', 'You have been subscribed to our newsletter!');
    }

    public function unsubscribe($token)
    {
        $subscriber = NewsletterSubscriber::where('token', $token)->first();

        if ($subscriber) {
            $subscriber->update([
                'is_active' => false,
                'unsubscribed_at' => now(),
            ]);
            return redirect()->route('home')->with('success', 'You have been unsubscribed.');
        }

        return redirect()->route('home')->with('error', 'Invalid token.');
    }
}