@extends('layouts.app')

@section('title', 'Sign Up - RK Trading')

@section('content')
<div class="login-container">
    <!-- Animated Gradient Background -->
    <div class="animated-background"></div>

    <!-- Floating Shapes -->
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <!-- Decorative Icons -->
    <div class="decorative-icons">
        <div class="icon icon-sun">
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
        <div class="icon icon-leaf">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path>
                <line x1="16" y1="8" x2="2" y2="22"></line>
                <line x1="17.5" y1="15" x2="9" y2="15"></line>
            </svg>
        </div>
    </div>

    <!-- Sign Up Card -->
    <div class="login-card">
        <div class="card-header">
            <div class="logo">
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
            </div>
            <div class="title">
                <h1>RK Trading</h1>
                <p>Create Your Account</p>
            </div>
        </div>

        <div class="card-content">
            @if($errors->any())
                <div class="error-message">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('auth.register') }}" class="login-form">
                @csrf

                <!-- First Name -->
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <div class="input-group">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <input
                            type="text"
                            id="fname"
                            name="fname"
                            placeholder="Enter your first name"
                            value="{{ old('fname') }}"
                            required
                        >
                    </div>
                </div>

                <!-- Last Name -->
                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <div class="input-group">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <input
                            type="text"
                            id="lname"
                            name="lname"
                            placeholder="Enter your last name"
                            value="{{ old('lname') }}"
                            required
                        >
                    </div>
                </div>

                <!-- Middle Name (Optional) -->
                <div class="form-group">
                    <label for="mname">Middle Name <span class="optional">(Optional)</span></label>
                    <div class="input-group">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <input
                            type="text"
                            id="mname"
                            name="mname"
                            placeholder="Enter your middle name"
                            value="{{ old('mname') }}"
                        >
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-group">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <div class="input-group">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            placeholder="Enter your address"
                            value="{{ old('address') }}"
                            autocomplete="off"
                            required
                        >
                        <div id="address-suggestions" class="address-suggestions"></div>
                    </div>
                </div>

                <!-- Birthday -->
                <div class="form-group">
                    <label for="birthday">Birthday</label>
                    <div class="input-group">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <input
                            type="date"
                            id="birthday"
                            name="birthday"
                            value="{{ old('birthday') }}"
                            required
                        >
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <circle cx="12" cy="16" r="1"></circle>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                        >
                        <button type="button" class="password-toggle" id="password-toggle">
                            <svg class="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="input-group">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <circle cx="12" cy="16" r="1"></circle>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Confirm your password"
                            required
                        >
                    </div>
                </div>

                <!-- Sign Up Button -->
                <button type="submit" class="signin-btn">
                    <span>Sign Up</span>
                </button>

                <!-- Sign In Link -->
                <div class="signup-link">
                    Already have an account? <a href="{{ route('auth.login') }}">Sign in</a>
                </div>
            </form>

            <!-- Powered by Renewable Energy -->
            <div class="powered-by">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path>
                    <line x1="16" y1="8" x2="2" y2="22"></line>
                    <line x1="17.5" y1="15" x2="9" y2="15"></line>
                </svg>
                <span>Powered by Renewable Energy</span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/script.js') }}"></script>
<script>
    // Address autocomplete functionality without Google Maps API
    document.addEventListener('DOMContentLoaded', function() {
        const addressInput = document.getElementById('address');
        const suggestionsDiv = document.getElementById('address-suggestions');

        if (!addressInput || !suggestionsDiv) {
            console.error('Address input or suggestions div not found');
            return;
        }

        // Sample address data (you can expand this with more addresses)
        const addressData = [
            '123 Main Street, New York, NY 10001',
            '456 Oak Avenue, Los Angeles, CA 90210',
            '789 Pine Road, Chicago, IL 60601',
            '321 Elm Street, Houston, TX 77001',
            '654 Maple Drive, Phoenix, AZ 85001',
            '987 Cedar Lane, Philadelphia, PA 19101',
            '147 Birch Boulevard, San Antonio, TX 78201',
            '258 Willow Way, San Diego, CA 92101',
            '369 Spruce Court, Dallas, TX 75201',
            '741 Ash Terrace, San Jose, CA 95101',
            '852 Poplar Place, Austin, TX 78701',
            '963 Fir Street, Jacksonville, FL 32099',
            '159 Hemlock Road, Fort Worth, TX 76101',
            '357 Juniper Avenue, Columbus, OH 43201',
            '468 Redwood Drive, Indianapolis, IN 46201',
            '579 Sycamore Lane, Charlotte, NC 28201',
            '680 Magnolia Boulevard, San Francisco, CA 94101',
            '791 Dogwood Court, Seattle, WA 98101',
            '802 Chestnut Street, Denver, CO 80201',
            '913 Hickory Road, Boston, MA 02101'
        ];

        let currentFocus = -1;

        // Function to show suggestions
        function showSuggestions(value) {
            if (!value) {
                suggestionsDiv.innerHTML = '';
                return;
            }

            const filteredAddresses = addressData.filter(address =>
                address.toLowerCase().includes(value.toLowerCase())
            ).slice(0, 5); // Limit to 5 suggestions

            if (filteredAddresses.length === 0) {
                suggestionsDiv.innerHTML = '';
                return;
            }

            const suggestionsHtml = filteredAddresses.map((address, index) =>
                `<div class="suggestion-item" data-index="${index}">${address}</div>`
            ).join('');

            suggestionsDiv.innerHTML = suggestionsHtml;
            suggestionsDiv.style.display = 'block';
            currentFocus = -1;
        }

        // Function to hide suggestions
        function hideSuggestions() {
            setTimeout(() => {
                suggestionsDiv.style.display = 'none';
            }, 150);
        }

        // Input event listener
        addressInput.addEventListener('input', function(e) {
            showSuggestions(e.target.value);
        });

        // Keydown event listener for navigation
        addressInput.addEventListener('keydown', function(e) {
            const items = suggestionsDiv.querySelectorAll('.suggestion-item');

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                currentFocus = currentFocus < items.length - 1 ? currentFocus + 1 : 0;
                updateFocus(items);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                currentFocus = currentFocus > 0 ? currentFocus - 1 : items.length - 1;
                updateFocus(items);
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (currentFocus >= 0 && items[currentFocus]) {
                    selectSuggestion(items[currentFocus]);
                }
            } else if (e.key === 'Escape') {
                hideSuggestions();
                currentFocus = -1;
            }
        });

        // Function to update focus styling
        function updateFocus(items) {
            items.forEach((item, index) => {
                if (index === currentFocus) {
                    item.classList.add('focused');
                } else {
                    item.classList.remove('focused');
                }
            });
        }

        // Function to select a suggestion
        function selectSuggestion(item) {
            addressInput.value = item.textContent;
            suggestionsDiv.innerHTML = '';
            suggestionsDiv.style.display = 'none';
            currentFocus = -1;
        }

        // Click event listener for suggestions
        suggestionsDiv.addEventListener('click', function(e) {
            if (e.target.classList.contains('suggestion-item')) {
                selectSuggestion(e.target);
            }
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!addressInput.contains(e.target) && !suggestionsDiv.contains(e.target)) {
                hideSuggestions();
            }
        });

        console.log('Address autocomplete initialized without Google Maps API');
    });
</script>
@endpush
