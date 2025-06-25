@extends('html.layout.main')
@section('main-section')

    <body class="rentPage">
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
                                    <div class="col-lg-12 col-md-16">

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
                                        <!-- Large Modal -->
                                        <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel3">Add Property For
                                                            Rent</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('rent-add') }}" method="POST"
                                                            enctype="multipart/form-data" class="rentForm" id="rentForm">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-fullname">Title</label>
                                                                <input type="text" class="form-control" id="propTitle"
                                                                    name="prop_title" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-company">Property Location</label>
                                                                <input type="text" class="form-control" id="propLoc"
                                                                    name="prop_loc" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-email">Area</label>
                                                                <div class="input-group input-group-merge">
                                                                    <input type="text" id="propArea"
                                                                        class="form-control" name="prop_area" />
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-phone">Demand</label>
                                                                <input type="text" id="propDemand"
                                                                    class="form-control phone-mask" name="demand" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-phone">Property Owner</label>
                                                                <input type="text" id="propOwner"
                                                                    class="form-control phone-mask" name="seller_name" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="basic-default-phone">Owner
                                                                    Contact</label>
                                                                <input type="text" id="propOwnerContact"
                                                                    class="form-control phone-mask"
                                                                    name="seller_contact" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="basic-default-phone">Owner
                                                                    CNIC</label>
                                                                <input type="text" id="propOwnerCnic"
                                                                    class="form-control phone-mask" name="seller_cnic" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-phone">Images</label>
                                                                <input class="form-control" type="file" id="propImg"
                                                                    name="prop_img[]" multiple />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-message">Description</label>
                                                                <textarea id="propDesc" class="form-control" placeholder="Describe things about Property" name="prop_desc"></textarea>
                                                            </div>
                                                            <button id="rentSubmit" type="submit"
                                                                class="btn btn-primary">Send</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h1 style="font-size: 20px; font-weight: 700; padding-top: 16px;">Rental
                                                Properties</h1>
                                            <div class="d-flex justify-content-between flex-wrap gap-3">
                                                <span class="d-flex gap-2">
                                                    <span>
                                                        <button id="addRent" type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#largeModal">
                                                            Add Property
                                                        </button>
                                                    </span>
                                                    <span>
                                                        <a href="{{ route('RentOutDisplay') }}"
                                                            class="btn btn-success">Rent
                                                            Out</a>
                                                    </span>
                                                </span>
                                                <span class="d-flex">
                                                    <form action="{{ route('r-show') }}" method="GET"
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
                                                            <a href="{{ route('r-show') }}"
                                                                class="btn btn-success">Reset</a>
                                                        </div>
                                                    </form>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-4 order-0">
                                    <div class="card">
                                        <h5 class="card-header">Rent</h5>
                                        <div class="table-responsive text-nowrap">
                                            <table class="table" id="rentTable">
                                                <thead>
                                                    <tr>
                                                        <th>Property</th>
                                                        <th>Client</th>
                                                        <th>Area</th>
                                                        <th>Location</th>
                                                        <th>Demand</th>
                                                        <th>CNIC</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($rent as $property)
                                                        <tr>
                                                            <td><span
                                                                    class="fw-medium">{{ $property['prop_title'] }}</span>
                                                            </td>
                                                            <td>{{ $property['seller_name'] }}</td>
                                                            <td>{{ $property['prop_area'] }}</td>
                                                            <td>{{ mb_strlen($property->prop_loc) > 10 ? substr($property->prop_loc, 0, 10) . '...' : $property->prop_loc }}
                                                            </td>
                                                            </td>
                                                            <td> {{ $property['demand'] }}
                                                            </td>
                                                            <td>{{ $property['seller_cnic'] }}</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button type="button"
                                                                        class="btn p-0 dropdown-toggle hide-arrow"
                                                                        data-bs-toggle="dropdown">
                                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('r-showProperty', $property['seller_id']) }}"><i
                                                                                class="fa-regular fa-eye me-1"></i>
                                                                            Preview</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('rent-del', $property['seller_id']) }}"><i
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
                                                        @if ($rent->onfirstPage())
                                                            <li class="page-item prev disabled">
                                                                <a class="page-link"></a>
                                                            </li>
                                                        @else
                                                            <li class="page-item prev">
                                                                <a href="{{ $rent->previousPageUrl() }}"
                                                                    class="page-link">Previous</a>
                                                            </li>
                                                        @endif
                                                        @foreach ($rent->getUrlRange(1, $rent->lastPage()) as $page => $url)
                                                            @if ($page == $rent->currentPage())
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

                                                        @if ($rent->hasMorePages())
                                                            <li class="page-item next">
                                                                <a class="page-link" href="{{ $rent->nextPageUrl() }}"><i
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
