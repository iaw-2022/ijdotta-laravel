<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->mapRoleIdToName(Role::all());
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateUser($request);
        if (!array_key_exists('password', $data)) {
            $data = array_merge($data, ['password' => '12345678']);
        }

        User::create($data);
        session()->flash('success', 'User successfully created.');
        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = $this->mapRoleIdToName(Role::all());
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($this->validateUser($request, $user));
        session()->flash('success', 'User successfully updated.');
        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', 'User successfully deleted.');
        return redirect(route('admin.users.index'));
    }

    public function editPassword() {
        return view('profile.custom-change-password');
    }

    public function changePassword(Request $request) {
        $data = $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', Password::min(8)->mixedCase()->numbers()->uncompromised(),
            'repeat_password' => ['required', 'same:new_password']],
        ]);

        $user = Auth::user();
        $user->update(['password' => $data['new_password']]);
        session()->flash('success', 'Password successfully updated.');
        return redirect(route('dashboard'));
    }

    public static function mapUserIdToUserName($users)
    {
        $usersMap = [];
        foreach ($users as $user) {
            $usersMap[$user->id] = $user->email;
        }
        return $usersMap;
    }

    private function mapRoleIdToName($roles)
    {
        $rolesMap = [];
        foreach ($roles as $role) {
            $rolesMap[$role->id] = $role->role;
        }
        return $rolesMap;
    }

    private function validateUser(Request $request, ?User $user = null)
    {
        $user ??= new User();

        return $request->validate([
            'name' => ['required', 'max:30'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user)],
            'role_id' => ['required', Rule::in(Role::all()->pluck('id')->toArray())]
        ]);
    }
}
