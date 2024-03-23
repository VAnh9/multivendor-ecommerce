@extends('vendor.layouts.master')

@section('content')


  <section id="wsus__dashboard">
    <div class="container-fluid">
        @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h4></i> Product Gallery: {{ $product->name }}</h4>
            <div class="text-end mb-2">
              <a href="{{ route('vendor.products.index') }}" class="btn btn-secondary rounded-pill">Back</a>
            </div>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{ route('vendor.product-image-gallery.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group wsus__input" style="margin-bottom: 1rem">
                    <label for="">Image <code>(Multiple image supported!)</code></label>
                    <input type="file" name="image[]" class="form-control" multiple>
                    <input type="hidden" name="product" value="{{ $product->id }}">
                    @if ($errors->has('image'))
                      <code>{{ $errors->first('image') }}</code>
                    @endif
                    @if ($errors->has('image.*'))
                      <code>{{ $errors->first('image.*') }}</code>
                    @endif
                  </div>
                  <button type="submit" class="btn btn-primary">Upload</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h4 class="mb-3">All Images</h4>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <div class="card-body">
                  {{ $dataTable->table([], true) }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



@endsection

@push('scripts')
  {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endpush

