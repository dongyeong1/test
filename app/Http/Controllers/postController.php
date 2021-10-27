<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use Inertia\Inertia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class postController extends Controller
{
    public function  kyoCreate()
    {
        return Inertia::render('dong/kyoCreate');
    }
    public function  kyoList()
    {
        $posts = DB::table('posts')->paginate(10);
        return Inertia::render('dong/kyoList');
    }
    public function  sugangList()
    {
        return Inertia::render('dong/sugangList');
    }

    public function create(Request $request)
    {
        $dt = Carbon::now();
        $className = $request->className;
        $classGrade = $request->classGrade;
        $aboutClass = $request->aboutClass;


        DB::table('posts')->insert(['className' => $className, 'classGrade' => $classGrade, 'aboutClass' => $aboutClass, 'created_at' => $dt, 'updated_at' => $dt]);
    }

    public function get()
    {
        $posts = DB::table('posts')->paginate(10);

        return $posts;
    }

    public function getShowPost(Request $request)
    {
        $postId = $request->postId;

        $content =       Post::where('id', $postId)->with('user')->get();
        return $content;
    }

    public function update(Request $request)
    {

        $postId = $request->postId;
        $updatedClassName = $request->updatedClassName;
        $updatedClassGrade = $request->updatedClassGrade;
        $updatedAboutClass = $request->updatedAboutClass;





        DB::table('posts')->where('id', $postId)->update(['className' => $updatedClassName, 'classGrade' => $updatedClassGrade, 'aboutClass' => $updatedAboutClass,]);
    }
    public function delete(Request $request)
    {
        $postId = $request->postId;

        DB::table('posts')->where('id', $postId)->delete();
    }
}
