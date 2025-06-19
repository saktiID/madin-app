<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Santri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class DataSantriController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render(
            'Admin/MasterData/DataSantri/DataSantri',
            [
                'santri' => Inertia::defer(
                    fn() =>
                    Santri::orderBy('nama', 'asc')

                        ->when($request->search, function ($query) use ($request) {
                            $query
                                ->where('nama', 'like', '%' . $request->search . '%')
                                ->orWhere('nis', 'like', '%' . $request->search . '%');
                        })
                        ->paginate($request->perpage ?? 10)
                        ->onEachSide(1)
                        ->withQueryString()
                )
            ]

        );
    }

    public function destroy(Request $request): RedirectResponse
    {

        $id = $request->input('id');
        $ids = collect($id)->flatten()->toArray(); // Pastikan array satu dimensi

        $editing = $request->input('editing', false);

        $deletedRows = Santri::whereIn('id', $ids)->delete();
        if ($deletedRows === 0) {
            return redirect()->back()
                ->with('error', 'Data santri tidak ditemukan.');
        }

        if ($editing) {
            return redirect()->to(route('admin.master-data.data-santri.index', ['deleted' => true]))
                ->with('success', 'Data santri berhasil dihapus.');
        }

        return redirect()->back()
            ->with('success', 'Data santri berhasil dihapus.');
    }
}
