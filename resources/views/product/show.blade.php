@extends('layouts.main')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a
                href="{{ route('product.index') }}">Products</a></li>
            <li class="breadcrumb-item active">Product</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header d-flex p-3">
              <div class="mr-1">
                <a href="{{ route('product.edit', $product->id) }}"
                  class="btn btn-primary">Edit</a>
              </div>
              <form action="{{ route('product.delete', $product->id) }}"
                method="POST">
                @csrf
                @method('delete')
                <input type="submit" class="btn btn-danger" value="Delete">
              </form>
            </div>

            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <tbody>
                  <tr>
                    <td>ID</td>
                    <td>{{ $product->id }}</td>
                  </tr>
                  <tr>
                    <td>Title</td>
                    <td>{{ $product->title }}</td>
                  </tr>
                  <tr>
                    <td>Description</td>
                    <td>{{ $product->description }}</td>
                  </tr>
                  <tr>
                    <td>Content</td>
                    <td>{{ $product->content }}</td>
                  </tr>
                  <tr>
                    <td>Old Price</td>
                    <td>{{ $product->oldPrice }}</td>
                  </tr>
                  <tr>
                    <td>Price</td>
                    <td>{{ $product->price }}</td>
                  </tr>
                  <tr>
                    <td>Count</td>
                    <td>{{ $product->count }}</td>
                  </tr>
                  <tr>
                    <td>File Product</td>
                    <td><img
                        src="{{ asset('storage/' . $product->preview_image) }}"
                        alt="preview_image" class="w-25"></td>
                  </tr>
                  {{-- <tr>
                    <td>File Product Images</td>
                    <td>
                        @foreach ($productImage->file_path as $img)
                        <img
                        src="{{ asset('storage/images/' . $img->file_path) }}"
                        alt="file_path" class="w-25">
                        @endforeach
                    </td>
                  </tr> --}}
                  <tr>
                    <td>Category</td>
                    <td>
                      @foreach ($categories as $category)
                        <div value="{{ $category->id }}">
                          {{ $category->id == $product->category_id ? $category->title : '' }}
                        </div>
                      @endforeach
                    </td>
                  </tr>
                  <tr>
                    <td>Group</td>
                    <td>
                      @foreach ($groups as $group)
                        <div value="{{ $group->id }}">
                          {{ $group->id == $product->group_id ? $group->title : '' }}
                        </div>
                      @endforeach
                    </td>
                  </tr>
                  <tr>
                    <td>Tag</td>
                    <td>
                      @foreach ($tags as $tag)
                        <div value="{{ $tag->id }}">
                          {{ is_array($product->tags->pluck('id')->toArray()) && in_array($tag->id, $product->tags->pluck('id')->toArray()) ? $tag->title : '' }}
                        </div>
                      @endforeach
                    </td>
                  </tr>
                  <tr>
                    <td>Color</td>
                    <td>
                      @foreach ($colors as $color)
                        <div value="{{ $color->id }}">
                          {{ is_array($product->colors->pluck('id')->toArray()) && in_array($color->id, $product->colors->pluck('id')->toArray()) ? $color->title : '' }}
                        </div>
                      @endforeach
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
