<?php

namespace App\Services;

use App\Models\Users;
use Illuminate\Support\Facades\Storage;

class UsersService
{
    public function createOrUpdateByEmail($data)
    {
        $image = $data->file('picture');
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('images', $image, $imageName);

        return Users::updateOrCreate(
            ['email' => $data->email],
            [
                'name' => $data->name,
                'phone' => $data->phone,
                'gender' => $data->gender,
                'education' => $data->education,
                'hobby' => $data->hobby,
                'exprience' => $data->exprience,
                'picture' => $imageName,
                'message' => $data->message
            ]
        );
    }

    public function getAll()
    {
        return Users::all();
    }

    public function UserByEmail($email)
    {
        return Users::where('email', $email)->first();
    }

    public function findById($id)
    {
        return Users::find($id);
    }

    public function deletyeById($id)
    {
        $checkUser = $this->findById($id);

        if (!empty($checkUser)) {
            return $checkUser->delete();
        }
    }
}
