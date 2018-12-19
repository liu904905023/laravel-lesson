<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Http\Requests\DiscussionCreate;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    protected $redirectTo = '/home';

    public function __construct() {
        $this->middleware('checklogin', [
            'only' => [
                'create',
                'store',
                'edit',
                'update',
            ]
        ]);
    }
    public function index() {

        $discussions = Discussion::orderBy('created_at','desc')->paginate(10);

        return view('forum.index',compact('discussions'));

    }

    public function show($id) {

        $discussion = Discussion::find($id);
        $comments = $discussion->comments()->orderBy('created_at','desc')->paginate(3);
        return view('forum.show', compact('discussion','comments'));

    }

    public function create() {
        return view('forum.create');

    }

    public function store(DiscussionCreate $requset) {

        $data = [
            'user_id'      => \Auth::user()->id,
            'last_user_id' => \Auth::user()->id,
        ];
        $discussion = Discussion::create(array_merge($requset->all(), $data));
        return redirect()->action('PostsController@show', [
            'id' => $discussion->id,
        ]);
        
    }

    public function edit($id) {

        $discussion = Discussion::find($id);
        if(Auth::user()->id!=$discussion->user_id){
            return redirect('/');
        }
        return view('forum.edit', compact('discussion'));

    }

    public function update(DiscussionCreate $requset,$id) {

        $discussion = Discussion::find($id);
        $discussion->update($requset->all());
        return redirect()->action('PostsController@show', [
           'id'=> $discussion->id,
        ]);


    }
}
