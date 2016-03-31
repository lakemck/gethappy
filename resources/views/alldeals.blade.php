@extends('template')
@section('styles')
        <link href="{{URL::to('css/otherstyles.css')}}" rel="stylesheet" media="screen, projection">
@stop
@section('content')

<section class="showAllPage">

<div class="showAllWrapper">

@if ($articles->count())
@foreach ($articles as $article)
@if($article->title != '')
  <article class="showAllDeals">
    
      <h3 class="showAllTitle">{{$article->title}}</h3>
      <div class="showAllImage">
@if ($article->image != '')          
        {!! HTML::image('images/'.$article->image, $article->image) !!}  
@else 
        <img src="{{URL::to('images/gd.jpg')}}" alt="{{$article->title}}">  
@endif
      </div>
      <div class="showAllDeal">
        <h4>{{$article->deal}}<h4>
      </div>
    <div class="showAllDescription">
                  <div class="descriptionTextWys">    
                    {!! $article->description !!}
                  </div>
       <div class="deetsContainer">
             <div class="otherInfoContainer">
              <ul class="otherInfoIcons">
                <li><i class="fa fa-smile-o"></i><p>{{$article->address}}</p></li>
                @if($article->phone != "")
                <li><i class="fa fa-phone"></i><p>{{$article->phone}}</p></li>
                @endif
                @if($article->email != "")
                <li><i class="fa fa-envelope-o"></i><p>{{$article->email}}</p></li>
                @endif
                @if($article->website != "")
                <li><i class="fa fa-home"></i><a href="http://{{$article->website}}" target="blank" class="websiteLink">{{$article->website}}</a></li>
                @endif
              </ul>
            </div>

          </div>  
    </div>

  </article>
@endif 
@endforeach
@endif
   </div>
{!! $articles->render() !!}
</section> 


@stop
