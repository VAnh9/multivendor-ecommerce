@extends('frontend.dashboard.layouts.master')

@section('title')
  {{ $settings->site_name }} || Address
@endsection

@section('content')

<section id="wsus__dashboard">
    <div class="container-fluid">
      @include('frontend.dashboard.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <div class="d-flex justify-content-between">
              <h3><i class="fas fa-map-marker-alt"></i>create address</h3>
              <div><a href="{{ route('user.address.index') }}" class="btn btn-secondary">Back</a></div>
            </div>
            <div class="wsus__dashboard_add wsus__add_address">
              <form action="{{ route('user.address.store') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>name <b>*</b></label>
                      <input type="text" placeholder="Name" name="name" value="{{ old('name') }}" class="@error('name') is-invalid @enderror">
                      @if ($errors->has('name'))
                        <code class="">{{ $errors->first('name') }}</code>
                      @endif
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>email</label>
                      <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
                      @if ($errors->has('email'))
                        <code class="">{{ $errors->first('email') }}</code>
                      @endif
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>phone <b>*</b></label>
                      <input type="text" placeholder="Phone" name="phone" value="{{ old('phone') }}" class="@error('phone') is-invalid @enderror">
                      @if ($errors->has('phone'))
                        <code class="">{{ $errors->first('phone') }}</code>
                      @endif
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>country <b>*</b></label>
                      <div class="wsus__topbar_select">
                        <select class="select_2 country @error('country') is-invalid @enderror" name="country">
                          <option value="">Select</option>
                          @foreach (config('settings.country_list') as $key => $country )
                            <option value="{{ $country }}" data-id="{{$key}}">{{ $country }}</option>
                          @endforeach
                        </select>
                      </div>
                        @if ($errors->has('country'))
                          <code class="">{{ $errors->first('country') }}</code>
                        @endif
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>city/province<b>*</b></label>
                      <div class="wsus__topbar_select">
                        <select class="select_2 city @error('city') is-invalid @enderror" name="city">
                          <option value="">Select</option>
                        </select>
                      </div>
                      @if ($errors->has('city'))
                        <code class="">{{ $errors->first('city') }}</code>
                      @endif
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>District</label>
                      <input type="text" placeholder="District" value="{{ old('district') }}" class="district @error('district') is-invalid @enderror" name="district">
                      @if ($errors->has('district'))
                        <code class="">{{ $errors->first('district') }}</code>
                      @endif
                    </div>
                  </div>

                  {{-- <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>District</label>
                      <div class="wsus__topbar_select">
                        <select class="select_2 district @error('district') is-invalid @enderror" name="district">
                          <option value="">Select</option>
                        </select>
                      </div>
                      @if ($errors->has('district'))
                        <code class="">{{ $errors->first('district') }}</code>
                      @endif
                    </div>
                  </div> --}}



                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>zip code</label>
                      <input type="text" placeholder="Zip Code" name="zip_code" value="{{ old('zip_code') }}" class="@error('zip_code') is-invalid @enderror">
                      @if ($errors->has('zip_code'))
                        <code class="">{{ $errors->first('zip_code') }}</code>
                      @endif
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Address <b>*</b></label>
                      <input type="text" placeholder="Address" name="address" value="{{ old('address') }}" class="@error('address') is-invalid @enderror">
                      @if ($errors->has('address'))
                        <code class="">{{ $errors->first('address') }}</code>
                      @endif
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12">
                      <button type="submit" class="common_btn">Create</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


@endsection

@push('scripts')

  <script>
    $(document).ready(function() {
      $('body').on('change', '.country', function() {

        // $('.district').html('<option value="">Select</option>')

        // let ctry = $(this).find(':selected').data('id');
        // var settings = {
        //   "url": `https://api.countrystatecity.in/v1/countries/${ctry}/cities`,
        //   "method": "GET",
        //   "headers": {
        //     "X-CSCAPI-KEY": "cDQzcjlkRkFiVEtmT0FuaTJJTFRKMUhNaWNxeDVWaHZ2RUNPYUhxYQ=="
        //   },
        // };

        // $.ajax(settings).done(function (data) {
        //   $('.city').html('<option value="">Select</option>')
        //     $.each(data, function(i, item) {

        //      $('.city').append(`<option value="${item.name}">${item.name}</option>`)

        //     })
        // });

        // $.ajax(settings).fail(function(xhr, status, err) {
        //   console.log(err);
        // })

        let country = $(this).val();
        country = country.split(" ").join("");

        $.ajax({
          url: "https://countriesnow.space/api/v0.1/countries/cities",
          method: 'POST',
          data: {
            country: country
          },
          success: function(data) {

            $('.city').html('<option value="">Select</option>')
            $.each(data.data, function(i, item) {

             $('.city').append(`<option value="${item}">${item}</option>`)

            })
          },
          error: function(xhr, status, err) {
            console.log(err);
          }
        })

      })
    })
  </script>

@endpush
