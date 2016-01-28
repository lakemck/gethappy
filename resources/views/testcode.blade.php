<!-- GET DISTANCE FORM MIGHT WORK BUT NOT YET -->
    {!! Form::open(['method' => 'GET', 'id' => 'getOriginForm', 'class' => 'getOriginForm', 'name' => 'getOriginForm']) !!}

      {!! Form::hidden('lat', $article->lat, ['class' => 'lat'])!!}
      {!! Form::hidden('lng', $article->lng, ['class' => 'lng'])!!}

    {!! Form::submit('go', array('id' => 'getDistanceButton', 'class' => 'getDistanceButton')) !!}
  
    {!! Form::close() !!}

<!-- GET DEST COORDINATES FOR GOOGLE DIRECTIONS -->
    <?php $googDestLat = $article->lat;
          $googDestLng = $article->lng;
     ?> 



        public function index(Request $request)
    {

    $lat = $request->get('lat');
    $lng = $request->get('lng');
    //  THIS GETS THE USER DEFINED CATEGORY CHOICES
    $categoryChoice = $request->get('categoryList');
    $distance = 1;

// THIS IS NO LONGER WORKING
    $query = Article::getByDistance($lat, $lng, $distance);

        if(empty($query)) {
        return redirect()->action('HomeController@index');
        }

        $ids = [];

        //Extracts the article/store id's
        foreach($query as $q)
        {
          array_push($ids, $q->id);
        }

        $articles = Article::find($ids);

        // Get the listings that match the returned ids
        // $results = DB::table('articles')
        // ->whereIn( 'id', $ids)
        // ->orderBy('title', 'DESC')
        // ->paginate(6);   

// GETS CATEGORIES RELATED TO ARTICLES - NOT NEEDED?

// $catIDs = [];
// foreach ($articles as $article){

//       array_push($catIDs, $article->categories->lists('id'));
// }

$articles = Article::whereHas('categories', function ($query)  use ($categoryChoice)  {    
    $query->whereIn('categories.id', $categoryChoice);    
})->get();


// // THIS WILL IDENTIFY WHETHER THE CATEGORIES OF NEARBY STORES MATCH THE CATEGORIES CHOSEN IN THE FORM - NOT WORKING.
        // $articles = $articles
        // ->whereIn('id', $catIDs)
        //         ->orderBy('title', 'DESC')
        // ->paginate(6); 
    //  $articles = $categoryChoice
    // ? Article::search($categoryChoice)->get()
    // : Article::all();

  // $newbrands =  $newBrands->where('is_active', '=', $status);
        return view('articles.index', compact('categories', 'days'))
        ->with('articles', $articles);

    }

code to show open or not

    <?php if (in_array('Wednesday', $daynames)){ echo 'open';} ?>