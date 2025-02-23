<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\User;
use App\Models\Mahasiswa;

use Illuminate\Support\Str;

use function PHPSTORM_META\map;

class UserController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $columns = $sheet->toArray();

        // Skip the header row
        array_shift($columns);
        
        foreach ($columns as $col) {
            // dd($col); // Tampilkan data untuk debugging

            if (empty($col[0]) || empty($col[1]) || empty($col[2]) || empty($col[3])) {
                continue; // Skip baris jika ada data yang kosong
            }
            $randomCode = Str::random(5);
            User::create([
                'username' => $col[0],
                'nama' => $col[1],
                'email' => $col[2],
                'password' =>$randomCode,
                'role_user' => $col[3]
            ]);
            Mahasiswa::create([
                "nim" => $col[0],
                'tahun_masuk' => $col[4],
                'kelas' => $col[5],
                "prodi" => $col[6],
                "status_ta" => $col[7],
                "id_kota" => NULL
            ]);
        }

        return redirect()->back()->with('success', 'Data imported successfully!');
    }
}