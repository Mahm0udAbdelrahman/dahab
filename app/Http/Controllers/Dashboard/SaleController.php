<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\SaleService;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct(public SaleService $SaleService)
    {}
    public function index(Request $request)
    {
        $sales = $this->SaleService->index();
        return view('dashboard.pages.sales.index', compact('sales'));
    }

    public function show($id)
    {
        $sale = $this->SaleService->show($id);
        return view('dashboard.pages.sales.show', compact('sale'));
    }

    public function destroy(string $id)
    {
        $this->SaleService->destroy($id);

        return redirect()->route('Admin.sales.index')->with('success', 'Sale Successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
        ]);

        $this->SaleService->bulkDelete($request->ids);

        return redirect()->back()->with('success', 'Sale deleted successfully');
    }
}
