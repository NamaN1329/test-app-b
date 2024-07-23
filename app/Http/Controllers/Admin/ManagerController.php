<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreManagerRequest;
use App\Http\Requests\Admin\UpdateManagerRequest;
use App\Models\User;
use Illuminate\Support\Facades\Date;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()
            ->where("role", 2)
            ->orderBy("created_at", "desc")->get();

        return view("admin/manager", compact("users"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreManagerRequest $request)
    {
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "role" => 2,
            "email_verified_at" => Date::now(),
            "phone_number" => $request->phone_number,
        ]);

        return redirect()->route("admin.manager")->with("success", "Member added successfully!");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateManagerRequest $request, User $user)
    {
        $user->update([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $user->password === $request->password ? $user->password : bcrypt($request->password),
            "phone_number" => $request->phone_number,
        ]);

        return redirect()->route("admin.manager")->with("success", "Member edited successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(["success"=> "User deleted successfully!"]);
    }
}
