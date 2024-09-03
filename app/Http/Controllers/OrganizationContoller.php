<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Organization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrganizationContoller extends Controller
{

    public function index()
    {
        $organizations = Organization::all();
        return view('organization.index', compact('organizations'));
    }

    public function store(Request $request) : RedirectResponse
    {
        $request->validateWithBag('createOrganization', [
            'title' => ['required', 'string', 'max:255'],
            'inn' => ['required', 'integer', 'min:10'],
        ]);

        $address = Address::where('user_id', $request->user()->id)->first();

        Organization::create([
            'address_id' => $address->id,
            'title' => $request->title,
            'inn' => $request->inn,
        ]);

        return Redirect::route('profile.edit')->with('status', 'organization-created');
    }

    public function update(Request $request) : RedirectResponse
    {
        $validated = $request->validateWithBag('updateOrganization', [
            'title' => ['required', 'string', 'max:255'],
            'inn' => ['required', 'integer', 'min:10'],
        ]);

        $address = Address::where('user_id', $request->user()->id)->first();
        $organization = Organization::where('address_id', $address->id)->first();
        $organization->fill($validated);
        $organization->save();
        return Redirect::route('profile.edit')->with('status', 'organization-updated');
    }
}
