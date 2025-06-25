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
                                <h3>Rent Out Properties</h3>
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
                                    <span class="d-flex">
                                        <form action="{{ route('RentOutDisplay') }}" method="GET" class="d-flex gap-2">
                                            <div class="mb-3">
                                                <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2"
                                                    placeholder="Search..." aria-label="Search..." name="search" />
                                            </div>
                                            <div>
                                                <input type="submit" class="btn btn-primary">
                                            </div>
                                            <div>
                                                <a href="{{ route('RentOutDisplay') }}" class="btn btn-success">Reset</a>
                                            </div>
                                        </form>
                                    </span>
                                    <div class="card">
                                        <h5 class="card-header">Processed Table</h5>
                                        <div class="table-responsive text-nowrap">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Property</th>
                                                        <th>Owner</th>
                                                        <th>Owner CNIC</th>
                                                        <th>Area</th>
                                                        {{-- <th>Location</th> --}}
                                                        <th>Rent</th>
                                                        <th>Renter</th>
                                                        {{-- <th>Renter Contact</th> --}}
                                                        <th>Renter CNIC</th>
                                                        <th>Commission</th>
                                                        {{-- <th>Advance</th> --}}
                                                        {{-- <th>Descrition</th> --}}
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    @foreach ($process as $rent)
                                                        <tr>
                                                            <td>{{ $rent->prop_title }}</td>
                                                            <td>{{ $rent->landlord_name }}</td>
                                                            <td>{{ $rent->landlord_cnic }}</td>
                                                            <td>{{ $rent->prop_area }}</td>
                                                            <td>{{ number_format((float) str_replace(',', '', $rent->prop_rent), 0) }}
                                                            </td>
                                                            <td>{{ $rent->tenant_name }}</td>
                                                            <td>{{ $rent->tenant_cnic }}</td>
                                                            <td>{{ number_format((float) str_replace(',', '', $rent->commision), 0) }}
                                                            </td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button type="button"
                                                                        class="btn p-0 dropdown-toggle hide-arrow"
                                                                        data-bs-toggle="dropdown">
                                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('rentOutDisplaySingle', $rent['prop_id']) }}"><i
                                                                                class="fa-regular fa-eye me-1"></i>
                                                                            Preview</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('RentOutDelete', $rent['prop_id']) }}"><i
                                                                                class="bx bx-trash me-1"></i> Delete</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                {{-- Pagination --}}
                                <div class="col-lg-12 mb-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="demo-inline-spacing">
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination">
                                                        @if ($process->onfirstPage())
                                                            <li class="page-item prev disabled">
                                                                <a class="page-link"></a>
                                                            </li>
                                                        @else
                                                            <li class="page-item prev">
                                                                <a href="{{ $process->previousPageUrl() }}"
                                                                    class="page-link">Previous</a>
                                                            </li>
                                                        @endif
                                                        @foreach ($process->getUrlRange(1, $process->lastPage()) as $page => $url)
                                                            @if ($page == $process->currentPage())
                                                                <li class="page-item active">
                                                                    <a class="page-link"
                                                                        href="#">{{ $page }}</a>
                                                                </li>
                                                            @else
                                                                <li class="page-item">
                                                                    <a class="page-link"
                                                                        href="{{ $url }}">{{ $page }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach

                                                        @if ($process->hasMorePages())
                                                            <li class="page-item next">
                                                                <a class="page-link"
                                                                    href="{{ $process->nextPageUrl() }}"><i
                                                                        class="tf-icon bx bx-chevron-right"></i></a>
                                                            </li>
                                                        @else
                                                            <li class="page-item next">
                                                                <a class="page-link" href="#"><i
                                                                        class="tf-icon bx bx-chevron-right"></i></a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </nav>
                                                <!--/ Basic Pagination -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Row -->
                        </div>
                        <!-- / Content -->
                    @endsection
