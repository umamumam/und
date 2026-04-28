@extends('layouts.app')
@section('content')
<div class="row ">
    <div class="col-12">
        <div class="mb-6">
            <h1 class="fs-3 mb-1">Dashboard</h1>
            <p>Welcome to your InApp Inventory Dashboard.</p>
        </div>
    </div>
</div>
<div class="row g-3 mb-3">
    <div class="col-lg-3 col-12">
        <div class="card p-4  bg-primary bg-opacity-10 border border-primary border-opacity-25 rounded-2">
            <div class="d-flex gap-3 ">
                <div class="icon-shape icon-md bg-primary text-white rounded-2">
                    <i class="ti ti-report-analytics fs-4"></i>
                </div>
                <div>
                    <h2 class="mb-3 fs-6">Total Sales</h2>
                    <h3 class="fw-bold mb-0">$25,000</h3>
                    <p class="text-primary mb-0 small">+5% since last month</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-12">
        <div class="card p-4  bg-success bg-opacity-10 border border-success border-opacity-25 rounded-2">
            <div class="d-flex gap-3 ">
                <div class="icon-shape icon-md bg-success text-white rounded-2">
                    <i class="ti ti-repeat fs-4"></i>
                </div>
                <div>
                    <h2 class="mb-3 fs-6">Total Purchase</h2>
                    <h3 class="fw-bold mb-0">$18,000</h3>
                    <p class="text-success mb-0 small">+22% since last month</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-12">
        <div class="card p-4  bg-info bg-opacity-10 border border-info border-opacity-25 rounded-2">
            <div class="d-flex gap-3 ">
                <div class="icon-shape icon-md bg-info text-white rounded-2">
                    <i class="ti ti-currency-dollar fs-4"></i>
                </div>
                <div>
                    <h2 class="mb-3 fs-6">Total Expenses</h2>
                    <h3 class="fw-bold mb-0">$9,000</h3>
                    <p class="text-info mb-0 small">+10% since last month</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-12">
        <div class="card p-4  bg-warning bg-opacity-10 border border-warning border-opacity-25 rounded-2">
            <div class="d-flex gap-3 ">
                <div class="icon-shape icon-md bg-warning text-white rounded-2">
                    <i class="ti ti-notes fs-4"></i>
                </div>
                <div>
                    <h2 class="mb-3 fs-6">Invoice Due</h2>
                    <h3 class="fw-bold mb-0">$25,000</h3>
                    <p class="text-warning mb-0 small">+35% since last month</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row g-3 mb-3">
    <div class="col-lg-4 col-12">
        <div class="card">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between border-bottom pb-5 mb-3">
                    <div>
                        <h3 class="fw-bold h4">$25,458</h3>
                        <span>Total Profit</span>
                    </div>
                    <div>
                        <i class="ti ti-layers-subtract fs-1 text-primary"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center small">
                    <div class="text-muted"><span class="text-success">+35%</span> vs Last Month</div>
                    <div><a href="#" class="link-primary text-decoration-underline">View</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-12">
        <div class="card">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between border-bottom pb-5 mb-3">
                    <div>
                        <h3 class="fw-bold h4">$45,458</h3>
                        <span>Total Payment Returns</span>
                    </div>
                    <div>
                        <i class="ti ti-credit-card fs-1 text-danger"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center small">
                    <div class="text-muted"><span class="text-danger">-20%</span> vs Last Month</div>
                    <div><a href="#" class="link-primary text-decoration-underline">View</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-12">
        <div class="card">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between border-bottom pb-5 mb-3">
                    <div>
                        <h3 class="fw-bold h4">$34,458</h3>
                        <span>Total Expenses</span>
                    </div>
                    <div>
                        <i class="ti ti-cash-banknote fs-1 text-warning"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center small">
                    <div class="text-muted"><span class="text-warning">-20%</span> vs Last Month</div>
                    <div><a href="#" class="link-primary text-decoration-underline">View</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row g-3 mb-3">
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center bg-transparent px-4 py-3">
                <h3 class="h5 mb-0">Sales vs Purchase</h3>
                <div>
                    <select class="form-select form-select-sm">
                        <option selected>This Year</option>
                        <option>This Month</option>
                        <option>This Week</option>
                    </select>
                </div>
            </div>
            <div class="card-body p-4">
                <div id="salesPurchaseChart"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center bg-transparent px-4 py-3">
                <h3 class="h5 mb-0">Overall Information</h3>
                <div>
                    <select class="form-select form-select-sm">
                        <option selected>Last 6 Months</option>
                        <option>This Month</option>
                        <option>This Week</option>
                    </select>
                </div>
            </div>
            <div class="card-body p-4">
                <h3 class="h6">Customers Overview</h3>
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div id="customerChart"></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-6 border-end">
                                <div class="text-center ">
                                    <h2 class="mb-1">5.5K</h2>
                                    <p class="text-success mb-2">First Time</p>
                                    <span class="badge bg-success"><i class="ti ti-arrow-up-left me-1"></i>25%</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <h2 class="mb-1">3.5K</h2>
                                    <p class="text-warning mb-2">Return</p>
                                    <span class="badge bg-success badge-xs d-inline-flex align-items-center"><i
                                            class="ti ti-arrow-up-left me-1"></i>21%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center border-top mt-4 pt-4">
                    <div class="col-4 border-end">
                        <h3 class="fw-bold mb-2">6987</h3>
                        <small class="text-secondary">Suppliers</small>
                    </div>
                    <div class="col-4 border-end">
                        <h3 class="fw-bold mb-2">4896</h3>
                        <small class="text-secondary">Customers</small>
                    </div>
                    <div class="col-4">
                        <h3 class="fw-bold mb-2">487</h3>
                        <small class="text-secondary">Orders</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row g-3">
    <div class="col-lg-4">
        <div class="card  h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center px-4 py-3">
                <h4 class="mb-0 h5">Top Selling Products</h4>
                <button class="btn btn-sm btn-outline-secondary">
                    <i class="ti ti-calendar"></i> Today
                </button>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex align-items-center gap-3">
                    <img src="{{ asset('inapp/dist/assets/images/product-2.png') }}" class="rounded" width="48">
                    <div class="flex-grow-1">
                        <p class="mb-1">Wireless Earphones</p>
                        <div class="d-flex align-items-center gap-2 text-muted">
                            <small class="fw-semibold">$89 </small>
                            <small>•</small>
                            <small>1,250 Units</small>
                        </div>
                    </div>
                    <span class="badge bg-danger-subtle text-danger border border-danger">18%</span>
                </li>
                <li class="list-group-item d-flex align-items-center gap-3">
                    <img src="{{ asset('inapp/dist/assets/images/product-1.png') }}" class="rounded" width="48">
                    <div class="flex-grow-1">
                        <p class="mb-1">Gaming Joy Stick</p>
                        <div class="d-flex align-items-center gap-2 text-muted">
                            <small class="fw-semibold">$49 </small>
                            <small>•</small>
                            <small>5,420 Units</small>
                        </div>
                    </div>
                    <span class="badge bg-primary-subtle text-primary border border-primary">32%</span>
                </li>
                <li class="list-group-item d-flex align-items-center gap-3">
                    <img src="{{ asset('inapp/dist/assets/images/product-3.png') }}" class="rounded" width="48">
                    <div class="flex-grow-1">
                        <p class="mb-1">Smart Watch Pro</p>
                        <div class="d-flex align-items-center gap-2 text-muted">
                            <small class="fw-semibold">$98 </small>
                            <small>•</small>
                            <small>862 Units</small>
                        </div>
                    </div>
                    <span class="badge bg-info-subtle text-info border border-info">22%</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card  h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center px-4 py-3">
                <h4 class="mb-0 h5">Low Stock Products</h4>
                <a href="#" class="small text-primary text-decoration-underline">View All</a>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex align-items-center gap-3">
                    <img src="{{ asset('inapp/dist/assets/images/product-8.png') }}" class="rounded" width="48">
                    <div class="flex-grow-1">
                        <p class="mb-1">Wireless Headphones</p>
                        <small>ID: #554433</small>
                    </div>
                    <div class="d-flex flex-column gap-0 align-items-center">
                        <span class="fw-semibold text-primary">06</span>
                        <small class="text-muted">In Stock</small>
                    </div>
                </li>
                <li class="list-group-item d-flex align-items-center gap-3">
                    <img src="{{ asset('inapp/dist/assets/images/product-4.png') }}" class="rounded" width="48">
                    <div class="flex-grow-1">
                        <p class="mb-1">USB-C Cable Pack</p>
                        <small>ID: #887766</small>
                    </div>
                    <div class="d-flex flex-column gap-0 align-items-center">
                        <span class="fw-semibold text-primary">09</span>
                        <small class="text-muted">In Stock</small>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card  h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center px-4 py-3">
                <h4 class="mb-0 h5">Recent Sales</h4>
                <button class="btn btn-sm btn-outline-secondary">
                    <i class="ti ti-calendar-event"></i> Weekly
                </button>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex align-items-center gap-3">
                    <img src="{{ asset('inapp/dist/assets/images/product-7.png') }}" class="rounded" width="48">
                    <div class="flex-grow-1">
                        <p class="mb-1">MacBook Pro 16"</p>
                        <div class="d-flex align-items-center gap-2 text-muted">
                            <small class="fw-semibold">Computers </small>
                            <small>•</small>
                            <small>$2,499</small>
                        </div>
                    </div>
                    <span class="badge bg-success-subtle text-success">Completed</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection