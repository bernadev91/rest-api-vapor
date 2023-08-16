<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderByDesc('id')->get();

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        if ($request->validated()) {
            $user = new User();

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();

            return response()->json($user);
        } else {
            return response()->json(['errors' => $request->errors()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            $user = User::findOrFail($id);

            if ($request->validated()) {
                if ($request->has('name')) {
                    $user->name = $request->input('name');
                }

                if ($request->has('email')) {
                    $user->email = $request->input('email');
                }

                $user->save();

                return response()->json($user);
            } else {
                return response()->json(['errors' => $request->errors()], 422);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found.'], 404);
        } catch (QueryException $e) {
            return response()->json(['error' => 'User could not be deleted.'], 500);
        }
    }
}
