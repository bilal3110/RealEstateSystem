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
                                </div>
                                <div class="col-lg-6 mb-4 order-0">
                                    <div class="card" id="RentShowCard">
                                        <h5 class="card-header"></h5>
                                        <div class="card-body">
                                            <div class="col">
                                                <h2 style="font-size: 20px; font-weight: 800;">Seeker Details</h2>
                                                <h3 class="fw-bold" style="font-size: 17px;"> <small id="contact"
                                                        class="badge bg-label-primary">{{ $seeker['status'] }}</small></h3>
                                                <h5 class="fw-bold" style="font-size: 17px;">Seeker Name: <small
                                                        id="demand" class="text-dark">{{ $seeker['name'] }}</small>
                                                </h5>
                                                <h3 class="fw-bold" style="font-size: 17px;">Seeker Contact: <small
                                                        id="demand" class="text-dark">{{ $seeker['contact'] }}</small>
                                                </h3>
                                                <h3 class="fw-bold" style="font-size: 17px;">Preffered Location: <small
                                                        id="location"
                                                        class="text-dark">{{ $seeker['preferred_location'] }}</small></h3>
                                                <h3 class="fw-bold" style="font-size: 17px;">Area: <small id="area"
                                                        class="text-dark">{{ $seeker['area'] }}</small></h3>
                                                <h3 class="fw-bold" style="font-size: 17px;">Budget: <small id="owner"
                                                        class="text-dark">{{ $seeker['budget'] }}</small></h3>
                                                <h3 class="fw-bold" style="font-size: 17px;">Type: <small id="contact"
                                                        class="text-dark">{{ $seeker['type'] }}</small></h3>
                                                <h3 class="fw-bold" style="font-size: 17px;">Description:
                                                    <small class="fw-bold text-dark">
                                                        <p class="py-2" id="description">{{ $seeker['description'] }}</p>
                                                    </small>
                                                </h3>
                                                <span>
                                                    @if ($seeker['status'] == 'pending')
                                                        <a href="{{ route('seekerContacted', $seeker['id']) }}"
                                                            class="btn btn-primary">Contacted</a>
                                                        <a href="{{ route('seekerClosed', $seeker['id']) }}"
                                                            class="btn btn-secondary">Closed</a>
                                                    @elseif ($seeker['status'] == 'contacted')
                                                        <a href="{{ route('seekerClosed', $seeker['id']) }}"
                                                            class="btn btn-secondary">Closed</a>
                                                    @else
                                                        <h3 class="badge bg-label-success">Deal Closed</h3>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-4">
                                    <div class="card">
                                        <h3 class="card-header">Edit Here</h3>
                                        <div class="card-body">
                                            <form action="{{ route('editSeeker', $seeker['id']) }}" method="POST"
                                                enctype="multipart/form-data" class="rentForm" id="rentForm">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-fullname">Seeker
                                                        Name</label>
                                                    <input type="text" class="form-control" id="propTitle" name="name"
                                                        value="{{ $seeker['name'] }}" />
                                                </div>
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-fullname">Seeker
                                                        Contact</label>
                                                    <input type="text" class="form-control" id="propTitle" name="contact"
                                                        value="{{ $seeker['contact'] }}" />
                                                </div>
                                                @error('contact')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="mb-3">
                                                    <label for="type" class="form-label">Property Type</label>
                                                    <select class="form-select form-select-lg" name="type"
                                                        id="type">
                                                        <option value="rent"
                                                            {{ $seeker->type == 'rent' ? 'selected' : '' }}>Rent</option>
                                                        <option value="buy"
                                                            {{ $seeker->type == 'buy' ? 'selected' : '' }}>Buy</option>
                                                    </select>

                                                </div>
                                                @error('type')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-company">Preferred
                                                        Location</label>
                                                    <input type="text" class="form-control" id="propLoc"
                                                        name="preferred_location"
                                                        value="{{ $seeker['preferred_location'] }}" />
                                                </div>
                                                @error('preferred_location')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-email">Area</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="text" id="propArea" class="form-control"
                                                            name="area" value="{{ $seeker['area'] }}" />
                                                    </div>
                                                </div>
                                                @error('area')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-phone">Budget</label>
                                                    <input type="text" id="propDemand" class="form-control phone-mask"
                                                        name="budget" value="{{ $seeker['budget'] }}" />
                                                </div>
                                                @error('budget')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="basic-default-message">Description</label>
                                                    <textarea id="propDesc" class="form-control" placeholder="Describe things about Property" name="description">{{ $seeker['description'] }}
                                                    </textarea>
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
                            <!-- Row -->
                        </div>
                        <!-- / Content -->


                    @endsection
