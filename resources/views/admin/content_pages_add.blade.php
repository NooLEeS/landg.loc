<div class="wrapper container-fluid">

    {!! Form::open(['url'=>route('pagesAdd'),'files'=>'true','class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}
   <div class="form-group">
       {!! Form::label('name','Na3Banie:',['class'=>'col-xs-2 control-label']) !!}

<div class="col-xs-8">
{!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Bbebite na3Baniue str']) !!}
</div>
   </div>
    <div class="form-group">
        {!! Form::label('alias','PseBdonim:',['class'=>'col-xs-2 control-label']) !!}

    <div class="col-xs-8">
        {!! Form::text('alias',old('alias:'),['class'=>'form-control','placeholder'=>'PseVdonim stranici']) !!}
    </div>
    </div>

    <div class="form-group">
        {!! Form::label('text','Text:',['class'=>'col-xs-2 control-label']) !!}

    <div class="col-xs-8">
        {!! Form::textarea('text',old('text'),['id'=>'editor','class'=>'form-control']) !!}
    </div>
    </div>

 <div class="form-group">
        {!! Form::label('images','Image:',['class'=>'col-xs-2 control-label']) !!}

    <div class="col-xs-8">
        {!! Form::file('images',['class'=>'filestyle','data-buttonText'=>'Chose IMG','data-buttonName'=>"btn-primary",'data-placeholder'=>"File not found"]) !!}
    </div>
 </div>

    <div class="form-group">
    <div class="col-xs-offset-2 col-xs-10">
        {!! Form::button('Save',['class'=>'btn btn-primary','type'=>'submit']) !!}
    </div>
    </div>


    {!! Form::close() !!}
    <script>CKEDITOR.replace('editor')</script>

</div>