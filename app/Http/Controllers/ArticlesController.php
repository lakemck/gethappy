<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use App\Category;
use App\Day;
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

// GET DISTANCE FROM USER
    // $distance = $request->get('distance');

    // USE PRE-DEFINED DISTANCE 
    $distance = 100;

    //  THIS GETS THE USER DEFINED CATEGORY CHOICES

    $categoryChoice = $request->get('categoryList');

    $dayChoice = $request->get('dayList');

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

    if(count($dayChoice) == 0){
// USER MUST CHOOSE SOMETHING       
    //   \Session::flash('flash_message', 'You Must Choose a Day'); 
    //   return redirect()->back();
    
// SHOW ALL IF NO CHOICE IS MADE
            $dayChoice = Day::lists('id');

    }elseif(in_array(8, $dayChoice)){

        $dayChoice = Day::lists('id');

    }else{

        $dayChoice = $request->get('dayList');

    }


    $query = Article::distance($lat, $lng, $distance)
        ->whereHas('categories', function ($query) use ($categoryChoice) {    
            $query->whereIn('categories.id', $categoryChoice);           
        })->whereHas('days', function ($query) use ($dayChoice) {    
            $query->whereIn('days.id', $dayChoice);           
       })->get();

// ->whereHas('days', function ($query) use ($dayChoice) {    
//             $query->whereIn('days.id', $dayChoice);           
//         })



     $articles = $query;   



    if(count($articles) == 0) 
    {
     // Flash::message('Sorry no deals in your area.');

       \Session::flash('flash_message', 'Sorry no deals in your area. Try Again!'); 

        return redirect()->action('HomeController@index');
    }

    return view('articles.index', compact('categories', 'articles', 'days', 'formdata'))->with('startLat', $lat)->with('startLng', $lng);

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

        // $article = Article::create($request->all());      
        // $fileName = $article['title']->getClientOriginalName();

        // $image = Image::make($article['image']->getRealPath());

        // $image->save(photo_path() . $article['image']->getClientOriginalName());

        // $image = $request->file('image');
        // $filename = $image->getClientOriginalName();
        // $path = public_path('images/'.$filename);
        // Image::make($image->getRealPath())->resize(200, 200)->save($path);


        // // $aDetails = Input::all();
        // $article->image = 'images/'.$filename;


        // $file = $request->file('image');
        // $fileName = $request->input('title').'.'.$file->getClientOriginalExtension();
        // $fileName= str_replace(' ', '_', $fileName);
        // $destinationPath    = 'images/';

        // // upload new image
        // Image::make($file->getRealPath())
        // ->resize(300, 300) 
        // ->save($destinationPath.$fileName);


//         // $aDetails = Article::all();
//         // $aDetails["image"] = $fileName;
//         $article = Article::create($request->all());      


        $image_name = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(base_path().'/public/images', $image_name);
        $article = ($request->except(['image']));
        $article['image'] = $image_name; 

        $article = Article::create($article);
 
        $categoriesId = $request->input('categoryList');

        $article->categories()->attach($categoriesId);

        $daysId = $request->input('dayList');

        $article->days()->attach($daysId);



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
        // echo $article;
        return view('articles.show', compact('articles'));
    }

// // BINDING EXAMPLE
//     public function show(Article $article)
//     {

//         return view('articles.show', compact('article'));
//     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Category::lists('name', 'id');
        $days = Day::lists('dayname', 'id');
        return view('articles.edit', compact('article','categories', 'days'));
    }

// // BINDING EXAMPLE
//     public function edit(Article $article)
//     {
//         $categories = Category::lists('name', 'id');
//         return view('articles.edit', compact('article'), compact('categories'));
//     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Article::find($id);

         if( $request->hasFile('image') ){
            $path = base_path().'/public/images';
            // $file = Image::make(input::file('pic'));
            $file = $request->input('image');
                        // $file->fit(120,90);
            $fileName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move($path,$fileName);
            // $students->original = $path."original/".$fileName;
            //get the desire image size

            // $file->save($path."fit/".$fileName);
            $article->image = $fileName; 
    }


        $article->fill($request->input())->save();
// TO EDIT PHOTO


// TO UPDATE CATEGORIES
        $categoriesId = $request->input('categoryList');
        $article->categories()->sync($categoriesId);

        $daysId = $request->input('dayList');
        $article->days()->sync($daysId);
        // $article->save();
        return redirect('/');

    }



// // Binding example
//    public function update(Article $article, Request $request )
//     {

//         $article->fill($request->input())->save();

//         return redirect('articles');

//     }

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
