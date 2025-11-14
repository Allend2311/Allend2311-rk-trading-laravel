<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $products = Product::active()->get();
        $cart = Session::get('cart', []);
        $cartCount = count($cart);
        $cartTotal = $this->calculateCartTotal($cart);

        return view('customer.dashboard', compact('products', 'cart', 'cartCount', 'cartTotal'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = Session::get('cart', []);

        $productId = $product->id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'description' => $product->description,
                'category' => $product->category,
                'image' => $product->image,
                'rating' => $product->rating,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', "{$product->name} added to cart!");
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        $cart = Session::get('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    public function updateCartQuantity(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'delta' => 'required|integer|in:-1,1',
        ]);

        $cart = Session::get('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $request->delta;

            if ($cart[$productId]['quantity'] <= 0) {
                unset($cart[$productId]);
            }

            Session::put('cart', $cart);
        }

        return redirect()->back();
    }

    public function checkout(Request $request)
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        // Create order
        $orderNumber = 'ORD-' . date('Y-m-d') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $totalAmount = $this->calculateCartTotal($cart);

        $order = Order::create([
            'order_number' => $orderNumber,
            'user_id' => auth()->id(),
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'shipping_address' => auth()->user()->address,
        ]);

        // Create order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear cart
        Session::forget('cart');

        return redirect()->route('customer.orders')->with('success', 'Order placed successfully!');
    }

    public function orders()
    {
        $orders = auth()->user()->orders()->with('orderItems.product')->latest()->get();
        return view('customer.orders', compact('orders'));
    }

    public function trackOrder(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string',
        ]);

        $order = Order::where('order_number', $request->order_number)
                     ->where('user_id', auth()->id())
                     ->with('orderTracking')
                     ->first();

        if (!$order) {
            return view('customer.track', ['error' => 'Order not found.']);
        }

        $trackingData = $this->generateTrackingData($order);

        return view('customer.track', compact('order', 'trackingData'));
    }

    public function showTrackForm()
    {
        return view('customer.track');
    }

    private function calculateCartTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    private function generateTrackingData($order)
    {
        $tracking = [];

        // Add order tracking entries
        foreach ($order->orderTracking as $track) {
            $tracking[] = [
                'id' => $track->id,
                'title' => ucfirst($track->status),
                'description' => $track->description ?: "Order status updated to {$track->status}",
                'timestamp' => $track->created_at->format('M j, Y g:i A'),
                'status' => 'completed',
                'icon' => $this->getStatusIcon($track->status),
            ];
        }

        // Add current status if not already included
        $currentStatus = [
            'id' => 'current',
            'title' => ucfirst($order->status),
            'description' => $this->getStatusDescription($order->status),
            'timestamp' => $order->updated_at->format('M j, Y g:i A'),
            'status' => 'current',
            'icon' => $this->getStatusIcon($order->status),
        ];

        if (!in_array($order->status, array_column($tracking, 'title'))) {
            $tracking[] = $currentStatus;
        }

        return $tracking;
    }

    private function getStatusIcon($status)
    {
        $icons = [
            'pending' => 'clock',
            'processing' => 'package',
            'shipped' => 'truck',
            'delivered' => 'check-circle',
            'cancelled' => 'x-circle',
        ];

        return $icons[$status] ?? 'circle';
    }

    private function getStatusDescription($status)
    {
        $descriptions = [
            'pending' => 'Your order is being processed',
            'processing' => 'Your order is being prepared',
            'shipped' => 'Your order is on its way',
            'delivered' => 'Your order has been delivered',
            'cancelled' => 'Your order has been cancelled',
        ];

        return $descriptions[$status] ?? 'Status update';
    }
}
