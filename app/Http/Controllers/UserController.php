<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function authentication(Request $request) 
    {
        // dd($request);
        $credentials = $request->validate([
            'username' => 'required',
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ]);

        if(auth()->attempt($credentials)){
            $request->session()->regenerate();

            // Redirect based on the user's role
            $user = auth()->user(); // Get the authenticated user

            if ($user->role === 'Employee') {
                return redirect()->route('customer.dashboard');

            } elseif ($user->role === 'Admin') {
                return redirect()->route('admin.dashboard');
            }

            // Redirect back to login with error message
            return redirect()->back()->with('error', 'Incorrect Username or Password!');
        }
    }
    
    public function storeEmployeeData(Request $request){
        // dd($request);

        $fields = $request->validate([
        'firstname' => 'required|max:50',
        'lastname' => 'required|max:50',
        'contact_number' => 'required|min:11|max:11|unique:users,contact_number',
        'role' => 'required',
        'username' => 'required|unique:users,username',
        'password' => [
            'required',
            'string',
            Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols(),
        ],
        'profile' => 'required|file|mimes:jpg,jpeg,png|max:5120'
    ]);

    // Hash Password
    $fields['password'] = Hash::make($fields['password']);

    if($request->hasFile('profile')){
            $fields['profile'] = Storage::disk('public')->put('profiles',$request->profile);

            // Store data to Users Table
            $user = User::create($fields);

            if($user){
                return redirect()->route('employee.addEmployee')->with('success', $fields['firstname'] . ' data stored successfully.');
            }else{
                return redirect()->back()->with('error','Failed to store the data.');
            }
        }
    }

    public function displayEmployee(){
        // Fetch all records who has role of employee
        $employees = User::where('role','Employee')->get();
        return inertia('Admin/Employee',['employees' => $employees]);
    }
}