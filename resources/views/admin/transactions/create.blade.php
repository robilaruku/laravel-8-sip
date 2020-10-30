@extends('admin.template.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Import Excel Transaction
                    </h3>
                </div>
                {!! Form::open(['route' => 'transactions.import', 'method' => 'post', 'files' => true]) !!}
                <div class="card-body">
                  @if (!empty($errors->all()))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                   @endif
                   <div class="form-group">
                        {!! Form::label('import', 'File Excel') !!}
                        {!! Form::file('import', ['class' => 'form-control']) !!}
                   </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                    {!! Form::submit('Import Excel', ['class' => 'btn btn-primary float-right']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
