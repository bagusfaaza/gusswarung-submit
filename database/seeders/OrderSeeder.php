<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Menunggu Pembayaran',
            'Sedang Diproses',
            'Dikirim',
            'Selesai',
            'Dibatalkan'
        ];

        $paymentMethods = ['cash', 'qris', 'transfer'];

        // 🔥 TOTAL DATA ± 1 TAHUN (rata-rata 1 order/hari)
        $totalOrders = rand(360, 420);

        for ($i = 1; $i <= $totalOrders; $i++) {

            $subtotal = rand(100000, 500000) * 10;
            $ppnRate = 0.11;
            $ppnAmount = $subtotal * $ppnRate;
            $shippingFee = rand(0, 1) ? rand(10000, 50000) : 0;
            $totalAmount = $subtotal + $ppnAmount + $shippingFee;

            $status = $statuses[array_rand($statuses)];
            $paymentMethod = $paymentMethods[array_rand($paymentMethods)];

            $paymentProofPath = null;
            if ($status !== 'Menunggu Pembayaran' && $paymentMethod !== 'cash') {
                $paymentProofPath = 'payments/' . Str::random(10) . '.jpg';
            }

            // 🗓️ RANDOM TANGGAL DALAM 1 TAHUN TERAKHIR
            $createdAt = Carbon::now()
                ->subDays(rand(0, 364))
                ->subHours(rand(0, 23))
                ->subMinutes(rand(0, 59));

            $updatedAt = clone $createdAt;

            if (in_array($status, ['Selesai', 'Dibatalkan'])) {
                $updatedAt = (clone $createdAt)->addDays(rand(1, 7));
            }

            DB::table('orders')->insert([
                'customer_name' => 'Pelanggan ' . $i,
                'customer_phone' => '08' . rand(100000000, 999999999),
                'customer_address' => 'Jl. Contoh No. ' . rand(1, 200) . ', Kota Demo',
                'notes' => rand(0, 1) ? 'Mohon diproses cepat.' : null,
                'payment_method' => $paymentMethod,
                'subtotal' => round($subtotal),
                'ppn_amount' => round($ppnAmount),
                'shipping_fee' => $shippingFee,
                'total_amount' => round($totalAmount),
                'payment_proof_path' => $paymentProofPath,
                'status' => $status,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
        }
    }

}