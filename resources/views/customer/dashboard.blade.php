@extends('layouts.app')

@section('title', 'Customer Dashboard - RK Trading')

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
                    <p>Customer Portal</p>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('customer.orders') }}" class="btn btn-outline">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.83z"></path>
                        <line x1="7" y1="7" x2="7" y2="7"></line>
                    </svg>
                    My Orders
                </a>
                <form method="POST" action="{{ route('auth.logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline btn-red">
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
    </div>
</header>

<div class="dashboard-container">
    <!-- Messages -->
    @if(session('success'))
        <div class="message success-message">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22,4 12,14.01 9,11.01"></polyline>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="message error-message">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Tabs -->
    <div class="tabs">
        <button class="tab-btn active" onclick="showTab('products')">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path>
                <line x1="16" y1="8" x2="2" y2="22"></line>
                <line x1="17.5" y1="15" x2="9" y2="15"></line>
            </svg>
            Products
        </button>
        <button class="tab-btn" onclick="showTab('cart')">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="8" cy="21" r="1"></circle>
                <circle cx="19" cy="21" r="1"></circle>
                <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
            </svg>
            Cart @if($cartItems > 0) ({{ $cartItems }}) @endif
        </button>
    </div>

    <!-- Products Tab -->
    <div id="products" class="tab-content active">
        <!-- Search and Filter -->
        <div class="search-filter-card">
            <form method="GET" action="{{ route('customer.dashboard') }}" class="search-form">
                <div class="search-input-group">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="M21 21l-4.35-4.35"></path>
                    </svg>
                    <input
                        type="text"
                        name="search"
                        placeholder="Search products..."
                        value="{{ request('search') }}"
                    >
                </div>
                <div class="filter-buttons">
                    <button type="submit" name="category" value="all" class="filter-btn {{ request('category', 'all') === 'all' ? 'active' : '' }}">
                        All
                    </button>
                    <button type="submit" name="category" value="light" class="filter-btn {{ request('category') === 'light' ? 'active' : '' }}">
                        Lights
                    </button>
                    <button type="submit" name="category" value="fan" class="filter-btn {{ request('category') === 'fan' ? 'active' : '' }}">
                        Fans
                    </button>
                </div>
            </form>
        </div>

        <!-- Products Grid -->
        <div class="products-grid">
            @forelse($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ $product->image ?: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80' }}" alt="{{ $product->name }}">
                        <div class="stock-badge">In Stock: {{ $product->stock }}</div>
                    </div>
                    <div class="product-content">
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>
                        <div class="product-footer">
                            <span class="price">₹{{ number_format($product->price, 2) }}</span>
                            <span class="rating">⭐ {{ $product->rating ?? 4.5 }}</span>
                        </div>
                        <form method="POST" action="{{ route('customer.cart.add') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-primary">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="8" cy="21" r="1"></circle>
                                    <circle cx="19" cy="21" r="1"></circle>
                                    <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
                                </svg>
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="M21 21l-4.35-4.35"></path>
                    </svg>
                    <h3>No products found</h3>
                    <p>Try adjusting your search or filter</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Cart Tab -->
    <div id="cart" class="tab-content">
        @if($cartItems == 0)
            <div class="empty-cart">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="8" cy="21" r="1"></circle>
                    <circle cx="19" cy="21" r="1"></circle>
                    <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
                </svg>
                <h3>Your cart is empty</h3>
                <p>Start shopping to add items to your cart</p>
            </div>
        @else
            <div class="cart-layout">
                <div class="cart-items">
                    @foreach($cart as $item)
                        <div class="cart-item">
                            <div class="item-image">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                            </div>
                            <div class="item-details">
                                <h3>{{ $item['name'] }}</h3>
                                <p>{{ $item['description'] }}</p>
                                <p class="item-price">₹{{ number_format($item['price']) }}</p>
                            </div>
                            <div class="item-actions">
                                <form method="POST" action="{{ route('customer.cart.remove') }}" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                    <button type="submit" class="btn btn-outline btn-sm btn-red">Remove</button>
                                </form>
                                <div class="quantity-controls">
                                    <form method="POST" action="{{ route('customer.cart.update') }}" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                        <input type="hidden" name="delta" value="-1">
                                        <button type="submit" class="quantity-btn">-</button>
                                    </form>
                                    <span class="quantity">{{ $item['quantity'] }}</span>
                                    <form method="POST" action="{{ route('customer.cart.update') }}" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                        <input type="hidden" name="delta" value="1">
                                        <button type="submit" class="quantity-btn">+</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="order-summary">
                    <div class="summary-card">
                        <h3>Order Summary</h3>
                        <div class="summary-details">
                            <div class="summary-row">
                                <span>Subtotal:</span>
                                <span>₹{{ number_format($totalAmount, 2) }}</span>
                            </div>
                            <div class="summary-row">
                                <span>Shipping:</span>
                                <span class="free-shipping">FREE</span>
                            </div>
                            <div class="summary-divider"></div>
                            <div class="summary-row total-row">
                                <span>Total:</span>
                                <span>₹{{ number_format($totalAmount, 2) }}</span>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('customer.checkout') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-full">Checkout</button>
                        </form>
                        <p class="secure-payment">🔒 Secure payment powered by renewable energy</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/customer-script.js') }}"></script>
@endpush
