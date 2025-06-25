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
                                                        <h5 class="modal-title" id="exampleModalLabel3">Add Property Seeker
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('storeSeeker') }}" method="POST"
                                                            enctype="multipart/form-data" class="rentForm" id="rentForm">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-fullname">Seeker Name</label>
                                                                <input type="text" class="form-control" id="propTitle"
                                                                    name="name" />
                                                            </div>
                                                            @error('name')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-fullname">Seeker Contact</label>
                                                                <input type="text" class="form-control" id="propTitle"
                                                                    name="contact" />
                                                            </div>
                                                            @error('contact')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Property
                                                                    Type</label>
                                                                <select class="form-select form-select-lg" name="type"
                                                                    id="">
                                                                    <option selected>Select one</option>
                                                                    <option value="rent">Rent</option>
                                                                    <option value="buy">Buy</option>
                                                                </select>
                                                            </div>
                                                            @error('type')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-company">Prefferd Location</label>
                                                                <input type="text" class="form-control" id="propLoc"
                                                                    name="preferred_location" />
                                                            </div>
                                                            @error('preferred_location')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-email">Area</label>
                                                                <div class="input-group input-group-merge">
                                                                    <input type="text" id="propArea" class="form-control"
                                                                        name="area" />
                                                                </div>
                                                            </div>
                                                            @error('area')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-phone">Budget</label>
                                                                <input type="text" id="propDemand"
                                                                    class="form-control phone-mask" name="budget" />
                                                            </div>
                                                            @error('budget')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="basic-default-message">Description</label>
                                                                <textarea id="propDesc" class="form-control"
                                                                    placeholder="Describe things about Property"
                                                                    name="description"></textarea>
                                                            </div>
                                                            @error('description')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                            <button id="rentSubmit" type="submit"
                                                                class="btn btn-primary">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h1 style="font-size: 20px; font-weight: 700; padding-top: 16px;">Property
                                                Seekers</h1>
                                            <div class="d-flex justify-content-between flex-wrap gap-3">
                                                <span class="d-flex gap-2">
                                                    <span>
                                                        <button id="addRent" type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#largeModal">
                                                            Add Seeker
                                                        </button>
                                                    </span>
                                                </span>
                                                <span class="d-flex">
                                                    <form action="{{ route('showSeekers') }}" method="GET"
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
                                                            <a href="{{ route('showSeekers') }}"
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
                                        <h5 class="card-header">Seeker</h5>
                                        <div class="table-responsive text-nowrap">
                                            <table class="table" id="rentTable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Contact</th>
                                                        <th>Type</th>
                                                        <th>Area</th>
                                                        <th>Prefered Location</th>
                                                        <th>Budget</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($seekers as $property)
                                                        <tr>
                                                            <td><span class="fw-medium">{{ $property['name'] }}</span>
                                                            </td>
                                                            <td>{{ $property['contact'] }}</td>
                                                            <td>
                                                                @if ($property['type'] == 'rent')
                                                                    Rent
                                                                @else
                                                                    Buy
                                                                @endif
                                                            </td>
                                                            </td>
                                                            <td> {{ $property['area'] }}
                                                            </td>
                                                            <td>{{ $property['preferred_location'] }}</td>
                                                            <td>{{ $property['budget'] }}</td>
                                                            <td>
                                                                @if ($property['status'] == 'pending')
                                                                    <span class="badge bg-label-primary">Pending</span>
                                                                @elseif ($property['status'] == 'contacted')
                                                                    <span class="badge bg-label-secondary">Contacted</span>
                                                                @elseif ($property['status'] == 'closed')
                                                                    <span class="badge bg-label-danger">Closed</span>
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
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('seekerDetails', $property['id']) }}"><i
                                                                                class="fa-regular fa-eye me-1"></i>
                                                                            Preview</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('deleteSeeker', $property['id']) }}"><i
                                                                                class="bx bx-trash me-1"></i> Delete</a>
                                                                        @if ($property['status'] == 'pending')
                                                                            <hr>
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('seekerContacted', $property['id']) }}">
                                                                                <i class='bx  bx-phone-outgoing'></i>
                                                                                Contacted</a>
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('seekerClosed', $property['id']) }}">
                                                                                <i class='bx  bx-arrow-out-down-right-square'></i>
                                                                                Closed</a>
                                                                        @elseif ($property['status'] == 'contacted')
                                                                            <hr>
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('seekerClosed', $property['id']) }}">
                                                                                <i class="fa-regular fa-square-check"></i>
                                                                                Closed</a>
                                                                        @endif
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
                                                        @if ($seekers->onfirstPage())
                                                        <li class="page-item prev disabled">
                                                            <a class="page-link"></a>
                                                        </li>
                                                        @else
                                                        <li class="page-item prev">
                                                            <a href="{{ $seekers->previousPageUrl() }}"
                                                                class="page-link">Previous</a>
                                                        </li>
                                                        @endif
                                                        @foreach ($seekers->getUrlRange(1, $seekers->lastPage()) as $page => $url)
                                                        @if ($page == $seekers->currentPage())
                                                        <li class="page-item active">
                                                            <a class="page-link" href="#">{{ $page }}</a>
                                                        </li>
                                                        @else
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                                        </li>
                                                        @endif
                                                        @endforeach

                                                        @if ($seekers->hasMorePages())
                                                        <li class="page-item next">
                                                            <a class="page-link" href="{{ $seekers->nextPageUrl() }}"><i
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