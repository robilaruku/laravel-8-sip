@extends('admin.template.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                   <i class="fa fa-list"></i> Products
                </h3>
                <div class="card-tools">
                    <a href="{{ route('products.create') }}" class="btn btn-tool">
                        <i class="fa fa-plus"></i> Add product
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check"></i>&nbsp; {{ Session::get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{--  Filter  --}}
                {!! Form::open(['route' => 'products.index', 'method' => 'get']) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('category', 'Category') !!}
                                {!! Form::select('category', $categories, $category, ['class' => 'form-control', 'placeholder' => 'Choose Category']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Name') !!}
                                {!! Form::text('search', $search, ['class' => 'form-control', 'placeholder' => 'Enter Keyword']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-outline btn-primary" style="margin-top: 6%"><i class="fa fa-search"></i> Cari</button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline btn-secondary" style="margin-top: 6%"><i class="fas fa-sync"></i> Reload</a>
                        </div>
                    </div>
                {!! Form::close() !!}
                <br><br>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Nama</th>
                                <th>Sku</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($products as $key => $item)
                            <tr>
                                <td>{{ ($products->currentpage()-1) * $products->perpage() + $key + 1 }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->sku }}</td>
                                <td>{{ number_format($item->price,2,',','.') }}</td>
                                <td><img src="{{ $item->showImage() }}" alt="" width="100px" srcset=""></td>
                                @if ($item->status == 'Active')
                                 <td><span class="badge badge-success">{{ $item->status }}</span></td>
                                @else
                                 <td><span class="badge badge-danger">{{ $item->status }}</span></td>
                                @endif
                                <td>
                                    <form action="{{ route('products.destroy', $item->id) }}" method="post">
                                        @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                        <div class="btn-group" role="group" aria-label="Button group">
                                            <a href="{{ route('products.show', $item->id) }}" class="btn btn-sm btn-info" style="color: #fff"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('products.edit', $item->id) }}" class="btn btn-sm btn-success" style="color: #fff"><i class="fa fa-edit"></i></a>
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus data?')" style="color: #fff">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-right">
                                {{ $products->appends(request()->input())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
