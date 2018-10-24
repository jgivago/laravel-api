<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Http\Resources\MessageResource;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MessageResource::collection(Message::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string'
        ]);

        $message = Message::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return new MessageResource($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return new MessageResource($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function showbyuser($user)
    {
        return MessageResource::collection(Message::where('user_id', $user)->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        // check if currently authenticated user is the owner of the message
        if ($request->user()->id !== $message->user_id) {
            return response()->json(['error' => 'You can only edit your own messages.'], 403);
        }

        $message->update($request->only(['title', 'description']));
        return new MessageResource($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Message $message)
    {
        // check if currently authenticated user is the owner of the message
        if ($request->user()->id !== $message->user_id) {
            return response()->json(['error' => 'You can only delete your own messages.'], 403);
        }

        $message->delete();
        return response()->json([
            'message' => 'Successfully deleted message!'
        ], 200);
    }
}
