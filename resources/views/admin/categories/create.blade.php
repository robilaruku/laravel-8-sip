@extends('admin.template.admin')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-plus"></i> Add Category
                </h3>
            </div>
            <form action="{{ route('categories.store') }}" method="post">
            @csrf
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
                    <label for="my-input">Name</label>
                    <input id="my-input" class="form-control" type="text" name="name" placeholder="Name...">
                </div>
                <div class="form-group">
                    <label for="my-input">Status</label>
                    <select name="status" id="" class="form-control">
                        <option value="">Pilih</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-primary float-right">Add Category</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
