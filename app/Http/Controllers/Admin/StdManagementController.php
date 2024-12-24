<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\StdManagementImport;
use App\Models\StdManagement;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StdManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = StdManagement::whereIn('status', ['upcoming', 'completed'])
            ->latest()
            ->get();

        return view('admin.pages.std_mgt.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.std_mgt.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create the event in the database
        StdManagement::create([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'experience' => $request->experience,

        ]);

        return redirect()->route('admin.std-mgt.index')->with('success', 'Data Inserted Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = StdManagement::findOrFail($id);
        return view('admin.pages.std_mgt.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = StdManagement::findOrFail($id);

        // Update the item with new values
        $item->update([

            // 'name' => $request->name,
            // 'email' => $request->email,
            // 'phone' => $request->phone,
            // 'experience' => $request->experience,
            'date' => $request->date,
            'status' => $request->status,

        ]);

        return redirect()->route('admin.std-mgt.index')->with('success', 'Data Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = StdManagement::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.std-mgt.index')->with('success', 'Data Delete Successfully!!');
    }

    // Method for batch update
    public function batchUpdate(Request $request)
    {
        // Validate the input data
        $request->validate([
            'ids' => 'nullable|string', // Ensure 'ids' is a comma-separated string
            'status' => 'nullable|in:upcoming,completed', // Valid status options
            'date' => 'nullable', // Optional date field
        ]);

        // If ids are passed as a comma-separated string, split them into an array
        $ids = explode(',', $request->ids); // Convert the comma-separated string into an array

        // Update the selected records in the database
        StdManagement::whereIn('id', $ids)
            ->update([
                'status' => $request->status,
                'date' => $request->date,
            ]);

        return redirect()->route('admin.std-mgt.index')->with('success', 'Batch update successful!');
    }

    public function showData()
    {
        $items = StdManagement::where('status', null)->latest()->get();
        return view('admin.pages.std_mgt.show_data', compact('items'));
    }

    public function importExcel()
    {
        return view('admin.pages.std_mgt.import_excel');
    }

    public function importExcelData(Request $request)
    {
        $request->validate([
            'import_file' => [
                'required',
                'file',
            ],
        ]);

        Excel::import(new StdManagementImport, $request->file('import_file'));

        return redirect()->route('admin.show.data')->with('status', 'Imported Successfully');
    }

}
