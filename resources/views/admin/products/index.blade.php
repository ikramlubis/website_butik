@extends('layouts.admin')

@section('content')
   <div class="container">
    <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ __('Products') }}
                </h6>
                <div class="ml-auto">
                    @can('product_create')
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">{{ __('New product') }}</span>
                    </a>
                    @endcan
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Weight</th>
                        <th>Tags</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th class="text-center" style="width: 30px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($product->firstMedia)
                                <img src="{{ asset('storage/images/products/' . $product->firstMedia->file_name) }}"
                                    width="60" height="60" alt="{{ $product->name }}">
                                @else
                                    <span class="badge badge-danger">no image</span>
                                @endif
                            </td>
                            <td><a href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a></td>
                            <td>{{ $product->quantity }}</td>
                            <td>Rp.{{ number_format($product->price) }}</td>
                            <td>{{ $product->weight }} (gram)</td>
                            <td>
                                <span class="badge badge-info">{{ $product->tags->pluck('name')->join(', ') }}</span>
                            </td>
                            <td>{{ $product->category ? $product->category->name : NULL }}</td>
                            <td>{{ $product->status }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form onclick="return confirm('are you sure !')" action="{{ route('admin.products.destroy', $product) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="12">No products found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="12">
                                <div class="float-right">
                                    {!! $products->appends(request()->all())->links() !!}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
   </div>
@endsection
