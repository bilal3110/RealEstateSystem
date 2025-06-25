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
                                    <div class="col-lg-4 col-md-6">
                                        <!-- Large Modal -->
                                        <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel3">Add Office Spendings
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('addSpending') }}" method="POST">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-fullname">Liability/Product</label>
                                                                <input type="text" class="form-control" name="s_name"
                                                                    id="basic-default-fullname" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-company">Amount</label>
                                                                <input type="text" class="form-control" name="s_amount"
                                                                    id="basic-default-company" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-message">Description</label>
                                                                <textarea id="basic-default-message" class="form-control" name="s_description"
                                                                    placeholder="Describe things about Property"></textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="demo-inline-spacing">
                                            <h1 style="font-size: 20px; font-weight: 700; padding-top: 10px;">Manage
                                                Spendings</h1>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#largeModal">
                                                Add Spendings
                                            </button>
                                            <!-- <a href="sold-out.html" class="btn btn-success">Sold Out</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4 order-0">
                                <div class="card">
                                    <h5 class="card-header">Spendings</h5>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Liability/Product</th>
                                                    <th>Amount</th>
                                                    <th>Description</th>
                                                    <th>Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @foreach ($spendings as $spending)
                                                    <tr>
                                                        <td>
                                                            <span class="fw-medium">{{ $spending->s_name }}</span>
                                                        </td>
                                                        <td>{{ $spending->s_amount }}</td>
                                                        <td>{{ $spending->s_description }}</td>
                                                        <td>{{ $spending->created_at }}</td>
                                                        <td>
                                                            <a class="dropdown-item"
                                                                href="{{ route('delSpending', $spending->s_id) }}"><i
                                                                    class="bx bx-trash me-1"></i></a>
                                                        </td>
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
                                                    @if ($spendings->onfirstPage())
                                                        <li class="page-item prev disabled">
                                                            <a class="page-link"></a>
                                                        </li>
                                                    @else
                                                        <li class="page-item prev">
                                                            <a href="{{ $spendings->previousPageUrl() }}"
                                                                class="page-link">Previous</a>
                                                        </li>
                                                    @endif
                                                    @foreach ($spendings->getUrlRange(1, $spendings->lastPage()) as $page => $url)
                                                        @if ($page == $spendings->currentPage())
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

                                                    @if ($spendings->hasMorePages())
                                                        <li class="page-item next">
                                                            <a class="page-link"
                                                                href="{{ $spendings->nextPageUrl() }}"><i
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
