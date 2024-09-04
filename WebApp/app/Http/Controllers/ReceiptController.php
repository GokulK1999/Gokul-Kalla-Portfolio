<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Receipt; 
 
class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $receiptsQuery = Receipt::query();

    // Search functionality
    if ($request->has('search')) {
        $search = $request->input('search');
        $receiptsQuery->where('name', 'like', "%$search%")
                      ->orWhere('item', 'like', "%$search%");
    }

    // Sorting functionality
    $sortBy = $request->input('sort_by', 'created_at');
    $sortOrder = $request->input('sort_order', 'desc');
    $receiptsQuery->orderBy($sortBy, $sortOrder);

    // Pagination
    $receipts = $receiptsQuery->paginate(10);

    return view('receipt.index', compact('receipts'));
}
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('receipt.create');
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Receipt::create($request->all());
 
        return redirect()->route('receipt.index')->with('success', 'Receipt added successfully');
    }
 
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $receipt = Receipt::findOrFail($id);
 
        return view('receipt.show', compact('receipt'));
    }
 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $receipt = Receipt::findOrFail($id);
 
        return view('receipt.edit', compact('receipt'));
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $receipt = Receipt::findOrFail($id);
 
        $receipt->update($request->all());
 
        return redirect()->route('receipt.index')->with('success', 'Receipt updated successfully');
    }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $receipt = Receipt::findOrFail($id);
 
        $receipt->delete();
 
        return redirect()->route('receipt.index')->with('success', 'Receipt deleted successfully');
    }

    public function printReceipt($id)
{
    // Retrieve the receipt data by ID
    $receipt = Receipt::find($id);

    // Generate PDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $dompdf = new Dompdf($options);
    
    // Load HTML content (blade view)
    $html = view('receipt.print', compact('receipt'))->render();
    $dompdf->loadHtml($html);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the PDF
    $dompdf->render();

    // Output PDF to browser
    return $dompdf->stream('receipt.pdf');
}
}