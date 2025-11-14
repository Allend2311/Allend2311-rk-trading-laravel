<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderTracking;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->is_admin) {
                return redirect()->route('customer.dashboard');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $stats = $this->getDashboardStats();
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $topProducts = Product::select('products.*')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->selectRaw('SUM(order_items.quantity) as total_sold, SUM(order_items.quantity * order_items.price) as total_revenue')
            ->groupBy('products.id')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'topProducts'));
    }

    public function products()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|in:light,fan,accessory',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|url',
        ]);

        Product::create($request->all());

        return redirect()->route('admin.products')->with('success', 'Product added successfully!');
    }

    public function orders()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'description' => 'nullable|string',
        ]);

        $order->update(['status' => $request->status]);

        if ($request->description) {
            OrderTracking::create([
                'order_id' => $order->id,
                'status' => $request->status,
                'description' => $request->description,
            ]);
        }

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    private function getDashboardStats()
    {
        return [
            'total_sales' => Order::where('status', '!=', 'cancelled')->sum('total_amount'),
            'total_orders' => Order::count(),
            'active_orders' => Order::whereIn('status', ['pending', 'processing', 'shipped'])->count(),
            'total_customers' => User::customers()->count(),
            'total_products' => Product::active()->count(),
        ];
    }
}
