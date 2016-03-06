<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use App\Category;
use App\Day;
use App\Deal;
use Intervention\Image\Facades\Image;
use App\Geocoder;
use Auth;
use App\Http\Controllers\Flash;
use DB;

class ArticlesController extends Controller
{


    public function __construct(Article $article)
    {

        $this->article = $article;

        // ONLY SHOW CREATE AND EDIT PAGES IF LOGGED IN.
        $this->middleware('auth', ['except' => 'index' ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(Request $request)
{

    $formdata = $request->all();

    // $categories = Category::lists('name', 'id');
    // $days = Day::lists('dayname', 'id');

 // ADD ANY/ALL OPTION
    $days = array(8=>'Any') + Day::lists('dayname', 'id')->toArray();
    $categories = array(4=>'All') + Category::lists('name', 'id')->toArray();
    $lat = $request->get('lat');
    $lng = $request->get('lng');
    $chosenDay = $request->get('dayList');
    $deals = Deal::all()->lists('dealname', 'dayID')->toArray();

// GET DISTANCE FROM USER
    // $distance = $request->get('distance');

    // USE PRE-DEFINED DISTANCE 
    $distance = 100;

    //  THIS GETS THE USER DEFINED CATEGORY CHOICES

    $categoryChoice = $request->get('categoryList');

    // $dayChoice = $request->get('dayList');

    // dd($categoryChoice);

    // IF USER MAKES NO CATEGORY CHOICE SHOW ALL
    if(count($categoryChoice) == 0){

// USER MUST CHOOSE SOMETHING
    //   \Session::flash('flash_message', 'You Must Choose a Category'); 
    //   return redirect()->back();
    
// SHOW ALL IF NO CHOICE IS MADE
        $categoryChoice = Category::lists('id');

    }elseif(in_array(4, $categoryChoice)){

        $categoryChoice = Category::lists('id');

    }else{

        $categoryChoice = $request->get('categoryList');
        // dd($categoryChoice);
    }

    if(count($chosenDay) == 0){
// SHOW ALL IF NO CHOICE IS MADE
        $chosenDay = Day::lists('id');

    }elseif(in_array(8, $chosenDay)){
        $chosenDay = Day::lists('dayname', 'id');
        $chosenDay = $chosenDay->toArray();
        $chosenDay = array_keys($chosenDay);
    }else{
        $chosenDay = $request->get('dayList');
    }

    $query = Article::distance($lat, $lng, $distance)
        ->whereHas('categories', function ($query) use ($categoryChoice) {    
            $query->whereIn('categories.id', $categoryChoice);           
        })->whereHas('days', function ($query) use ($chosenDay) {    
            $query->whereIn('days.id', $chosenDay);           
       })->get();

     $articles = $query;   

    if(count($articles) == 0) 
    {
     // Flash::message('Sorry no deals in your area.');

       \Session::flash('flash_message', 'Sorry no deals in your area. Try Again!'); 

        return redirect()->action('HomeController@index');
    }

    return view('articles.index', compact('categories', 'articles', 'days', 'formdata', 'deals'))->with('startLat', $lat)->with('startLng', $lng)->with('chosenDay', $chosenDay);;

}

    /**
     * Show the form for creating  a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // return \Auth::user();
        $categories = Category::lists('name', 'id');
        // $days = Day::lists('dayname', 'id');
        $days = Day::lists('dayname', 'id');
        return view('articles.create', compact('categories', 'days'));
    }


    //  ADD CreateArticleRequest to the function below to have validation.

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {

        $image_name = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(base_path().'/public/images', $image_name);
        $article = ($request->except(['image']));
        $article['image'] = $image_name; 

        $article = Article::create($article);
 
        $categoriesId = $request->input('categoryList');

        $article->categories()->attach($categoriesId);

        $daysId = $request->input('dayList');

        $article->days()->attach($daysId);

// GET INPUT
        $deals = $request->input('dealname');

// GET ID OF ARTICLE
        $articleID = $article->id;
// N is the day id that increments
        $n = 1;

        foreach($deals as $deal) {

        Deal::create(['dealname' => $deal, 'article_id' => $articleID, 'dayID' => $n++]);

        }   
 

        return redirect()->route('articles_path');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $articles = Article::all();
        return view('articles.show', compact('articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $deals = Deal::all()->lists('dealname', 'dayID');
        $categories = Category::lists('name', 'id');
        $days = Day::lists('dayname', 'id');
        return view('articles.edit', compact('article','categories', 'days', 'deals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);

         if( $request->hasFile('image') ){
            $path = base_path().'/public/images';
            $file = $request->input('image');
                        // $file->fit(120,90);
            $fileName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move($path,$fileName);
            $article->image = $fileName; 
    }

    $article->update($request->all());


    for($i = 0; $i < sizeof($request->input('dealname')); $i++) {
        // $article = Article::find($id);

        $article->deals->whereIn('dayID',($i + 1))->first()->dealname = $request->input('dealname')[$i];
        $article->deals->whereIn('dayID',($i + 1))->first()->save();


        }

// TO UPDATE CATEGORIES
        $categoriesId = $request->input('categoryList');
        $article->categories()->sync($categoriesId);

        $daysId = $request->input('dayList');
        $article->days()->sync($daysId);

        return redirect('/');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $article = Article::find($id)->delete();
        return back();
 
    }



}
