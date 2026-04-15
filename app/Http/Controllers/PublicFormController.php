<?php

namespace App\Http\Controllers;

use App\Models\ResellerApplication;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class PublicFormController extends Controller
{
    public function storeResellerApplication(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'territory' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        ResellerApplication::create($request->all());

        return back()->with('success', 'YOUR APPLICATION HAS BEEN DISPATCHED TO OUR CHANNEL MANAGEMENT TEAM.');
    }

    public function storeContactMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($request->all());

        return back()->with('success', 'MESSAGE DISPATCHED. OUR TECHNICAL TEAM WILL CORRESPOND SHORTLY.');
    }
}