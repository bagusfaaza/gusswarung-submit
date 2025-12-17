<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Expense;
use App\Models\Menu;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        /* =========================================================
         | 1️⃣ FILTER TANGGAL + 10 TRANSAKSI TERBARU
         ========================================================= */
        $tanggal = $request->query('tanggal');

        $latestOrdersQuery = Order::query()
            ->orderBy('created_at', 'desc');

        if (!empty($tanggal)) {
            // Jika pakai filter tanggal → tampilkan semua transaksi di tanggal tsb
            $latestOrdersQuery->whereDate('created_at', $tanggal);
        } else {
            // Default → 10 transaksi terbaru
            $latestOrdersQuery->limit(10);
        }

        $latestOrders = $latestOrdersQuery->get();

        /* =========================================================
         | 2️⃣ DETAIL MENU (order_details)
         ========================================================= */
        $orderIds = $latestOrders->pluck('id')->toArray();

        $orderDetails = OrderDetail::whereIn('order_id', $orderIds)->get();

        /* =========================================================
         | 3️⃣ STATISTIK HARIAN
         ========================================================= */
        $today = Carbon::today();

        $todaySales = Order::whereDate('created_at', $today)->sum('total_amount');

        $todayTransactions = Order::whereDate('created_at', $today)->count();

        /* =========================================================
         | 4️⃣ RATA-RATA PENJUALAN HARIAN (BULAN INI)
         ========================================================= */
        $averageDailySales = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_amount) as total')
        )
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get()
            ->avg('total');

        /* =========================================================
         | 5️⃣ GRAFIK PENJUALAN TAHUNAN
         ========================================================= */
        $yearlySales = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_amount) as total')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get();

        /* =========================================================
         | 6️⃣ LAPORAN METODE PEMBAYARAN
         ========================================================= */
        $paymentMethodReport = Order::select(
            'payment_method',
            DB::raw('COUNT(*) as total_transactions'),
            DB::raw('SUM(total_amount) as total_sales')
        )
            ->groupBy('payment_method')
            ->orderByDesc('total_transactions')
            ->get();

        /* =========================================================
         | 7️⃣ DATA INVENTARIS
         ========================================================= */
        $totalInventaris = Menu::count();
        $lowStockCount = Menu::where('stok', '<=', 5)->count();

        /* =========================================================
         | 8️⃣ RINGKASAN TRANSAKSI (QTY & TOTAL QTY)
         ========================================================= */
        $transactionSummary = [];

        foreach ($latestOrders as $order) {
            $details = $orderDetails->where('order_id', $order->id);

            if ($details->isEmpty())
                continue;

            $totalQty = 0;
            $items = [];

            foreach ($details as $detail) {
                $totalQty += $detail->quantity;
                $items[] = [
                    'product_name' => $detail->product_name,
                    'quantity' => $detail->quantity,
                    'total_price' => $detail->total_price,
                ];
            }

            $transactionSummary[] = [
                'order_id' => $order->id,
                'items' => $items,
                'total_qty' => $totalQty,
            ];
        }

        $transactionSummary = collect($transactionSummary);

        /* =========================================================
         | 9️⃣ MENU TERLARIS MINGGU INI (GRAFIK)
         ========================================================= */
        $bestSellingMenus = DB::table('order_details')
            ->select(
                'product_name',
                DB::raw('SUM(quantity) as total_sold')
            )
            ->groupBy('product_name')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        /* =========================================================
         | 🔟 PENDAPATAN BULAN INI
         ========================================================= */
        $monthlyRevenue = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->where('status', 'Selesai')
            ->sum('total_amount');

        /* =========================================================
         | 🔥 PENGELUARAN BULAN INI
         ========================================================= */
        $monthlyExpense = Expense::whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');

        /* ================= LABA BERSIH ================= */
        $netProfit = $monthlyRevenue - $monthlyExpense;

        /* =========================================================
         | 1️⃣1️⃣ KIRIM KE VIEW
         ========================================================= */
        return view('laporan', compact(
            'latestOrders',
            'transactionSummary',
            'todaySales',
            'todayTransactions',
            'averageDailySales',
            'yearlySales',
            'paymentMethodReport',
            'totalInventaris',
            'lowStockCount',
            'bestSellingMenus',
            'monthlyRevenue',
            'monthlyExpense',
            'netProfit',
            'tanggal'
        ));
    }
}
