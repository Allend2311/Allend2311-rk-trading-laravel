<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::active()->take(6)->get();
        return view('home', compact('featuredProducts'));
    }

    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // For now, just flash a success message
        // In a real application, you would send an email or save to database
        // Mail::to('info@rktrading.com')->send(new ContactMail($request->all()));

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
