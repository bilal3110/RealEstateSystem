@extends('html.layout.main')
@section('main-section')

    <body class="RentSinglePage">
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
                                <div class="col-lg-12 mb-4 order-0">
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
                                    <div class="col-lg-4 col-md-6">
                                        <!-- Large Modal -->
                                        <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel3">Edit Property For
                                                            Rent</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('editRent', $property->seller_id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('POST')
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-fullname">Title</label>
                                                                <input type="text" class="form-control" id="propTitle"
                                                                    name="prop_title" value="{{ $property->prop_title }}" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-company">Property Location</label>
                                                                <input type="text" class="form-control" id="propLoc"
                                                                    name="prop_loc" value="{{ $property->prop_loc }}" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-email">Area</label>
                                                                <div class="input-group input-group-merge">
                                                                    <input type="text" id="propArea"
                                                                        class="form-control" name="prop_area"
                                                                        value="{{ $property->prop_area }}" />
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-phone">Demand</label>
                                                                <input type="text" id="propDemand"
                                                                    class="form-control phone-mask" name="demand"
                                                                    value="{{ $property->demand }}" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-phone">Property Owner</label>
                                                                <input type="text" id="propOwner"
                                                                    class="form-control phone-mask" name="seller_name"
                                                                    value="{{ $property->seller_name }}" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="basic-default-phone">Owner
                                                                    Contact</label>
                                                                <input type="text" id="propOwnerContact"
                                                                    class="form-control phone-mask" name="seller_contact"
                                                                    value="{{ $property->seller_contact }}" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="basic-default-phone">Owner
                                                                    CNIC</label>
                                                                <input type="text" id="propOwnerCnic"
                                                                    class="form-control phone-mask" name="seller_cnic"
                                                                    value="{{ $property->seller_cnic }}" />
                                                            </div>
                                                            @php
                                                                $images = is_array($property->prop_img)
                                                                    ? $property->prop_img
                                                                    : json_decode($property->prop_img, true);
                                                            @endphp

                                                            @if (!empty($images))
                                                                <div class="mb-3">
                                                                    <label class="form-label">Existing Images</label>
                                                                    <div class="d-flex flex-wrap">
                                                                        @foreach ($images as $image)
                                                                            <div class="position-relative m-2">
                                                                                <img src="{{ asset($image) }}"
                                                                                    class="img-thumbnail" width="100"
                                                                                    height="100">
                                                                                <button type="button"
                                                                                    class="btn btn-danger btn-sm remove-image"
                                                                                    data-image="{{ $image }}">X</button>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            <input type="hidden" name="remove_images"
                                                                id="removeImagesInput" value="">



                                                            <div class="mb-3">
                                                                <label class="form-label" for="propImg">Upload New
                                                                    Images</label>
                                                                <input class="form-control" type="file" id="propImg"
                                                                    name="prop_img[]" multiple />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-message">Description</label>
                                                                <textarea id="propDesc" class="form-control" placeholder="Describe things about Property" name="prop_desc">{{ $property->prop_desc }}</textarea>
                                                            </div>
                                                            <button id="rentSubmit" type="submit"
                                                                class="btn btn-primary">Send</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4 order-0">
                                    <div class="card" id="RentShowCard">
                                        <h5 class="card-header">{{ $property->prop_title }}</h5>
                                        <div class="card-body">
                                            <div class="col-md">
                                                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                                    <!-- Carousel Indicators -->
                                                    <div class="carousel-indicators">
                                                        @php
                                                            $images = is_array($property->prop_img)
                                                                ? $property->prop_img
                                                                : (is_string($property->prop_img)
                                                                    ? json_decode($property->prop_img, true)
                                                                    : []);
                                                            $imageCount =
                                                                !empty($images) && is_array($images)
                                                                    ? count($images)
                                                                    : 1; 
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

                                                    <!-- Carousel Controls -->
                                                    <a class="carousel-control-prev" href="#carouselExample"
                                                        role="button" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon"
                                                            aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExample"
                                                        role="button" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon"
                                                            aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col my-3">
                                                <h5 class="fw-bold text-primary" style="font-size: 17px;">Date: <small
                                                        id="demand"
                                                        class="text-dark">{{ $property->created_at->format('Y-m-d') }}</small>
                                                </h5>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">Demand: <small
                                                        id="demand"
                                                        class="text-dark">{{ number_format((float) str_replace(',', '', $property->demand), 0) }}</small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">Location: <small
                                                        id="location"
                                                        class="text-dark">{{ $property->prop_loc }}</small></h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">Area: <small
                                                        id="area"
                                                        class="text-dark">{{ $property->prop_area }}</small></h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">Owner: <small
                                                        id="owner"
                                                        class="text-dark">{{ $property->seller_name }}</small></h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">Contact: <small
                                                        id="contact"
                                                        class="text-dark">{{ $property->seller_contact }}</small></h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">CNIC: <small
                                                        id="contact"
                                                        class="text-dark">{{ $property->seller_cnic }}</small></h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">Description:
                                                    <small class="fw-bold text-dark">
                                                        <p class="py-2" id="description">{{ $property->prop_desc }}</p>
                                                    </small>
                                                </h3>
                                                <button id="addRent" type="button" class="btn btn-primary"
                                                    data-bs-toggle="modal" data-bs-target="#largeModal">
                                                    Edit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-4">
                                    <div class="card">
                                        <h3 class="card-header">Processing Form</h3>
                                        <div class="card-body">
                                            <form action="{{ route('rentProcess', $property->seller_id) }}"
                                                method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="basic-default-fullname">Renter/Tenant</label>
                                                    <input type="text" class="form-control" name="tenant_name"
                                                        id="basic-default-fullname" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-company">Renter
                                                        Contact</label>
                                                    <input type="text" class="form-control" name="tenant_contact"
                                                        id="basic-default-company" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-company">Renter
                                                        CNIC</label>
                                                    <input type="text" class="form-control" name="tenant_cnic"
                                                        id="basic-default-company" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-email">Rent</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="text" id="basic-default-email" name="prop_rent"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-phone">Commission</label>
                                                    <input type="text" id="basic-default-phone" name="commision"
                                                        class="form-control phone-mask" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-phone">Advance</label>
                                                    <input type="text" id="basic-default-phone" name="advance"
                                                        class="form-control phone-mask" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="basic-default-message">Description</label>
                                                    <textarea id="basic-default-message" class="form-control" placeholder="Describe the Contract"name="agreement"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Rent Out</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Row -->
                        </div>
                        <!-- / Content -->


                    @endsection
