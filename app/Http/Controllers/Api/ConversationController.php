<?php

namespace App\Http\Controllers\Api;

use App\Events\ConversationCreated;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $conversations = $request->user()->conversations()
            ->with(['users'])
            ->withCount(['messages as unread_count' => function ($q) use ($request) {
                $q->whereNull('read_at')
                    ->where('user_id', '!=', $request->user()->id);
            }])
            ->latest('updated_at')
            ->get();

        return $this->success($conversations, 'Conversations retrieved successfully');
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'type' => 'required|in:private,group',
            'user_id' => 'required_if:type,private|exists:users,id',
            'name' => 'required|nullable|string|max:255',
            'username' => [
                'required_if:type,group',
                'nullable',
                'string',
                'max:50',
                'unique:conversations,username',
                'regex:/^[a-zA-Z0-9_]+$/'
            ]
        ]);

        $type = $request->type;

        if ($type === 'private') {
            $existing = Conversation::where('type', 'private')
                ->whereHas('users', fn($q) => $q->where('users.id', $request->user()->id))
                ->whereHas('users', fn($q) => $q->where('users.id', $request->user_id))
                ->first();

            if ($existing) {
                return $this->success($existing, 'Existing conversation retrieved');
            }
        }

        return DB::transaction(function () use ($request, $type) {
            $conversation = Conversation::create([
                'name' => $request->name,
                'username' => $type === 'group' ? $request->username : null,
                'type' => $type,
                'creator_id' => $request->user()->id
            ]);

            $participants = [$request->user()->id];
            if ($type === 'private') {
                $participants[] = $request->user_id;
            }

            $conversation->users()->attach($participants);

            broadcast(new ConversationCreated($conversation->load('users')))->toOthers();

            return $this->success($conversation, 'Conversation created successfully', 201);
        });
    }

    public function addParticipant(Request $request): JsonResponse
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $conversation = Conversation::find($request->conversation_id);

        if ($conversation->type !== 'group') {
            return $this->error('Only group conversations allow participants', 400);
        }

        if ($conversation->users()->where('users.id', $request->user_id)->exists()) {
            return $this->error('User is already in this group', 400);
        }

        $conversation->users()->attach($request->user_id);

        return $this->success($conversation->load('users'), 'User added successfully');
    }

    public function removeParticipant(Request $request): JsonResponse
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $conversation = Conversation::find($request->conversation_id);

        if ($conversation->creator_id !== $request->user()->id && $request->user_id !== $request->user()->id) {
            return $this->error('Unauthorized', 403);
        }

        $conversation->users()->detach($request->user_id);

        return $this->success(null, 'Participant removed successfully');
    }

    public function leave(Request $request): JsonResponse
    {
        $request->validate(['conversation_id' => 'required|exists:conversations,id']);

        $conversation = Conversation::find($request->conversation_id);
        $conversation->users()->detach($request->user()->id);

        return $this->success(null, 'You left the group');
    }

    public function show(Request $request): JsonResponse
    {
        $request->validate(['conversation_id' => 'required|exists:conversations,id']);

        $conversation = Conversation::with('users')->find($request->conversation_id);

        if ($conversation->type === 'private' && !$conversation->users->contains($request->user()->id)) {
            return $this->error('Unauthorized', 403);
        }

        return $this->success($conversation, 'Conversation details retrieved');
    }

    public function destroy(Request $request): JsonResponse
    {
        $request->validate(['conversation_id' => 'required|exists:conversations,id']);

        $conversation = Conversation::find($request->conversation_id);

        if ($conversation->creator_id !== $request->user()->id) {
            return $this->error('Only the creator can delete this', 403);
        }

        $conversation->delete();

        return $this->success(null, 'Conversation deleted');
    }

    public function searchPublicGroups(Request $request): JsonResponse
    {
        $request->validate(['q' => 'required|string|min:2']);

        $groups = Conversation::where('type', 'group')
            ->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', "%{$request->q}%")
                    ->orWhere('username', 'LIKE', "%{$request->q}%");
            })
            ->withCount('users')
            ->limit(20)
            ->get();

        return $this->success($groups, 'Public groups retrieved successfully');
    }
}
