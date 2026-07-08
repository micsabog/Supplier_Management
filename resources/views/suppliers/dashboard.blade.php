@extends('layouts.erp')

@section('breadcrumb', 'Supplier Management')

@section('content')
    <div class="flex items-center justify-between mb-1">
        <h1 class="text-2xl font-bold flex items-center gap-2">🌱 Supplier Management</h1>
    </div>
    <p class="text-gray-500 mb-6">Manage and evaluate your agricultural suppliers</p>

    {{-- KPI cards --}}
    <div class="grid grid-cols-4 gap-4 mb-6">
        <a href="{{ route('suppliers.index') }}" class="bg-white rounded-xl border p-4 hover:shadow transition">
            <div class="text-sm text-gray-500">Total Supplier</div>
            <div class="text-2xl font-bold">{{ $stats['total'] }}</div>
            <div class="text-xs text-green-600">↑ 8 this month</div>
        </a>
        <a href="{{ route('suppliers.active') }}" class="bg-white rounded-xl border p-4 hover:shadow transition">
            <div class="text-sm text-gray-500">Active Suppliers</div>
            <div class="text-2xl font-bold">{{ $stats['active'] }}</div>
            <div class="text-xs text-green-600">{{ round(($stats['active'] / max($stats['total'], 1)) * 100) }}% of total</div>
        </a>
        <a href="{{ route('suppliers.pending') }}" class="bg-white rounded-xl border p-4 hover:shadow transition">
            <div class="text-sm text-gray-500">Pending Verification</div>
            <div class="text-2xl font-bold">{{ $stats['pending'] }}</div>
            <div class="text-xs text-yellow-600">Requires to review</div>
        </a>
        <a href="{{ route('suppliers.blacklisted') }}" class="bg-white rounded-xl border p-4 hover:shadow transition">
            <div class="text-sm text-gray-500">Blacklisted Suppliers</div>
            <div class="text-2xl font-bold">{{ $stats['blacklisted'] }}</div>
            <div class="text-xs text-red-600">{{ round(($stats['blacklisted'] / max($stats['total'], 1)) * 100) }}% of total</div>
        </a>
    </div>

    <div class="grid grid-cols-3 gap-6 mb-6">
        {{-- Supplier list overview --}}
        <div class="col-span-2 bg-white rounded-xl border p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-semibold text-lg">Supplier List Overview</h2>
                <a href="{{ route('suppliers.create') }}" class="bg-green-700 text-white text-sm px-3 py-1.5 rounded-lg">+ Add Supplier</a>
            </div>
            <table class="w-full text-sm">
                <thead class="text-gray-400 text-left">
                    <tr>
                        <th class="pb-2">Supplier</th>
                        <th class="pb-2">Products</th>
                        <th class="pb-2">Location</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $s)
                        <tr class="border-t">
                            <td class="py-3">
                                <a href="{{ route('suppliers.show', $s['slug']) }}" class="hover:text-green-700">
                                    <div class="font-medium">{{ $s['name'] }}</div>
                                    <div class="text-xs text-gray-400">{{ $s['supplier_id'] }}</div>
                                </a>
                            </td>
                            <td class="py-3 text-gray-600">{{ $s['products_list'] }}</td>
                            <td class="py-3 text-gray-600">📍 {{ $s['location'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('suppliers.index') }}" class="text-green-700 text-sm inline-block mt-3">View all suppliers →</a>
        </div>

        {{-- Product supplied donut (static legend) --}}
        <div class="bg-white rounded-xl border p-5">
            <h2 class="font-semibold text-lg mb-4">Product Supplied</h2>
            <ul class="text-sm space-y-2">
                <li class="flex justify-between"><span>🟢 Rice</span><span>40%</span></li>
                <li class="flex justify-between"><span>🟠 Fruits</span><span>30%</span></li>
                <li class="flex justify-between"><span>🟢 Vegetables</span><span>20%</span></li>
                <li class="flex justify-between"><span>⚪ Others</span><span>10%</span></li>
            </ul>

            <h2 class="font-semibold text-lg mt-6 mb-3">Top Suppliers (by Orders)</h2>
            <ol class="text-sm space-y-3">
                @foreach ($suppliers as $s)
                    <li>
                        <a href="{{ route('suppliers.show', $s['slug']) }}" class="flex justify-between hover:text-green-700">
                            <span>{{ $s['name'] }}</span>
                            <span class="text-gray-400">{{ $s['total_orders'] }} orders</span>
                        </a>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>

    {{-- Performance overview --}}
    <div class="bg-white rounded-xl border p-5">
        <h2 class="font-semibold text-lg mb-4">Supplier Performance Overview</h2>
        <div class="grid grid-cols-4 gap-4">
            <div class="bg-gray-50 rounded-xl p-4">
                <div class="text-sm text-gray-500">Avarage Rating</div>
                <div class="text-xl font-bold">4.6 / 5</div>
                <div class="text-xs text-green-600">↑ 0.2 from last month</div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <div class="text-sm text-gray-500">On-time Delivery</div>
                <div class="text-xl font-bold">92%</div>
                <div class="text-xs text-green-600">↑ 5% from last month</div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <div class="text-sm text-gray-500">Total Orders</div>
                <div class="text-xl font-bold">245</div>
                <div class="text-xs text-green-600">↑ 18 this month</div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <div class="text-sm text-gray-500">Quality Score</div>
                <div class="text-xl font-bold">4.6 / 5</div>
                <div class="text-xs text-green-600">↑ 0.3 from last month</div>
            </div>
        </div>
    </div>
@endsection
