@extends('layouts.main')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{ route('product.show', $product->id)  }}">Product</a></li>
            <li class="breadcrumb-item active">Edit product</li>
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
        <form action="{{ route('product.update', $product->id) }}" method="post"
          enctype="multipart/form-data">
          @csrf
          @method('patch')
          <div class="form-group">
            <input type="text" name="title" value="{{ $product->title }}"
              class="form-control" placeholder="Title">
          </div>
          <div class="form-group">
            <input type="text" name="description"
              value="{{ $product->description }}" class="form-control"
              placeholder="Description">
          </div>
          <div class="form-group">
            <textarea name="content" value="{{ $product->content }}" class="form-control"
              placeholder="Content" cols="30" rows="10">{{ $product->content }}</textarea>
          </div>
          <div class="form-group">
            <input type="text" name="oldPrice" value="{{ $product->oldPrice }}"
              class="form-control" placeholder="Old Price">
          </div>
          <div class="form-group">
            <input type="text" name="price" value="{{ $product->price }}"
              class="form-control" placeholder="Price">
          </div>
          <div class="form-group">
            <input type="text" name="count" value="{{ $product->count }}"
              class="form-control" placeholder="Count">
          </div>

          <div class="form-group">
            <div class="w-50 mb-2">
                <img src="{{ asset('storage/' . $product->preview_image) }}"
                  alt="preview_image" class="w-50">
              </div>
            <div class="input-group">
              <div class="custom-file">
                <input name="preview_image" type="file"
                  class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose
                  file</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text">Upload</span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <select name="category_id" class="form-control select2"
              style="width: 100%;">
              <option selected="selected" disabled>Select a Category</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                  {{ $category->id == $product->category_id ? ' selected' : '' }}>
                  {{ $category->title }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <select name="group_id" class="form-control select2"
              style="width: 100%;">
              <option selected="selected" disabled>Select a Group</option>
              @foreach ($groups as $group)
                <option value="{{ $group->id }}"
                  {{ $group->id == $product->group_id ? ' selected' : '' }}>
                  {{ $group->title }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <select name="tags[]" class="tags" multiple="multiple"
              data-placeholder="Select a Tag" style="width: 100%;">
              @foreach ($tags as $tag)
                <option value="{{ $tag->id }}"
                  {{ is_array($product->tags->pluck('id')->toArray()) && in_array($tag->id, $product->tags->pluck('id')->toArray()) ? ' selected' : '' }}>
                  {{ $tag->title }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <select name="colors[]" class="colors" multiple="multiple"
              data-placeholder="Select a Color" style="width: 100%;">
              @foreach ($colors as $color)
                <option value="{{ $color->id }}" {{ is_array($product->colors->pluck('id')->toArray()) && in_array($color->id, $product->colors->pluck('id')->toArray()) ? ' selected' : '' }}>{{ $color->title }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Update">
          </div>
        </form>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
