<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AddressController extends Controller
{

    public function store(Request $request) : RedirectResponse
    {
        $request->validateWithBag('createAddress', [
            'title' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:18'],
            'address' => ['required'],
        ]);

        Address::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'telephone' => $request->telephone,
            'address' => $request->address,
        ]);

        return Redirect::route('profile.edit')->with('status', 'address-created');
    }

    public function update(Request $request) : RedirectResponse
    {
        $validated = $request->validateWithBag('updateAddress', [
            'title' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:18'],
            'address' => ['required'],
        ]);

        $address = Address::where('user_id', $request->user()->id)->first();
        $address->fill($validated);
        $address->save();
        return Redirect::route('profile.edit')->with('status', 'address-updated');
    }
}
