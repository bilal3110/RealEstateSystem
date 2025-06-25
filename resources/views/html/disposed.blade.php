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
                                <h3>Disposed Properties</h3>
                                <div class="col-lg-12 mb-4 order-0">
                                    <div class="card">
                                        <h5 class="card-header">Processed Table</h5>
                                        <div class="table-responsive text-nowrap">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Property</th>
                                                        <th>Area</th>
                                                        <th>Location</th>
                                                        <th>Buying Price</th>
                                                        <th>Selling Price</th>
                                                        <th>Buyer</th>
                                                        <th>Buyer Contact</th>
                                                        <th>Buyer CNIC</th>
                                                        <th>Profit</th>
                                                        <th>Advance</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    @foreach ($disposed as $prop)
                                                        <tr>
                                                            <td>{{ $prop->investment->prop_title ?? 'N/A' }}</td>
                                                            <td>{{ $prop->investment->prop_area ?? 'N/A' }}</td>
                                                            <td>{{ $prop->investment->prop_loc ?? 'N/A' }}</td>
                                                            <td>{{ number_format($prop->investment->buying_price ?? 0) }}
                                                            </td>
                                                            <td>{{ number_format($prop->sell_price ?? 0) }}</td>
                                                            <td>{{ $prop->buyer_name ?? 'N/A' }}</td>
                                                            <td>{{ $prop->buyer_contact ?? 'N/A' }}</td>
                                                            <td>{{ $prop->buyer_cnic ?? 'N/A' }}</td>
                                                            <td>{{ number_format($prop->profit ?? 0) }}</td>
                                                            <td>{{ number_format($prop->advance ?? 0) }}</td>
                                                            <td>{{ Str::limit($prop->agreement, 30, '...') ?? 'N/A' }}</td>
                                                            {{-- <td>
                                                                <!-- Add edit/view/delete buttons here -->
                                                            </td> --}}
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                {{-- Pagination Code --}}
                                <div class="col-lg-12 mb-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="demo-inline-spacing">
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination">
                                                        @if ($disposed->onfirstPage())
                                                            <li class="page-item prev disabled">
                                                                <a class="page-link"></a>
                                                            </li>
                                                        @else
                                                            <li class="page-item prev">
                                                                <a href="{{ $disposed->previousPageUrl() }}"
                                                                    class="page-link">Previous</a>
                                                            </li>
                                                        @endif
                                                        @foreach ($disposed->getUrlRange(1, $disposed->lastPage()) as $page => $url)
                                                            @if ($page == $disposed->currentPage())
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

                                                        @if ($disposed->hasMorePages())
                                                            <li class="page-item next">
                                                                <a class="page-link"
                                                                    href="{{ $disposed->nextPageUrl() }}"><i
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
