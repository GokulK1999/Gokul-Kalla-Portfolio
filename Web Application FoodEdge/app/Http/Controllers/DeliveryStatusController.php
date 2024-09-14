<?php

namespace App\Http\Controllers;

use App\Models\DeliveryStatus;
use Illuminate\Http\Request;

class DeliveryStatusController extends Controller
{
    public function index()
    {
        $statuses = DeliveryStatus::all();
        return view('delivery_status.index', compact('statuses'));
    }

    public function create()
    {
        return view('delivery_status.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'status' => 'required|in:pending,successful,completed',
        ]);

        DeliveryStatus::create($request->all());

        return redirect()->route('delivery_status.index')->with('success', 'Delivery status added successfully');
    }

    public function update(Request $request, DeliveryStatus $deliveryStatus)
    {
        $request->validate([
            'status' => 'required|in:pending,successful,completed',
        ]);

        $deliveryStatus->update($request->all());

        return redirect()->route('delivery_status.index')->with('success', 'Status updated successfully');
    }

    public function destroy(DeliveryStatus $deliveryStatus)
    {
        $deliveryStatus->delete();
        return redirect()->route('delivery_status.index')->with('success', 'Delivery status deleted successfully');
    }
}
