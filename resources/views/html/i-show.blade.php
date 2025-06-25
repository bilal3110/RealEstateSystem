@extends('html.layout.main')
@section('main-section')

    <body>
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Menu -->
                <!-- / Menu -->

                <!-- Layout container -->
                <div class="layout-page">
                    <!-- Navbar -->
                    @include('html.layout.nav')

                    <!-- / Navbar -->

                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <!-- Content -->

                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @else
                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                @endif
                                <div class="col-lg-6 mb-4 order-0">
                                    <div class="card">
                                        <h5 class="card-header">{{ $investment->prop_title }}</h5>
                                        <div class="card-body">
                                            <!-- Bootstrap carousel -->
                                            <div class="col-md">
                                                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                                    <!-- Carousel Indicators -->
                                                    <div class="carousel-indicators">
                                                        @php
                                                            $images = is_array($investment->prop_img)
                                                                ? $investment->prop_img
                                                                : (is_string($investment->prop_img)
                                                                    ? json_decode($investment->prop_img, true)
                                                                    : []);
                                                            $imageCount =
                                                                !empty($images) && is_array($images)
                                                                    ? count($images)
                                                                    : 1; // Default to 1 if no images
                                                        @endphp

                                                        @if ($imageCount > 0)
                                                            @for ($i = 0; $i < $imageCount; $i++)
                                                                <button type="button" data-bs-target="#carouselExample"
                                                                    data-bs-slide-to="{{ $i }}"
                                                                    class="{{ $i == 0 ? 'active' : '' }}"
                                                                    aria-current="{{ $i == 0 ? 'true' : 'false' }}"
                                                                    aria-label="Slide {{ $i + 1 }}"></button>
                                                            @endfor
                                                        @endif
                                                    </div>
                                                    <!-- Carousel Items -->
                                                    <div class="carousel-inner">
                                                        @if (!empty($images) && is_array($images) && count($images) > 0)
                                                            @foreach ($images as $index => $image)
                                                                <div
                                                                    class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                    <img class="d-block w-100" src="{{ asset($image) }}"
                                                                        alt="Property Image {{ $index + 1 }}" />
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="carousel-item active">
                                                                <img class="d-block w-100"
                                                                    src="{{ asset('storage/image/4.png') }}"
                                                                    alt="Default Image" />
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carouselExample" role="button"
                                                        data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExample" role="button"
                                                        data-bs-slide="next">
                                                        <span class="carousel-control-next-icon"
                                                            aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col my-3">
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Buying Price: <small
                                                        class="text-dark">{{ $investment->buying_price }}</small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Location: <small class="text-dark">{{ $investment->prop_loc }}</small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Area: <small class="text-dark">{{ $investment->prop_area }}</small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Contact: <small
                                                        class="text-dark">{{ $investment->seller_contact }}</small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Seller: <small class="text-dark">
                                                        {{ $investment->seller_name }}
                                                    </small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Seller CNIC: <small class="text-dark">
                                                        {{ $investment->seller_cnic }}
                                                    </small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Description:
                                                    <small class="fw-bold text-dark">
                                                        <p class="py-2">{{ $investment->prop_desc }}</p>
                                                    </small>
                                                </h3>
                                            </div>
                                            <!-- Bootstrap crossfade carousel -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card">
                                        <h3 class="card-header">Processing Form</h3>
                                        <div class="card-body">
                                            <form action="{{ route('investDisposed', $investment->invest_id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="investment_id"
                                                    value="{{ $investment->invest_id }}">
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-fullname">Buyer</label>
                                                    <input type="text" class="form-control" name="buyer_name"
                                                        id="basic-default-fullname" />
                                                </div>
                                                @error('buyer_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-company">Buyer
                                                        Contact</label>
                                                    <input type="text" class="form-control" name="buyer_contact"
                                                        id="basic-default-company" />
                                                </div>
                                                @error('buyer_contact')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-email">Selling
                                                        Price</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="text" id="basic-default-email" name="sell_price"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                                @error('sell_price')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-phone">Buyer CNIC</label>
                                                    <input type="text" id="basic-default-phone" name="buyer_cnic"
                                                        class="form-control phone-mask" />
                                                </div>
                                                @error('buyer_cnic')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-phone">Advance</label>
                                                    <input type="text" id="basic-default-phone" name="advance"
                                                        class="form-control phone-mask" />
                                                </div>
                                                @error('advance')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="basic-default-message">Agreement/Description</label>
                                                    <textarea id="basic-default-message" class="form-control" name="agreement" placeholder="Describe the Contract"></textarea>
                                                </div>
                                                @error('agreement')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <button type="submit" class="btn btn-primary">Sold Out</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Row -->
                        </div>
                        <!-- / Content -->


                        <!-- Footer -->
                    @endsection
