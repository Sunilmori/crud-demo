<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Services\UsersService;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UsersService;
    }

    public function storeOrUpdate(Request $request)
    {
        // dd($request->id);
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'gender' => 'required',
            'education' => 'required',
            'hobby' => 'required|array',
            'exprience' => 'required',
            'messag' => 'required',
        ]);
        if (!empty($request->file('picture')) && $request->id == null) {
            $image = $request->file('picture');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('images', $image, $imageName);
        } else {
            $imageName = $this->userService->findById($request->id)->picture;
        }

        Users::updateOrCreate(
            ['id' => $request->id],
            ['name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'gender' => $validatedData['gender'],
            'education' => $validatedData['education'],
            'hobby' => implode('-', $validatedData['hobby']),
            'exprience' => $validatedData['exprience'],
            'picture' => $imageName,
            'message' => $validatedData['messag']]
        );

        return response()->json(['message' => 'User created successfully']);
    }

    public function deleteRecord(Request $request)
    {
        $this->userService->deletyeById($request->id);
        return response()->json(['message' => 'User deleted successfully']);
    }
}
