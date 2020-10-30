@extends('admin.template.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                   <i class="fas fa-shopping-cart"></i> Transactions
                </h3>
                <div class="card-tools">
                    <a href="{{ route('transactions.create') }}" class="btn btn-tool">
                        <i class="fa fa-plus"></i> Import Transaction
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
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Date</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->product->name }}</td>
                                    <td>{{ date('d-m-Y', strtotime($value->trx_date)) }}</td>
                                    <td>{{ number_format($value->price,2,',','.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br><br>
                    <div class="row">
                       <div class="col-md-12">
                           <div class="float-right">
                               {{ $transactions->appends(request()->input())->links() }}
                           </div>
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
