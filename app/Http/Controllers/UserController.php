<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        }else{
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

    public function viewEmployeeProfile($user_id) {
        $employee_profile = User::find($user_id);

        return inertia('Admin/Employee_Features/ViewProfile', [
            'user_info' => $employee_profile
        ]);
    }

    public function updateUserInfo(Request $request){
        // dd($request);
        // Check if their's a same record of updated contact number
        $existingContacts = User::where('contact_number',$request->contact_number)->first();

        // Check if the existing record id is the same with parameter id
        if($existingContacts->id == $request->id){
            $field = $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'contact_number' => 'required|min:11|max:11',
                'username' => 'required',
            ]);
        }else{
            $field = $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'contact_number' => 'required|min:11|max:11|unique:users,contact_number',
                'username' => 'required',
            ]);
        }

        if($field){
            $data = User::where('id',$request->id)->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'contact_number' => $request->contact_number,
                'username' => $request->username,
            ]);

            if($data){
                return redirect()->route('employee.viewProfile',['user_id' => $request->id])
                ->with('success',$field['firstname' ] . ' information update successfully.');
            }else{
                return redirect()->back()-with('error','User info failed to update.');
            }
        }
        
    }

    public function updatePassword(Request $request){
        // dd($request);
        $fields = $request->validate([
            'new_password' => [
            'required',
            'string',
            Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols(),
        ],
        'confirm_password' => [
            'required',
            'string',
            Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols(),
        ],
        ]);

        if($fields['new_password'] === $fields['confirm_password']){
            $fields['new_password'] = Hash::make($fields['new_password']);

            $user = User::where('id',$request->id)->update([
                'password' =>  $fields['new_password'],
            ]);

            if($user){
                return redirect()->route('employee.viewProfile',['user_id' => $request->id])
                ->with('success','Password update successfully.');
            }else{
                return redirect()->back()-with('error','Updating password failed.');
            }
        }
    }

    public function adminProfile(){
        $user = auth()->user(); // get the authenticated user

        $admin = User::find($user);

        if($admin){
            return inertia('Admin/Profile',['admin' => $admin]);
        }
        
    }

    public function updateAdminInfo(Request $request){
        // dd($request->id);
        if($request->contact_number !== null){
            $existingContacts = User::where('contact_number',$request->contact_number)->first();
            // dd($existingContacts);

            if($existingContacts !== null){
                // Check if the existing record id is the same with parameter id
                if($existingContacts->id == $request->id){
                    $field = $request->validate([
                        'firstname' => 'required',
                        'lastname' => 'required',
                        'contact_number' => 'required|min:11|max:11',
                        'username' => 'required',
                    ]);
                }else{
                    $field = $request->validate([
                        'firstname' => 'required',
                        'lastname' => 'required',
                        'contact_number' => 'required|min:11|max:11|unique:users,contact_number',
                        'username' => 'required',
                    ]);
                }   
            }else{
                $field = $request->validate([
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'contact_number' => 'required|min:11|max:11|unique:users,contact_number',
                    'username' => 'required',
                ]);
            }

        }else{
            $field = $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'contact_number' => 'required|min:11|max:11|unique:users,contact_number',
                'username' => 'required',
            ]);
        }

        if($field){
                $data = User::where('id',$request->id)->update([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'contact_number' => $request->contact_number,
                    'username' => $request->username,
                ]);

                if($data){
                    return redirect()->route('admin.profile')
                    ->with('success',$field['firstname' ] . ' information update successfully.');
                }else{
                    return redirect()->back()-with('error','Admin info failed to update.');
                }
            }
    }

    public function updateAdminPassword(Request $request){
        // dd($request);
        $fields = $request->validate([
            'new_password' => [
            'required',
            'string',
            Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols(),
        ],
        'confirm_password' => [
            'required',
            'string',
            Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols(),
        ],
        ]);

        if($fields['new_password'] === $fields['confirm_password']){
            $fields['new_password'] = Hash::make($fields['new_password']);

            $user = User::where('id',$request->id)->update([
                'password' =>  $fields['new_password'],
            ]);

            if($user){
                return redirect()->route('admin.profile',['user_id' => $request->id])
                ->with('success','Password update successfully.');
            }else{
                return redirect()->back()-with('error','Updating password failed.');
            }
        }
    }


    public function employeeLogout(Request $request){
        Auth::logout();

        // Invalidate and regenerate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('customer.index');
    }
}