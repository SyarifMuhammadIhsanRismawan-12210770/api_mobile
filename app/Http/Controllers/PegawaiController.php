<?php

namespace App\Http\Controllers;

use App\Models\PegawaiModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PegawaiController extends Controller
{

    public function login()
    {
        $nip = request()->header('nip');
        $password = request()->header('password');

        $hasil = PegawaiModel::query()
            ->where('nip', $nip)->first();

        if ($hasil == null) {
            return response()->json([
                'pesan' => "NIP $nip pengguna tidak terdaftar"
            ], 404);
        } else if (Hash::check($password, $hasil->password)) {
            $hasil->token = Str::random(16);
            $hasil->save();

            return response()->json([
                'data' => $hasil
            ]);
        } else {

            return response()->json([
                'pesan' => 'NIP dan Kata sandi tidak cocok'
            ]);
        }
    }

    public function logout()
    {
        $id = request()->user()->id;
        $p = PegawaiModel::query()->where('id', $id)->first();

        if ($p != null) {
            $p->token = null;
            $p->save();
            return response()->json(['data' => 1]);
        } else {
            return response()->json([
                'pesan' => 'Logout tidak berhasil, pengguna tidak tersedia'
            ], 404);
        }
    }

    public function update()
    {
        $id = request()->user()->id;
        $p = PegawaiModel::query()->where('id', $id)->first();

        if ($p == null) {
            return response()->json([
                'pesan' => 'Pengguna tidak ditemukan'
            ], 404);
        }

        $p->nama_lengkap = request('nama_lengkap');
        $p->nip = request('nip');
        $r = $p->save();

        return response()->json([
            'data' => $p
        ], $r == true ? 200 : 406);
    }

    public function simpan_photo()
    {
        $id = request()->user()->id;
        $p = PegawaiModel::query()->where('id', $id)->first();

        if ($p == null) {
            return response()->json(['pesan' => 'Pengguna tidak terdaftar'], 404);
        }

        $b64foto = request('fie_foto');

        if (strlen($b64foto) < 1023) {
            return response()->json(['pesan' => 'file foto kurang ukurannya'], 406);
        }

        $foto = base64_decode($b64foto);
        $r = Storage::put("foto/$id.jpg", $foto);

        return response()->json([
            'data' => $r
        ], $r == true ? 200 : 406);
    }

    public function photo()
    {
        $id = request()->user()->id;
        $file = "foto/$id.jpg";

        if (Storage::exists($file) == false) {
            return response()->json([
                'pesan' => 'not found'
            ], 404);
        }

        $foto = Storage::get("foto/$id.jpg");

        return response()->withHeaders([
            'content-type' => 'image/jpeg'
        ])->setContent($foto)->send();
    }
}
