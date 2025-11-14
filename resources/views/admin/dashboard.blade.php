@extends('layouts.app')

@section('title', 'Admin Dashboard - RK Trading')

@section('content')
<!-- Header -->
<header class="header">
    <div class="header-container">
        <div class="header-content">
            <div class="logo-section">
                <div class="logo-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line>
                        <line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                </div>
                <div>
                    <h1>RK Trading</h1>
                    <p>Admin Portal</p>
                </div>
            </div>
            <form method="POST" action="{{ route('auth.logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16,17 21,12 16,7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>

<div class="dashboard-container">
    <div class="tabs">
        <button class="tab-btn active" onclick="showTab('dashboard')">Dashboard</button>
        <button class="tab-btn" onclick="showTab('addProduct')">Add Product</button>
        <button class="tab-btn" onclick="showTab('orders')">Manage Orders</button>
    </div>

    <!-- Dashboard Tab -->
    <div id="dashboard" class="tab-content active">
        <div class="section-header">
            <h2>Analytics Overview</h2>
        </div>

        <div class="stats-grid">
            @foreach($stats as $stat)
            <div class="stat-card {{ $stat['borderColor'] }}">
                <div class="stat-content">
                    <div class="stat-icon {{ $stat['bgColor'] }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            @if($stat['icon'] === 'dollar-sign')
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            @elseif($stat['icon'] === 'package')
                                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.83z"></path>
                                <line x1="7" y1="7" x2="7" y2="7"></line>
                            @elseif($stat['icon'] === 'users')
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            @elseif($stat['icon'] === 'trending-up')
                                <polyline points="23 6 13.5 15.5 9.5 11.5 1 20"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            @endif
                        </svg>
                    </div>
                    <div class="stat-info">
                        <p class="stat-title">{{ $stat['title'] }}</p>
                        <p class="stat-value">{{ $stat['value'] }}</p>
                    </div>
                    <div class="stat-badge {{ $stat['bgColor'] }}">
                        {{ $stat['change'] }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="dashboard-sections">
            <div class="section-card">
                <div class="section-header">
                    <h3>Recent Orders</h3>
                    <p>Latest customer orders</p>
                </div>
                <div class="orders-list">
                    @forelse($recentOrders as $order)
                    <div class="order-item">
                        <div class="order-info">
                            <p class="order-id">{{ $order['id'] }}</p>
                            <p class="order-customer">{{ $order['customer'] }}</p>
                        </div>
                        <div class="order-details">
                            <p class="order-amount">₹{{ number_format($order['amount']) }}</p>
                            <span class="status-badge status-{{ strtolower($order['status']) }}">
                                {{ $order['status'] }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <p>No recent orders found.</p>
                    @endforelse
                </div>
            </div>

            <div class="section-card">
                <div class="section-header">
                    <h3>Top Products</h3>
                    <p>Best selling items this month</p>
                </div>
                <div class="products-list">
                    @forelse($topProducts as $product)
                    <div class="product-item">
                        <div class="product-info">
                            <p class="product-name">{{ $product['name'] }}</p>
                            <span class="sales-badge">{{ $product['sales'] }} sold</span>
                        </div>
                        <p class="product-revenue">Revenue: ₹{{ number_format($product['revenue']) }}</p>
                    </div>
                    @empty
                    <p>No top products data available.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Tab -->
    <div id="addProduct" class="tab-content">
        <div class="form-container">
            <div class="form-header">
                <h2>Add New Product</h2>
                <p>Fill in the details to add a new product to your inventory</p>
            </div>

            @if(session('success'))
                <div class="success-alert">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22,4 12,14.01 9,11.01"></polyline>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="info-alert">
                💡 All fields marked with * are required
            </div>

            <form method="POST" action="{{ route('admin.products.store') }}" class="product-form">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Product Name *</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="e.g., Solar LED Bulb 12W"
                            value="{{ old('name') }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="price">Price (₹) *</label>
                        <input
                            type="number"
                            id="price"
                            name="price"
                            step="0.01"
                            placeholder="0.00"
                            value="{{ old('price') }}"
                            required
                        >
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="category">Category *</label>
                        <select id="category" name="category" required>
                            <option value="">Select category</option>
                            <option value="light" {{ old('category') === 'light' ? 'selected' : '' }}>Solar Lights</option>
                            <option value="fan" {{ old('category') === 'fan' ? 'selected' : '' }}>Fans</option>
                            <option value="accessory" {{ old('category') === 'accessory' ? 'selected' : '' }}>Accessories</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock Quantity *</label>
                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            placeholder="0"
                            value="{{ old('stock') }}"
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Product Description *</label>
                    <textarea
                        id="description"
                        name="description"
                        placeholder="Describe the product features and benefits..."
                        rows="4"
                        required
                    >{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Image URL (Optional)</label>
                    <input
                        type="url"
                        id="image"
                        name="image"
                        placeholder="https://example.com/image.jpg"
                        value="{{ old('image') }}"
                    >
                </div>

                @if($errors->any())
                    <div class="error-alert">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add Product
                    </button>
                    <button type="button" onclick="clearForm()" class="btn btn-secondary">
                        Clear Form
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Orders Tab -->
    <div id="orders" class="tab-content">
        <div class="section-header">
            <h2>Order Management</h2>
            <p>View and update order statuses</p>
        </div>

        <div class="orders-container">
            @forelse($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <div class="order-meta">
                        <h3>{{ $order['id'] }}</h3>
                        <p>{{ $order['customer'] }} - {{ $order['product'] }}</p>
                        <p class="order-amount">₹{{ number_format($order['amount']) }}</p>
                    </div>
                    <div class="order-actions">
                        <span class="status-badge status-{{ strtolower($order['status']) }}">
                            {{ $order['status'] }}
                        </span>
                        <button class="btn btn-outline btn-sm">
                            Update Status
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <p>No orders found.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/admin-script.js') }}"></script>
@endpush
