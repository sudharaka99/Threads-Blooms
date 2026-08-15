@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

<div class="dashboard-welcome">

    <div>
        <span class="dashboard-eyebrow">
            Welcome back
        </span>

        <h2>
            Hello, {{ auth()->user()->name ?? 'Admin' }} 🌸
        </h2>

        <p>
            Here's what's happening with Threads & Blooms today.
        </p>
    </div>

    <div class="welcome-icon">
        <i class="fa-solid fa-seedling"></i>
    </div>

</div>


<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-icon pink">
            <i class="fa-solid fa-bag-shopping"></i>
        </div>

        <div>
            <span>Total Orders</span>
            <strong>128</strong>
            <small>
                <i class="fa-solid fa-arrow-up"></i>
                12% this month
            </small>
        </div>
    </div>


    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fa-solid fa-shirt"></i>
        </div>

        <div>
            <span>Products</span>
            <strong>36</strong>
            <small>
                Active products
            </small>
        </div>
    </div>


    <div class="stat-card">
        <div class="stat-icon gold">
            <i class="fa-solid fa-users"></i>
        </div>

        <div>
            <span>Customers</span>
            <strong>245</strong>
            <small>
                Registered users
            </small>
        </div>
    </div>


    <div class="stat-card">
        <div class="stat-icon purple">
            <i class="fa-solid fa-coins"></i>
        </div>

        <div>
            <span>Revenue</span>
            <strong>Rs. 184K</strong>
            <small>
                This month
            </small>
        </div>
    </div>

</div>


<div class="dashboard-grid">

    <div class="admin-panel">

        <div class="panel-header">

            <div>
                <span>Recent</span>
                <h3>Orders</h3>
            </div>

            <a href="{{ route('admin.orders.index') }}">
                View All
                <i class="fa-solid fa-arrow-right"></i>
            </a>

        </div>


        <div class="table-responsive">

            <table class="admin-table">

                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>
                            <strong>#TB-1028</strong>
                        </td>

                        <td>Amaya</td>

                        <td>Rs. 4,800</td>

                        <td>
                            <span class="status delivered">
                                Delivered
                            </span>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <strong>#TB-1027</strong>
                        </td>

                        <td>Nethmi</td>

                        <td>Rs. 2,400</td>

                        <td>
                            <span class="status pending">
                                Pending
                            </span>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <strong>#TB-1026</strong>
                        </td>

                        <td>Sarah</td>

                        <td>Rs. 3,600</td>

                        <td>
                            <span class="status processing">
                                Processing
                            </span>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>


    <div class="admin-panel">

        <div class="panel-header">

            <div>
                <span>Quick</span>
                <h3>Actions</h3>
            </div>

        </div>


        <div class="quick-actions">

            <a href="{{ route('admin.products.create') }}">
                <i class="fa-solid fa-plus"></i>
                <span>Add Product</span>
            </a>

            <a href="{{ route('admin.categories.create') }}">
                <i class="fa-solid fa-layer-group"></i>
                <span>Add Category</span>
            </a>

            <a href="{{ route('admin.custom-orders.index') }}">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
                <span>Custom Orders</span>
            </a>

            <a href="#">
                <i class="fa-solid fa-chart-line"></i>
                <span>View Reports</span>
            </a>

        </div>

    </div>

</div>

@endsection