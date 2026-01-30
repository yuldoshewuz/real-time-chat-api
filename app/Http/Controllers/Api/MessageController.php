<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageRead;
use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Conversation $conversation, Request $request): JsonResponse
    {
        if (!$conversation->users()->where('users.id', $request->user()->id)->exists()) {
            return $this->error('You do not have permission to view these messages', 403);
        }

        $messages = $conversation->messages()
            ->with('user:id,name')
            ->latest()
            ->paginate(30);

        return $this->success($messages, 'Messages retrieved successfully');
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'text' => 'required|string|max:5000',
        ]);

        $conversation = Conversation::findOrFail($request->conversation_id);

        if (!$conversation->users()->where('users.id', $request->user()->id)->exists()) {
            return $this->error('You cannot send messages to this conversation', 403);
        }

        $message = $conversation->messages()->create([
            'user_id' => $request->user()->id,
            'text' => $request->text,
        ]);

        $conversation->touch();

        $message->load('user:id,name');

        broadcast(new MessageSent($message))->toOthers();

        return $this->success($message, 'Message sent successfully', 201);
    }

    public function markAsRead(Message $message, Request $request): JsonResponse
    {
        if ($message->user_id === $request->user()->id) {
            return $this->error('Cannot mark your own message as read', 400);
        }

        if (!$message->read_at) {
            $message->update(['read_at' => now()]);

            broadcast(new MessageRead($message))->toOthers();
        }

        return $this->success(null, 'Message marked as read');
    }

    public function destroy(Message $message, Request $request): JsonResponse
    {
        if ($message->user_id !== $request->user()->id) {
            return $this->error('You can only delete your own messages', 403);
        }

        $message->delete();

        return $this->success(null, 'Message deleted successfully');
    }
}
