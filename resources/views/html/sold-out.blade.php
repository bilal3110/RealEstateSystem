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
                                <h3>Sold Out Properties</h3>
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
                                        <form action="{{ route('SaleOutDisplay') }}" method="GET" class="d-flex gap-2">
                                            <div class="mb-3">
                                                <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2"
                                                    placeholder="Search..." aria-label="Search..." name="search" />
                                            </div>
                                            <div>
                                                <input type="submit" class="btn btn-primary">
                                            </div>
                                            <div>
                                                <a href="{{ route('SaleOutDisplay') }}" class="btn btn-success">Reset</a>
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
                                                        <th>Seller</th>
                                                        <th>Seller CNIC</th>
                                                        <th>Area</th>
                                                        <th>Price</th>
                                                        <th>Buyer</th>
                                                        <th>Buyer CNIC</th>
                                                        <th>Commission</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    @foreach ($process as $sale)
                                                        <tr>
                                                            <td>{{ $sale->prop_title }}</td>
                                                            <td>{{ $sale->landlord_name }}</td>
                                                            <td>{{ $sale->landlord_cnic }}</td>
                                                            <td>{{ $sale->prop_area }}</td>
                                                            <td>{{ number_format((float) str_replace(',', '', $sale->prop_price)) }}
                                                            </td>
                                                            <td>{{ $sale->buyer_name }}</td>
                                                            <td>{{ $sale->buyer_cnic }}</td>
                                                            <td>{{ number_format((float) str_replace(',', '', $sale->commission)) }}
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
                                                                            href="{{ route('soldOutDisplaySingle', $sale->prop_id) }}"><i
                                                                                class="fa-regular fa-eye me-1"></i>
                                                                            Preview</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('SaleOutDelete', $sale->prop_id) }}"><i
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
                                                        {{-- Previous Button --}}
                                                        @if ($process->onFirstPage())
                                                            <li class="page-item prev disabled">
                                                                <a class="page-link" href="#" aria-disabled="true">
                                                                    <i class="tf-icon bx bx-chevron-left"></i>
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li class="page-item prev">
                                                                <a class="page-link"
                                                                    href="{{ $process->previousPageUrl() }}">Previous</a>
                                                            </li>
                                                        @endif

                                                        {{-- Page Numbers --}}
                                                        @foreach (range(1, $process->lastPage()) as $page)
                                                            @if ($page == $process->currentPage())
                                                                <li class="page-item active">
                                                                    <a class="page-link"
                                                                        href="javascript:void(0)">{{ $page }}</a>
                                                                </li>
                                                            @else
                                                                <li class="page-item">
                                                                    <a class="page-link"
                                                                        href="{{ $process->url($page) }}">{{ $page }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach

                                                        {{-- Next Button --}}
                                                        @if ($process->hasMorePages())
                                                            <li class="page-item">
                                                                <a class="page-link" href="{{ $process->nextPageUrl() }}">
                                                                    <i class="tf-icon bx bx-chevron-right"></i>
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li class="page-item next disabled">
                                                                <a class="page-link" href="#" aria-disabled="true">
                                                                    <i class="tf-icon bx bx-chevron-right"></i>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Row -->
                        </div>
                        <!-- / Content -->


                    @endsection
