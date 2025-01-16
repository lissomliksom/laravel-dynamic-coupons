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
    public function store(Request $request): View
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);
        return view('coupons.store')->with('email', $validated['email']);
    }
}
