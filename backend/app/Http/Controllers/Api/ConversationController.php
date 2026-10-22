<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreMessageRequest;
use App\Http\Resources\Api\ConversationResource;
use App\Http\Resources\Api\MessageResource;
use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index(Request $request)
    {
        $items = Conversation::query()
            ->where('initiator_id', $request->user()->id)
            ->orWhere('recipient_id', $request->user()->id)
            ->with('messages')
            ->latest('id')
            ->paginate(15);

        return ConversationResource::collection($items);
    }

    public function show(Conversation $conversation): ConversationResource
    {
        $this->authorizeParticipant($conversation);

        return new ConversationResource($conversation->load('messages'));
    }

    public function storeMessage(StoreMessageRequest $request, Conversation $conversation): MessageResource
    {
        $this->authorizeParticipant($conversation);

        $message = $conversation->messages()->create([
            'sender_id' => $request->user()->id,
            'body' => $request->string('body')->toString(),
        ]);

        return new MessageResource($message);
    }

    private function authorizeParticipant(Conversation $conversation): void
    {
        abort_unless(in_array(auth()->id(), [$conversation->initiator_id, $conversation->recipient_id], true), 403);
    }
}
