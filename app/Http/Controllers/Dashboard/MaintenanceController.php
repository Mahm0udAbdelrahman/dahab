<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\MaintenanceService;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function __construct(public MaintenanceService $MaintenanceService)
    {}
    public function index(Request $request)
    {
        $maintenances = $this->MaintenanceService->index();
        return view('dashboard.pages.maintenances.index', compact('maintenances'));
    }

    public function show($id)
    {
        $maintenance = $this->MaintenanceService->show($id);
        return view('dashboard.pages.maintenances.show', compact('maintenance'));
    }

    public function edit($id)
    {
        $maintenance = $this->MaintenanceService->show($id);

        return view('dashboard.pages.maintenances.edit', compact('maintenance'));
    }

    public function destroy(string $id)
    {
        $this->MaintenanceService->destroy($id);

        return redirect()->route('Admin.maintenances.index')->with('success', 'Maintenance Successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
        ]);

        $this->MaintenanceService->bulkDelete($request->ids);

        return redirect()->back()->with('success', 'Maintenance deleted successfully');
    }
}
