<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\HomeFormRequest;
use App\Http\Controllers\Controller;
use App\Category;
use App\Day;
// use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HomeFormRequest $request)
    {

// SEARCH STUFF TO FIX. NEED TO REDIRECT TO ANOTHER PAGE AND SHOW RESULTS THERE. https://laracasts.com/lessons/search-essentials

        // $query = $request->get('q');



        // $articles = $query

        // ? Article::search($query)->get()
        // : Article::all();

    //LONGER WAY OF CODING 

        // if ($query)
        // {

        //     $articles = Article::where('lat', 'LIKE', "%$query%")->get();            

        // }
        // else
        // {
        //     $articles = Article::all();
        // }


        // $days = Day::lists('dayname', 'id');
        // $categories = Category::lists('name', 'id');

 // ADD ANY/ALL OPTION
        $days = array(8=>'Any') + Day::lists('dayname', 'id')->toArray();
        $categories = array(4=>'All') + Category::lists('name', 'id')->toArray();
        return view('home', compact('categories', 'days'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
