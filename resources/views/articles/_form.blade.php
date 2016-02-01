<div class="form-group">
    {!! Form::label('title','TITLE') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    {!! $errors->first('title','<p class="error">:message</p>')!!}
</div>

<div class="form-group">
    {!! Form::label('deal','DEAL') !!}
    {!! Form::text('deal', null, ['class' => 'form-control']) !!}
      
</div>

<div class="form-group">
    {!! Form::label('image','PHOTO') !!}
    {!! Form::file('image', null, ['class' => 'form-control']) !!}
      
</div>

<div class="form-group">
    {!! Form::label('description','DESCRIPTION') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('categoryList','Category') !!}
    {!! Form::select('categoryList[]', $categories, null, ['class' => 'form-control', 'id' => 'categoryList', 'multiple']) !!}
  
</div>

<div class="form-group">
    {!! Form::label('dayList','Day') !!}
    {!! Form::select('dayList[]', $days, null, ['class' => 'form-control', 'id' => 'dayList', 'multiple']) !!}
  
</div>

<div class="form-group">
    {!! Form::label('address','ADDRESS') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
      
</div>

<div class="form-group">
    {!! Form::label('phone ','PHONE') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
      
</div>

<div class="form-group">
    {!! Form::label('email','EMAIL') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
      
</div>

<div class="form-group">
    {!! Form::label('website','WEBSITE') !!}
    <p>format: www.thesite.com</p>
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
      
</div>

<div class="form-group">
    {!! Form::label('rating','RATING') !!}
    <p><i class="fa fa-star"></i>3 stars is great deal. 2 stars ok. 1 star is no deal at all.</p>
        {!! Form::select('rating', ['1' => '1', '2' => '2', '3' => '3'], null, ['class' => 'form-control', 'size' => '3']) !!} 
      
</div>


<div class="form-group">

    {!! Form::label('lat ','LAT') !!}
    {!! Form::text('lat', null, ['class' => 'form-control']) !!}
    {!! $errors->first('lat','<p class="error">:message</p>')!!}
</div>

<div class="form-group">
    {!! Form::label('lon ','LON') !!}
    {!! Form::text('lng', null, ['class' => 'form-control']) !!}
    {!! $errors->first('lng','<p class="error">:message</p>')!!} 
</div>

<div class="form-group">
    
    {!! Form::submit($submitButtonText, null, ['class' => 'btn btn-primary']) !!}

</div>


@section ('footer')

<script type="text/javascript">
  $('select').select2();
</script>

@endsection

@include ('errors.list')
