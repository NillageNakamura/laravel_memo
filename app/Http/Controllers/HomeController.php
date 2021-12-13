<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Memo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $exist_tag = Tag::where('name', $data['tag'])->where('user_id', $data['user_id'])->first();
        if( empty($exist_tag['id']) ){
            $tag_id = Tag::insertGetId([
                'name' => $data['tag'],
                'user_id' => $data['user_id'],
            ]);
        }else{
            $tag_id = $exist_tag['id'];
        }
        Memo::insertGetId([
            'content' => $data['content'],
            'user_id' => $data['user_id'],
            'tag_id' => $tag_id,
            'status' => 1,
        ]);
        return redirect()->route('create');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $memo = Memo::where('status', 1)->where('id', $id)->where('user_id', $user['id'])->first();
        return view('edit', compact('memo'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        Memo::where('id', $id)->update(['content' => $input['content'], 'tag_id' => $input['tag_id']]);
        return redirect()->route('create');
    }

    public function delete($id)
    {
        Memo::where('id', $id)->update(['status' => 2]);
        return redirect()->route('create')->with('success', 'メモの削除が完了しました！');
    }
}
