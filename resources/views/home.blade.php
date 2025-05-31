@extends('layouts.dashboard')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <h1 class="mb-4">Dashboard</h1>
        <!-- Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-users me-2"></i> Total</h5>
                        <p class="card-text display-4">1,234</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-check"></i></i> Completed</h5>
                        <p class="card-text display-4">$56,789</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-hourglass-half"></i> Pending</h5>
                        <p class="card-text display-4">+12.5%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Recent Tasks</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#001</td>
                            <td>2025-05-30</td>
                            <td>John Doe</td>
                            <td>$150.00</td>
                            <td><span class="badge bg-success">Completed</span></td>
                        </tr>
                        <tr>
                            <td>#002</td>
                            <td>2025-05-29</td>
                            <td>Jane Smith</td>
                            <td>$275.50</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                        </tr>
                        <tr>
                            <td>#003</td>
                            <td>2025-05-28</td>
                            <td>Bob Johnson</td>
                            <td>$89.99</td>
                            <td><span class="badge bg-success">Completed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
