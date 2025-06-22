<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Ustadz;
use App\Models\FileData;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\ExportService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Services\TemplateAsatidzService;
use Inertia\Response as InertiaResponse;
use Intervention\Image\Drivers\Gd\Driver;

class DataAsatidzController extends Controller
{
    /** 
     * Index ustadz
     */
    public function index(Request $request): InertiaResponse
    {
        return Inertia::render(
            'Admin/MasterData/DataAsatidz/DataAsatidz',
            [
                'asatidz' => Inertia::defer(
                    fn() =>
                    User::query()
                        ->with('ustadz:user_id,id')
                        ->whereHas('ustadz') // hanya user yang punya ustadz
                        ->whereNot('role', 'admin')
                        ->when($request->search, function ($query) use ($request) {
                            $query->where(function ($q) use ($request) {
                                $q->where('name', 'like', '%' . $request->search . '%')
                                    ->orWhere('email', 'like', '%' . $request->search . '%');
                            });
                        })
                        ->orderBy('name', 'asc')
                        ->paginate($request->perpage ?? 5)
                        ->onEachSide(1)
                        ->withQueryString()
                )
            ]

        );
    }

    /** 
     * Add page for the ustadz
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('Admin/MasterData/DataAsatidz/Create');
    }

    /** 
     * Save the ustadz
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi data yang diterima
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:ustadzs',
            'gender' => 'required|string|max:10',
        ]);

        // Simpan data ustadz baru
        DB::beginTransaction();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'ustadz',
            'avatar' => null,
        ]);

        Ustadz::create([
            'user_id' => $user->id,
            'no_telepon' => $request->no_telepon,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'gender' => $request->gender,
        ]);
        DB::commit();

        if (!$user) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan data asatidz. Silakan coba lagi.');
        }

        return redirect()->back()
            ->with('success', 'Data asatidz berhasil ditambahkan.');
    }

    /** 
     * Edit page for the ustadz
     */
    public function edit($id): InertiaResponse
    {
        return Inertia::render('Admin/MasterData/DataAsatidz/Edit', [
            'ustadz' => User::with('ustadz')->findOrFail($id),
        ]);
    }

    /**
     * Update the user's avatar.
     */
    public function updateAvatar(Request $request): RedirectResponse
    {
        // Validasi file yang diupload
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        // Ambil file yang diupload
        $file = $request->file('avatar');
        $filename = 'avatar_' . Str::random(5);
        $path = 'app/private/avatars/';
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->resize(250, 250);
        $encoded = $image->toPng();
        $encoded->save(storage_path($path . $filename . '.png'));

        $updatedAvatar = $user_id = $request->id;
        User::where('id', $user_id)->update([
            'avatar' => $filename . '.png',
        ]);

        if (!$updatedAvatar) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui avatar. Silakan coba lagi.');
        }

        return redirect()->back()
            ->with('success', 'Avatar berhasil diperbarui.');
    }

    /**
     * Update the user's profile.
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = User::find($request->id);
        if ($user->email !== $request->email) {
            // Validasi data yang diterima
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'email|max:255|unique:users',
            ]);
        }

        // Validasi data yang diterima
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $updatedUser = User::where('id', $request->id)->update($validatedData);

        if (!$updatedUser) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui profil. Silakan coba lagi.');
        }

        return redirect()->back()
            ->with('success', 'Profil berhasil diperbarui.');
    }

    /** 
     * Update the ustadz's password
     */
    public function updatePassword(Request $request): RedirectResponse
    {

        // Validasi data yang diterima
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $updatedPassword = $user_id = $request->id;
        User::where('id', $user_id)->update([
            'password' => Hash::make($request->password),
        ]);

        if (!$updatedPassword) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui password. Silakan coba lagi.');
        }

        return redirect()->back()
            ->with('success', 'Password berhasil diperbarui.');
    }

    /**
     * Update the ustadz's data.
     */
    public function updateUstadz(Request $request): RedirectResponse
    {
        $ustadz = Ustadz::find($request->id);
        if ($ustadz->nik !== $request->nik) {
            // Validasi data yang diterima
            $validatedData = $request->validate([
                'no_telepon' => 'required|string|max:15',
                'alamat' => 'required|string|max:255',
                'nik' => 'required|string|max:16|min:16|unique:ustadzs'
            ]);
        }

        // Validasi data yang diterima
        $validatedData = $request->validate([
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);


        $updatedUstadz = Ustadz::where('id', $request->id)
            ->update($validatedData);

        if (!$updatedUstadz) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data ustadz. Silakan coba lagi.');
        }

        return redirect()->back()
            ->with('success', 'Data ustadz berhasil diperbarui.');
    }

    /** 
     * Delete the ustadz
     */
    public function destroy(Request $request): RedirectResponse
    {

        $id = $request->input('id');
        $ids = collect($id)->flatten()->toArray(); // Pastikan array satu dimensi

        $editing = $request->input('editing', false);

        $deletedRows = User::whereIn('id', $ids)->delete();
        if ($deletedRows === 0) {
            return redirect()->back()
                ->with('error', 'Data asatidz tidak ditemukan.');
        }

        if ($editing) {
            return redirect()->to(route('admin.master-data.data-asatidz.index', ['deleted' => true]))
                ->with('success', 'Data asatidz berhasil dihapus.');
        }

        return redirect()->back()
            ->with('success', 'Data asatidz berhasil dihapus.');
    }

    /**
     * Export data asatidz in spreadsheet format
     */
    public function export()
    {
        ExportService::export_asatidz();
    }

    /**
     * Upload page for data asatidz
     */
    public function upload(): InertiaResponse
    {
        return Inertia::render('Admin/MasterData/DataAsatidz/Upload', [
            'files' => Inertia::defer(
                fn() =>
                FileData::where('data_for', 'asatidz')
                    ->orderByDesc('created_at')
                    ->get()
            )
        ]);
    }

    // Upload file Asatidz
    public function upload_file(Request $request): RedirectResponse
    {
        // Validasi file yang diupload
        $request->validate([
            'file' => 'required|mimes:xls,xlsx|max:3072',
        ]);

        // Verifikasi
        $verify = TemplateAsatidzService::verify_template($request->file);
        if ($verify['status'] === false) {
            return redirect()->back()
                ->with('error', $verify['msg']);
        }

        // Ambil file yang diupload
        $file = $request->file('file');
        $fileSize = $request->file('file')->getSize();
        $fileSizeKB = round($fileSize / 1024, 2);
        $extension = $file->getClientOriginalExtension();
        $filename = 'template_asatidz_' . date('dmyHis', time()) . '.' . $extension;
        $path = 'file-template/';

        // simpan di storage
        $file->storeAs($path, $filename);

        // simpan database
        $data = FileData::create([
            'filename' => $filename,
            'filesize' => $fileSizeKB,
            'data_for' => 'asatidz',
            'is_imported' => false,
            'log' => null,
        ]);

        if (!$data) {
            return redirect()->back()
                ->with('error', 'Gagal upload file.');
        }
        return redirect()->back()
            ->with('success', 'Berhasil upload file.');
    }

    /**
     * Verify file
     */
    public function parsing(Request $request)
    {
        $path = Storage::path("file-template/" . $request->filename);
        $parsing = TemplateAsatidzService::parsing($path, $request->id);
        if ($parsing) {
            return response()->json(['status' => true, 'msg' => 'Parsing selesai']);
        } else {
            return response()->json(['status' => false, 'msg' => 'Parsing gagal']);
        }
    }

    /**
     * Polling progress
     */
    public function polling(Request $request)
    {
        $id = $request->get('id');
        $progress = Cache::get("import_progress_{$id}", 0);
        return response()->json(['progress' => $progress]);
    }

    /**
     * Download existed file 
     */
    public function download(Request $request)
    {
        $filename = $request->input('filename');
        $path = "file-template/" . $filename;

        if (!Storage::exists($path)) {
            abort(404, "File tidak ditemukan.");
        }

        return Storage::download($path);
    }

    /**
     * Download template
     */
    public function download_template()
    {
        TemplateAsatidzService::download_template();
    }

    /**
     * Delete file
     */
    public function delete_file(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $data = FileData::findOrFail($id);

        try {
            if ($data->filename) {
                Storage::delete('file-template/' . $data->filename);
            }
        } catch (\Exception $e) {
            Log::error('Proses delete file gagal.', [
                'error' => $e->getMessage(),
            ]);
        }

        $delete = $data->delete();

        if (!$delete) {
            return redirect()->back()
                ->with('error', 'Gagal hapus file.');
        }
        return redirect()->back()
            ->with('success', 'Berhasil hapus file.');
    }
}
