<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Filters\GenderFilter;
use App\Models\Filters\StatusFilter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = [
            new StatusFilter(),
            new GenderFilter()
        ];

        $resources = User::filterResource($request, ['name', 'email', 'phone', 'address'], $filters)
        ->orderBy($request->get('sort', 'name'), $request->get('order', 'asc'))
        ->paginate($request->per_page ?? 10);

        return Inertia::render('Index', [
            'title' => 'Users',
            'resources' => $resources,
            'filters' => $filters,
            'params' => $request->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Create', [
            'title' => 'Create User'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $request->merge(['password' => bcrypt('password')]);
        $user = new User();
        $user->fill($request->all());
        $user->avatar = $request->avatar->store('avatar', 'public');
        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return Inertia::render('Detail',[
            'title' => 'Detail User',
            'resource' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return Inertia::render('Edit',[
            'title' => 'Edit User',
            'resource' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->fill($request->all());
        $user->avatar = $request->hasFile('avatar') ? 
            $request->avatar->store('avatar', 'public') : $user->avatar;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfuly');
    }
}
