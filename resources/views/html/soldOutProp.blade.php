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
                                <div class="col-lg-12 mb-4 order-0">
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @elseif (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <div class="card">
                                        <h5 class="card-header">{{ $process->prop_title }}</h5>
                                        <div class="card-body">
                                            <div class="col my-3">
                                                <h5 class="fw-bold text-primary" style="font-size: 17px;">Date: <small
                                                        id="demand"
                                                        class="text-dark">{{ $process->created_at->format('Y-m-d') }}</small>
                                                </h5>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Area: <small class="text-dark">{{ $process->prop_area }}</small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Location: <small class="text-dark">
                                                        {{ $process->prop_loc }}
                                                    </small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Owner: <small class="text-dark">{{ $process->landlord_name }}</small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Owner Contact: <small
                                                        class="text-dark">{{ $process->landlord_contact }}</small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Owner CNIC: <small
                                                        class="text-dark">{{ $process->landlord_cnic }}</small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Rent: <small
                                                        class="text-dark">{{ number_format((float) str_replace(',', '', $process->prop_price), 0) }}</small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Renter: <small class="text-dark">{{ $process->buyer_name }}</small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Renter Contact: <small
                                                        class="text-dark">{{ $process->buyer_contact }}</small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Renter CNIC: <small
                                                        class="text-dark">{{ $process->buyer_cnic }}</small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Advance: <small
                                                        class="text-dark">{{ number_format((float) str_replace(',', '', $process->advance), 0) }}</small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Commission: <small
                                                        class="text-dark">{{ number_format((float) str_replace(',', '', $process->commission), 0) }}</small>
                                                </h3>
                                                <h3 class="fw-bold text-primary" style="font-size: 17px;">
                                                    Description:
                                                    <small class="fw-bold text-dark">
                                                        <p class="py-2">{{ $process->agreement }}</p>
                                                    </small>
                                                </h3>
                                            </div>
                                            <!-- Bootstrap crossfade carousel -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <div class="card">
                                        <h3 class="card-header">Update Data</h3>
                                        <div class="card-body">
                                            <form action="{{ route('saleProcessEdit', $process->prop_id) }}"
                                                method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-fullname">Title</label>
                                                    <input type="text" class="form-control"
                                                        id="basic-default-fullname" name="prop_title"
                                                        value="{{ $process->prop_title }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-company">Area</label>
                                                    <input type="text" class="form-control" id="basic-default-company"
                                                        name="prop_area" value="{{ $process->prop_area }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-email">Location</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="text" id="basic-default-email"
                                                            class="form-control" name="prop_loc"
                                                            value="{{ $process->prop_loc }}" />
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-phone">Rent</label>
                                                    <input type="text" id="basic-default-phone"
                                                        class="form-control phone-mask" name="prop_price"
                                                        value="{{ $process->prop_price }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-fullname">Owner</label>
                                                    <input type="text" class="form-control"
                                                        id="basic-default-fullname" name="landlord_name"
                                                        value="{{ $process->landlord_name }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-company">Owner
                                                        Contact</label>
                                                    <input type="text" class="form-control" id="basic-default-company"
                                                        name="landlord_contact"
                                                        value="{{ $process->landlord_contact }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-email">Owner CNIC</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="text" id="basic-default-email"
                                                            class="form-control" name="landlord_cnic"
                                                            value="{{ $process->landlord_cnic }}" />
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-phone">Renter</label>
                                                    <input type="text" id="basic-default-phone"
                                                        class="form-control phone-mask" name="buyer_name"
                                                        value="{{ $process->buyer_name }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-phone">Renter
                                                        Contact</label>
                                                    <input type="text" id="basic-default-phone"
                                                        class="form-control phone-mask" name="buyer_contact"
                                                        value="{{ $process->buyer_contact }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-phone">Renter
                                                        CNIC</label>
                                                    <input type="text" id="basic-default-phone"
                                                        class="form-control phone-mask" name="buyer_cnic"
                                                        value="{{ $process->buyer_cnic }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-phone">Advance</label>
                                                    <input type="text" id="basic-default-phone"
                                                        class="form-control phone-mask" name="advance"
                                                        value="{{ $process->advance }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-phone">Commision</label>
                                                    <input type="text" id="basic-default-phone"
                                                        class="form-control phone-mask" name="commission"
                                                        value="{{ $process->commission }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="basic-default-message">Description</label>
                                                    <textarea id="basic-default-message" class="form-control" placeholder="Describe the Contract" name="agreement">{{ $process->agreement }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Row -->
                        </div>
                        <!-- / Content -->
                    @endsection
