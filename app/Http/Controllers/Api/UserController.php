<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me(Request $request): JsonResponse
    {
        return $this->success($request->user(), 'User profile retrieved');
    }

    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => [
                'sometimes',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $request->user()->id
            ],
        ]);

        $request->user()->update($validated);

        return $this->success($request->user(), 'Profile updated successfully');
    }

    public function search(Request $request): JsonResponse
    {
        $request->validate(['q' => 'required|string|min:2']);

        $query = $request->input('q');

        $users = User::where('id', '!=', $request->user()->id)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%");
            })
            ->limit(10)
            ->get(['id', 'name', 'email']);

        if ($users->isEmpty()) {
            return $this->success([], 'No users found matching your search');
        }

        return $this->success($users, count($users) . ' user(s) found');
    }

    public function status(User $user): JsonResponse
    {
        $data = [
            'id' => $user->id,
            'email_verified' => $user->hasVerifiedEmail(),
            'created_at' => $user->created_at->toDateTimeString(),
        ];

        return $this->success($data, 'User status retrieved');
    }

    public function destroy(Request $request): JsonResponse
    {
        $user = $request->user();

        $user->tokens()->delete();
        $user->delete();

        return $this->success(null, 'Account deleted successfully');
    }
}
