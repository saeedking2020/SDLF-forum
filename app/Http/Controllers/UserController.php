<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users',
            'terms' => 'required'
        ], [
            // Optional: Custom error messages
            'terms.required' => 'You must accept the terms and conditions.',
            'name.min' => 'Your name must be at least :min characters long.',
        ]);

        // 2. Check if validation fails
        if ($validator->fails()) {
            // 3. If validation fails, trigger the toaster error message
            toastr()->error('Could not update. Please check the form for errors.');
        } else {
            $user = User::find($id);
            $user->update($request->all());
            toastr()->success('Your details have been updated successfully');
        }

        return redirect()->back()->withErrors($validator); // This flashes the errors to the session;
    }
}
