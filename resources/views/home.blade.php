@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Справочник</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{Form::open(['action' => 'HomeController@filter', 'method' => 'post'])}}
                    <div class="form-group row">
                      {{Form::label('warename', 'Наименование', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                      <div class="col-md-6">
                      {{Form::text('warename', $warename, ['class' => 'form-control'])}}
                      </div>
                    </div>                  
                    <div class="form-group row">
                      {{Form::label('code', 'Код', ['class' => 'col-md-4 col-form-label text-md-right'])}}
                      <div class="col-md-6">
                      {{Form::text('code', $code, ['class' => 'form-control'])}}
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                          {{Form::checkbox('null_pos', null, $null_pos, ['class' => 'form-check-input'])}} 
                          {{Form::label('null_pos', 'Не показывать нулевые остатки', ['class' => 'form-check-label'])}}
                        </div>
                      </div>
                    </div>                  
                    <div class="form-group row mb-0">
                      <div class="col-md-8 offset-md-4">
                      {{Form::submit('Применить', ['class' => 'btn btn-primary', 'name' => 'submitbutton'])}}
                      @if (Auth::user()->name == 'admin')
                        {{Form::submit('Не выдано', ['class' => 'btn btn-primary  ml-4', 'name' => 'submitbutton'])}}
                      @endif
                      </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div> 
<div class="table-responsive">
  <table class="table table-striped table-hover table-condensed">
    <thead>
      <tr>
        <th><strong>Наименование</strong></th>
        <th><strong>Код</strong></th>
        <th><strong>Магазин</strong></th>
        <th><strong>Склад</strong></th>
        <th><strong>Цена</strong></th>
        <th><strong>Дата</strong></th>
      </tr>
    </thead>
    <tbody>
        @foreach($ware as $key => $data)
        <tr>    
            <td>{{$data->name}}</td>
            <td>{{$data->code}}</td>
            <td>{{$data->quant_m}}</td>
            <td>{{$data->quant_s}}</td>
            <td>{{$data->price}}</td>
            <td>{{$data->date}}</td>                 
        @endforeach
      </tr>
    </tbody>
  </table>
  </div>
</div>
@endsection
