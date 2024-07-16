<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\User\UserResource;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\SubscriberFollowing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() {
        $users = User::whereNot('id', auth()->id())->get();
        
        $followingsIds = SubscriberFollowing::where('subscriber_id', auth()->id())
        ->get('following_id')->pluck('following_id')->toArray();

        foreach ($users as $user) {
            if (in_array($user->id, $followingsIds)) {
                $user->is_followed = true;
            } 
        }

        return UserResource::collection($users);
    }

    public function post(User $user) {
        return PostResource::collection($user->posts());
    }

    public function toggleFollowing(User $user) {
        $res = auth()->user()->followings()->toggle($user->id);
        
        $data['is_followed'] = count($res['attached']) > 0; 

        return $data;
    }

    public function followingPost() {
        $followedIds = auth()->user()->followings()->get()->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $followedIds)->get();

        return PostResource::collection($posts);
    }
}
