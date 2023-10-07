@extends('layouts.main')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{ route('product.index') }}">Products</a></li>
            <li class="breadcrumb-item active">Add product</li>
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
        <form action="{{ route('product.store') }}" method="post"
          enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <input type="text" name="title" class="form-control"
              placeholder="Title">
          </div>
          <div class="form-group">
            <input type="text" name="description" class="form-control"
              placeholder="Description">
          </div>
          <div class="form-group">
            <textarea name="content" class="form-control" placeholder="Content"
              cols="30" rows="10"></textarea>
          </div>
          <div class="form-group">
            <input type="text" name="oldPrice" class="form-control"
              placeholder="Old Price">
          </div>
          <div class="form-group">
            <input type="text" name="price" class="form-control"
              placeholder="Price">
          </div>
          <div class="form-group">
            <input type="text" name="count" class="form-control"
              placeholder="Count">
          </div>

          <div class="form-group">
            {{-- <div class="w-50 mb-2">
              <img src="{{ asset('storage/' . $product->preview_image) }}"
                alt="preview_image" class="w-50">
            </div> --}}
            <div class="input-group">
              <div class="custom-file">
                <input name="preview_image" type="file"
                  class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose
                  file</label>
              </div>
            </div>
          </div>

          <div class="form-group">
            {{-- <div class="w-50 mb-2">
                <img src="{{ asset('storage/' . $product->productImages) }}"
                  alt="productImages" class="w-50">
              </div> --}}
            <div class="input-group">
              <div class="custom-file">
                <input name="product_images[]" type="file"
                  class="custom-file-input" id="input-file-now-custom-3" multiple>
                <label class="custom-file-label" for="input-file-now-custom-3">Choose
                  files</label>
              </div>
            </div>
          </div>

          <div class="form-group">
            <select name="category_id" class="form-control select2"
              style="width: 100%;">
              <option selected="selected" disabled>Select a Category</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <select name="group_id" class="form-control select2"
              style="width: 100%;">
              <option selected="selected" disabled>Select a Group</option>
              @foreach ($groups as $group)
                <option value="{{ $group->id }}">{{ $group->title }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <select name="tags[]" class="tags" multiple="multiple"
              data-placeholder="Select a Tag" style="width: 100%;">
              @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->title }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <select name="colors[]" class="colors" multiple="multiple"
              data-placeholder="Select a Color" style="width: 100%;">
              @foreach ($colors as $color)
                <option value="{{ $color->id }}">{{ $color->title }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Add">
          </div>
        </form>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
