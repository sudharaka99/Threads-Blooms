<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        return view('admin.newsletter.index', ['subscribers' => NewsletterSubscriber::latest()->get()]);
    }

    public function destroy(NewsletterSubscriber $subscriber)
    {
        $subscriber->delete();
        return redirect()->back();
    }

    public function send(Request $request)
    {
        return redirect()->back();
    }
}
