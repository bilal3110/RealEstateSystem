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
                                    @else
                                        @if (session('error'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('error') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="col-lg-12 col-md-6">
                                        <!-- Large Modal -->
                                        <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel3">Add Property You
                                                            Invest In</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('addInvestment') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-fullname">Title</label>
                                                                <input type="text" class="form-control"
                                                                    id="basic-default-fullname" name="prop_title" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-company">Location</label>
                                                                <input type="text" class="form-control"
                                                                    id="basic-default-company" name="prop_loc" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-email">Area</label>
                                                                <div class="input-group input-group-merge">
                                                                    <input type="text" id="basic-default-email"
                                                                        class="form-control" name="prop_area" />
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="basic-default-phone">Seller
                                                                    Name</label>
                                                                <input type="text" id="basic-default-phone"
                                                                    class="form-control phone-mask" name="seller_name" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="basic-default-phone">Seller
                                                                    Contact</label>
                                                                <input type="text" id="basic-default-phone"
                                                                    class="form-control phone-mask"
                                                                    name="seller_contact" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="basic-default-phone">Seller
                                                                    CNIC</label>
                                                                <input type="text" id="basic-default-phone"
                                                                    class="form-control phone-mask" name="seller_cnic" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="basic-default-phone">Buying
                                                                    Price</label>
                                                                <input type="text" id="basic-default-phone"
                                                                    class="form-control phone-mask" name="buying_price" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="basic-default-phone">My
                                                                    Equity</label>
                                                                <input type="text" id="basic-default-phone"
                                                                    class="form-control phone-mask" name="my_equity" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="basic-default-phone">My
                                                                    Investment</label>
                                                                <input type="text" id="basic-default-phone"
                                                                    class="form-control phone-mask"
                                                                    name="my_investment" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-phone">Images</label>
                                                                <input class="form-control" type="file"
                                                                    id="formFileMultiple" name="prop_img[]" multiple />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-message">Description</label>
                                                                <textarea id="basic-default-message" class="form-control" placeholder="Describe things about Property"
                                                                    name="prop_desc"></textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Send</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h1 style="font-size: 20px; font-weight: 700; padding-top: 10px;">Your
                                                Investments</h1>
                                            <div class="d-flex justify-content-between flex-wrap gap-3">
                                                <span class="d-flex gap-2">
                                                    <span>
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#largeModal">
                                                            Add Property
                                                        </button>
                                                    </span>
                                                    <span>
                                                        <a href="{{ route('investDisposedShow') }}"
                                                            class="btn btn-success">Disposed</a>
                                                    </span>
                                                </span>
                                                <span class="d-flex">
                                                    <form action="{{ route('showInvestment') }}" method="GET"
                                                        class="d-flex gap-2">
                                                        <div class="mb-3">
                                                            <input type="text"
                                                                class="form-control border-0 shadow-none ps-1 ps-sm-2"
                                                                placeholder="Search..." aria-label="Search..."
                                                                name="search" />
                                                        </div>
                                                        <div>
                                                            <input type="submit" class="btn btn-primary">
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('showInvestment') }}"
                                                                class="btn btn-success">Reset</a>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('showHold') }}"
                                                                class="btn btn-outline-primary">Hold</a>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('showSold') }}"
                                                                class="btn btn-outline-success">Sold</a>
                                                        </div>
                                                    </form>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-4 order-0">
                                    <div class="card">
                                        <h5 class="card-header">Investment</h5>
                                        <div class="table-responsive text-nowrap">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Property</th>
                                                        <th>Seller Name</th>
                                                        <th>Area</th>
                                                        <th>Seller CNIC</th>
                                                        <th>Buying Price</th>
                                                        <th>My Equity</th>
                                                        <th>My Investment</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>

                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    @foreach ($investments as $investment)
                                                        <tr>
                                                            <td>{{ $investment->prop_title }}</td>
                                                            <td>{{ $investment->seller_name }}</td>
                                                            <td>{{ $investment->prop_area }}</td>
                                                            <td>{{ $investment->seller_cnic }}</td>
                                                            <td>{{ number_format((float) str_replace(',', '', $investment->buying_price)) }}
                                                            </td>
                                                            <td>{{ $investment->my_equity }} %</td>
                                                            <td>{{ number_format((float) str_replace(',', '', $investment->my_investment)) }}
                                                            </td>
                                                            <td>
                                                                @if ($investment->is_sold == 0)
                                                                    <span class="badge bg-label-primary">Hold</span>
                                                                @else
                                                                    <span class="badge bg-label-success">Sold</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button type="button"
                                                                        class="btn p-0 dropdown-toggle hide-arrow"
                                                                        data-bs-toggle="dropdown">
                                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        @if ($investment->is_sold == 0)
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('showProperty', $investment->invest_id) }}"><i
                                                                                    class="fa-regular fa-eye me-1"></i>
                                                                                Preview</a>
                                                                        @endif
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('deleteInvestment', $investment->invest_id) }}"><i
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
                                {{-- Pagination Code --}}
                                <div class="col-lg-12 mb-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="demo-inline-spacing">
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination">
                                                        @if ($investments->onfirstPage())
                                                            <li class="page-item prev disabled">
                                                                <a class="page-link"></a>
                                                            </li>
                                                        @else
                                                            <li class="page-item prev">
                                                                <a href="{{ $investments->previousPageUrl() }}"
                                                                    class="page-link">Previous</a>
                                                            </li>
                                                        @endif
                                                        @foreach ($investments->getUrlRange(1, $investments->lastPage()) as $page => $url)
                                                            @if ($page == $investments->currentPage())
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

                                                        @if ($investments->hasMorePages())
                                                            <li class="page-item next">
                                                                <a class="page-link"
                                                                    href="{{ $investments->nextPageUrl() }}"><i
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
