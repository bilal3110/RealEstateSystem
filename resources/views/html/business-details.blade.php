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
                                <div class="col-lg-12 mb-4">
                                    <div class="card">
                                        <h3 class="card-header">Add Business Profile</h3>
                                        <div class="card-body">
                                            <form action="{{ route('storeBusiness') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-fullname">Company
                                                        Name</label>
                                                    <input type="text" class="form-control" name="company_name"
                                                        id="basic-default-fullname"
                                                        value="{{ old('company_name', $business->company_name ?? '') }}" />
                                                </div>
                                                @error('company_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror

                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-company">Add Logo</label>
                                                    <input type="file" class="form-control" name="logo"
                                                        id="basic-default-company" />
                                                    @if (!empty($business->logo))
                                                        <img src="{{ asset('storage/' . $business->logo) }}" width="100"
                                                            class="mt-2">
                                                    @endif
                                                </div>
                                                @error('logo')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror

                                                <button type="submit" class="btn btn-primary">Save</button>
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
