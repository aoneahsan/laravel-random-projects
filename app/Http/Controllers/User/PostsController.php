<?php

namespace App\Http\Controllers\User;

use Monolog;
use App\Models\Post;
use App\Models\Domain;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use HieuLe\WordpressXmlrpcClient\WordpressClient;


class PostsController extends Controller
{
    private $wpClient;

    public function xmlrpc($link,$username, $password)
    {
        $endpoint = $link ."/xmlrpc.php";

        $this->wpClient = new WordpressClient($endpoint, $username, $password);

        # Set the credentials for the next requests
        $this->wpClient->setCredentials($endpoint, $username, $password);

    }


    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->get();     
        return view('dashboard.pages.posts.index', compact('posts'));
    }
    public function create()
    {
        $domains = Domain::where('user_id', Auth()->user()->id)->get();
        return view('dashboard.pages.posts.create', compact('domains'));
    }

    public function image(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $fileName . '_' . time() . '.' . $file->getClientOriginalExtension();
        
            $file->move(public_path('uploads'), $fileName);
   
            $ckeditor = $request->input('CKEditorFuncNum');
            $url = asset('uploads/' . $fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($ckeditor, '$url')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            return $response;
        }


        // $CKEditorFuncNum = $request['CKEditorFuncNum'];

        // $file = $request->file('upload')->store('public/uploads');
        // //$url = Storage::url($file);
        // $url = asset('storage/' . $file);

        // //dd($url);

        // $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', 'Successfuly upload!')</script>";

        // // Render HTML output 
        // @header('Content-type: text/html; charset=utf-8');
        // return $response;
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'domain' => 'required',
            'title' => 'required',
            'content' => 'required'
        ]);

        try {

            $domain = Domain::where('id', $request->domain)->first();

            $this->xmlrpc($domain->domain, $domain->username,$domain->password);
           
            $result = $this->wpClient->newPost($request->title, $request->content, array(), 'post');

            $post = new Post;

            $post->domain_id = $request->domain;
            $post->post_id = $result;
            $post->title = $request->title;
            $post->user_id = Auth()->user()->id;
            $post->link = $domain->domain . "/" . $result;

            $post->save();

        } catch (\Throwable $th) {
             return redirect()->back()->with('message', "Server Error");
        }


        return redirect()->route('user.post.index')->with('created', 'Article created successfully!');

    }

    public function edit(Request $request, $id)
    {
        $post = Post::where('post_id', $id)->first();

        $this->xmlrpc($post->domain->domain, $post->domain->username,$post->domain->password);

        $result = (object) $this->wpClient->getPost($id);

        return view('dashboard.pages.posts.edit', compact("result"));

    }

    public function update(Request $request, $id)
    {

        $post = Post::where('post_id', $id)->first();

        $this->xmlrpc($post->domain->domain, $post->domain->username,$post->domain->password);

        $result  = $this->wpClient->editPost($request->title, $request->content, Str::slug($request->title), $id);

        $post->title = $request->title;

        $post->save();

        return redirect()->route('user.post.index')->with('updated', 'Article updated successfully!');

    }

    public function destroy($id)
    {
        $post = Post::where('post_id', $id)->first();

        $this->xmlrpc($post->domain->domain, $post->domain->username,$post->domain->password);

        $this->wpClient->deletePost($id);

        $post->delete();

        return redirect()->back()->with('deleted', 'Article deleted successfully!');

    }



}
