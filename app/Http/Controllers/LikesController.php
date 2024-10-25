<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikesController extends Controller
{
    public function likePost(Request $request){
        $validated = Validator::make($request->all(),[
            'post_id' => 'required|integer',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(),403);
        }

        try {
            $userLikedPostBefore = Like::where('user_id',auth()->user()->id)
            ->where('post_id', $request->post_id)
            ->first();
            if ($userLikedPostBefore) {
                return response()->json(['message' => 'you can not like a post twice'],403);
            }else{
                $post = new Like();
                $post->post_id = $request->post_id;
                $post->user_id = auth()->user()->id;
                $post->save();
    
                 //return
                 return response()->json([
                    'message' => 'Post Liked successfully',
                ],200);
            }

        } catch (\Exception $th) {
            return response()->json(['error' => $th->getMessage()],403);
        }
    }
}
