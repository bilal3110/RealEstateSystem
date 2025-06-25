@extends('html.layout.main')

@section('main-section')

    <body class="Analytics">
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
                                    <div class="card">
                                        <div class="d-flex align-items-end row">
                                            <div class="col-sm-7">
                                                <div class="card-body">
                                                    <h5 class="card-title text-primary">Welcome {{ auth()->user()->name }}
                                                    </h5>
                                                    <p class="mb-4" id="quote">
                                                        Rich People Acquire Assets. The Poor and Middle Class Acquire
                                                        Liabilities And think of It As Assets.- <strong> Robert Kiyosaki
                                                        </strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-5 text-center text-sm-left">
                                                <div class="card-body pb-0 px-0 px-md-4">
                                                    <img src="../assets/img/illustrations/businessIlustration.png"
                                                        height="140" alt="View Badge User"
                                                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                                        data-app-light-img="illustrations/man-with-laptop-light.png" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4 order-1">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="../assets/img/icons/unicons/chart-success.png"
                                                                alt="chart success" class="rounded" />
                                                        </div>
                                                    </div>
                                                    <span class="fw-medium d-block mb-1">Rent</span>
                                                    <h3 id="rent" class="card-title mb-2">{{ $rent }}</h3>
                                                    <small class="text-success fw-medium">Available</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="../assets/img/icons/unicons/wallet-info.png"
                                                                alt="Credit Card" class="rounded" />
                                                        </div>
                                                    </div>
                                                    <span>Sale</span>
                                                    <h3 id="sale" class="card-title text-nowrap mb-1">
                                                        {{ $sale }}</h3>
                                                    <small class="text-success fw-medium">Available</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-8 col-lg-6 order-3 order-md-2">
                                    <div class="row">
                                        <div class="col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="../assets/img/icons/unicons/paypal.png"
                                                                alt="Credit Card" class="rounded" />
                                                        </div>
                                                    </div>
                                                    <span class="d-block mb-1">Monthly Profit</span>
                                                    <h3 id="profit" class="card-title text-nowrap mb-2">
                                                        {{ $netIncome }}</h3>
                                                    <small class="text-danger fw-medium">PKR</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="../assets/img/icons/unicons/cc-primary.png"
                                                                alt="Credit Card" class="rounded" />
                                                        </div>
                                                    </div>
                                                    <span class="fw-medium d-block mb-1">Monthly Spending</span>
                                                    <h3 id="totalSpendings" class="card-title mb-2">{{ $totalSpending }}
                                                    </h3>
                                                    <small class="text-success fw-medium">PKR</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Properties Statistics -->
                                <div class="col-md-6 col-lg-6 col-xl-6 order-0 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                            <div class="card-title mb-0">
                                                <h4 style="font-weight: 700" class="m-0 me-2">Properties Statistics</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <div class="d-flex flex-column align-items-center gap-1 my-3">
                                                    <h2 id="totalDisposed" class="mb-2 bg-label-success p-3"
                                                        style="border-radius: 20%">{{ $totalDisposed }}</h2>
                                                    <span>Monthly Disposed</span>
                                                </div>
                                            </div>
                                            <ul class="p-0 m-0">
                                                <li class="d-flex mb-4 pb-1">
                                                    <div class="avatar flex-shrink-0 me-3">
                                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                                class="fa-solid fa-money-check"></i></span>
                                                    </div>
                                                    <div
                                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">Sales</h6>
                                                        </div>
                                                        <div class="user-progress">
                                                            <small id="totalSales"
                                                                class="fw-medium">{{ $saleIncome }}</small>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="d-flex mb-4 pb-1">
                                                    <div class="avatar flex-shrink-0 me-3">
                                                        <span class="avatar-initial rounded bg-label-success"><i
                                                                class="fa-solid fa-money-bill"></i></span>
                                                    </div>
                                                    <div
                                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">Rent</h6>
                                                        </div>
                                                        <div class="user-progress">
                                                            <small id="totalRent"
                                                                class="fw-medium">{{ $rentIncome }}</small>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="d-flex mb-4 pb-1">
                                                    <div class="avatar flex-shrink-0 me-3">
                                                        <span class="avatar-initial rounded bg-label-info"><i
                                                                class="bx bx-home-alt"></i></span>
                                                    </div>
                                                    <div
                                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">Investment</h6>
                                                        </div>
                                                        <div class="user-progress">
                                                            <small id="totalInvest"
                                                                class="fw-medium">{{ $investIncome }}</small>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Order Statistics -->
                                <!-- Bootstrap Modal -->
                                <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Add Task</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label" for="taskInput">Task</label>
                                                    <input type="text" class="form-control" id="taskInput" />
                                                </div>
                                                <button type="button" class="btn btn-primary" onclick="addTask()"
                                                    data-bs-dismiss="modal">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-xl-6 order-0 mb-4">
                                    <!-- Tasks -->
                                    <div class="col-md-12 col-lg-12 order-2 mb-4">
                                        <div class="card h-100">
                                            <div
                                                class="card-header d-flex align-items-center justify-content-between pb-0">
                                                <div class="card-title mb-0">
                                                    <h4 style="font-weight: 700" class="m-0 me-2">Seekers Statistics
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div class="d-flex flex-column align-items-center gap-1 my-3">
                                                        <h2 id="totalDisposed" class="mb-2 bg-label-success p-3"
                                                            style="border-radius: 20%">{{ $seekers }}</h2>
                                                        <span>Total Seekers</span>
                                                    </div>
                                                    <a href="{{ route('showSeekers') }}" class="btn btn-primary">Add
                                                        Seekers</a>
                                                </div>
                                                <ul class="p-0 m-0">
                                                    <li class="d-flex mb-4 pb-1">
                                                        <div class="avatar flex-shrink-0 me-3">
                                                            <span class="avatar-initial rounded bg-label-primary"><i
                                                                    class="fa-solid fa-money-check"></i></span>
                                                        </div>
                                                        <div
                                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">Rent</h6>
                                                            </div>
                                                            <div class="user-progress">
                                                                <small id="totalSales"
                                                                    class="fw-medium">{{ $seekersRent }}</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-4 pb-1">
                                                        <div class="avatar flex-shrink-0 me-3">
                                                            <span class="avatar-initial rounded bg-label-success"><i
                                                                    class="fa-solid fa-money-bill"></i></span>
                                                        </div>
                                                        <div
                                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">Buy</h6>
                                                            </div>
                                                            <div class="user-progress">
                                                                <small id="totalRent"
                                                                    class="fw-medium">{{ $seekersBuy }}</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-4 pb-1">
                                                        <div class="avatar flex-shrink-0 me-3">
                                                            <span class="avatar-initial rounded bg-label-info"><i
                                                                    class='bx  bx-phone-outgoing'></i></span>
                                                        </div>
                                                        <div
                                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">Seekers Contacted</h6>
                                                            </div>
                                                            <div class="user-progress">
                                                                <small id="totalInvest"
                                                                    class="fw-medium">{{ $seekersContacted }}</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-4 pb-1">
                                                        <div class="avatar flex-shrink-0 me-3">
                                                            <span class="avatar-initial rounded bg-label-dark"><i
                                                                    class='bx  bx-hourglass'></i> </span>
                                                        </div>
                                                        <div
                                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">Seekers Pending</h6>
                                                            </div>
                                                            <div class="user-progress">
                                                                <small id="totalInvest"
                                                                    class="fw-medium">{{ $seekersPending }}</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-4 pb-1">
                                                        <div class="avatar flex-shrink-0 me-3">
                                                            <span class="avatar-initial rounded bg-label-danger"> <i
                                                                    class="fa-regular fa-square-check"></i></span>
                                                        </div>
                                                        <div
                                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">Seekers Closed</h6>
                                                            </div>
                                                            <div class="user-progress">
                                                                <small id="totalInvest"
                                                                    class="fw-medium">{{ $seekersClosed }}</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        {{-- <br> --}}
                                    </div>

                                    <!--/ Tasks -->
                                </div>

                                                                <div class="col-md-12 col-lg-12 col-xl-12 order-0 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header d-flex align-items-center justify-content-between">
                                            <h5 class="card-title m-0 me-2">Daily Tasks</h5>
                                            <span>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#largeModal">
                                                    Add Daily Task
                                                </button>
                                            </span>
                                        </div>
                                        <div class="card-body">
                                            <ul id="taskList" class="list-unstyled mb-0">
                                                <!-- Tasks will appear here -->
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- / Content -->

                            <!-- Footer -->
                        @endsection
