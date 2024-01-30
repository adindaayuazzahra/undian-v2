<?php

namespace App\Http\Controllers;

use App\Models\Display;
use App\Models\Hadiah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Peserta;


class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function login()
    {
        return view('login');
    }
    public function loginDo(Request $request)
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            return redirect()->route('admin.home');
        }
        return redirect()->route('login')->with('error', "Username atau password salah");
    }

    public function adminHome()
    {
        return view('dashboard');
    }


    public function logoutDo(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('error', "Berhasil Logout");
    }


    public function register()
    {
        return view('register');
    }

    public function registerDo(Request $request)
    {
        request()->validate([
            'nama' => 'required',
            'npp' => 'required|unique:peserta',
            'passcode' => 'required|numeric|digits:4',
            'unit' => 'required',
        ]);

        $peserta = new Peserta();
        $peserta->nama = strtoupper($request->nama);
        $peserta->npp = strtoupper($request->npp);
        $peserta->passcode = $request->passcode;
        $peserta->unit = $request->unit;
        $peserta->status = 0;
        $peserta->save();
        return redirect()->route('index')->with(['error' => "Berhasil melakukan registrasi. Silahkan Cetak dan scann Qrcode di panitia untuk keikutsertaan Doorprize", 'head' => "Berhasil Registrasi!", 'color' => 'success']);
    }

    public function cetak(Request $request)
    {
        $request->validate([
            'npp' => 'required',
            'passcode' => 'required'
        ]);

        $peserta = Peserta::with('hadiah')->where('npp', $request->npp)->where('passcode', $request->passcode)->first();
        if ($peserta && $peserta->passcode == $request->passcode) {
            return view('qrcode', compact('peserta'));
        } else {
            return redirect('/')->with(['error' => 'Kombinasi NPP dan Passcode tidak sesuai.', 'head' => 'Gagal Menampilkan Qrcode!', 'color' => 'danger']);
        }
    }

    public function scann()
    {
        return view('scann');
    }

    public function redeem(Request $request)
    {
        $npp = $request->npp;
        $peserta = Peserta::where('npp', $npp)->first();
        if (!$peserta) {
            return redirect()->route('scann')->with(['error' => 'NPP Peserta Tidak Ditemukan.', 'head' => 'NPP Salah!', 'color' => 'danger']);
        }
        if ($peserta && $peserta->status == 0) {
            $peserta->status = 1;
            $peserta->save();
            $nama = $peserta->nama;
            return redirect()->route('scann')->with(['error' => 'Berhasil Meredeem QrCode ' . $nama, 'head' => 'Berhasil!', 'color' => 'success']);
        } else if ($peserta && $peserta->status == 1 ||  $peserta->status == 2) {
            $nama = $peserta->nama;
            return redirect()->route('scann')->with(['error' => 'Peserta Sudah Meredeem Qrcode milik ' . $nama, 'head' => 'Qrcode Sudah Terpakai!', 'color' => 'danger']);
        }
    }

    public function listPeserta()
    {
        // $pesertas = Peserta::all();
        $pesertas = Peserta::with('hadiah')->get();
        return view('list_peserta', compact('pesertas'));
    }


    public function listHadiah()
    {
        $hadiahs = Hadiah::with('peserta')->get();
        return view('list_hadiah', compact('hadiahs'));
    }

    public function hadiahAddDo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_hadiah' => 'required',
            'foto' => 'required|mimes:png,jpg',
            'jumlah' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors->add('addHadiahErr', true);
            return redirect()->route('admin.list_hadiah')->withErrors($errors)->withInput();
        }
        $hadiah = new Hadiah();
        $gambar = $request->file('foto');
        $namaGambar = time() . '_' . $gambar->getClientOriginalName();
        $gambar->move(public_path('foto'), $namaGambar);

        $hadiah->nama_hadiah = strtoupper($request->nama_hadiah);
        $hadiah->foto = $namaGambar;
        $hadiah->jumlah = $request->jumlah;
        $hadiah->save();

        // Mendapatkan ID hadiah yang baru ditambahkan
        $newHadiahId = $hadiah->id;
        $display = new Display();
        $display->id_hadiah = $newHadiahId;
        $display->status = 0;
        $display->save();

        return redirect()->route('admin.list_hadiah');
    }


    /**
     * Update the specified resource in storage.
     */
    public function hadiahEditDo(Request $request, $id)
    {
        $hadiah = Hadiah::find($id);
        $validator = Validator::make($request->all(), [
            'nama_hadiah_edit' => 'required',
            'jumlah_edit' => 'required',
            'foto_edit' => 'mimes:png'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors->add('addHadiahErrEdit', true);
            return redirect()->route('admin.list_hadiah')->withErrors($errors)->withInput();
        }

        if ($request->foto_edit) {
            $gambar = $request->file('foto_edit');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('foto'), $namaGambar);
            $hadiah->foto = $namaGambar;
        };

        $hadiah->nama_hadiah = $request->nama_hadiah_edit;
        $hadiah->jumlah = $request->jumlah_edit;
        $hadiah->save();
        return redirect()->route('admin.list_hadiah');
    }

    public function hadiahDeleteDo($id)
    {
        $hadiah = Hadiah::find($id);
        if ($hadiah) {


            // Hapus entri hadiah dari database
            $peserta = Peserta::where('id_hadiah', $id)->get();
            foreach ($peserta as $p) {
                $p->status = 1;
                $p->id_hadiah = NULL;
                $p->save();
            }

            // Hapus gambar terkait dari sistem file
            $pathToImage = public_path('foto') . '/' . $hadiah->foto;
            if (File::exists($pathToImage)) {
                File::delete($pathToImage);
            }

            $hadiah->delete();

            return redirect()->route('admin.list_hadiah')->with('success', 'Hadiah berhasil dihapus');
        } else {
            return redirect()->route('admin.list_hadiah')->with('error', 'Hadiah tidak ditemukan');
        }
    }
    public function generateGift($id)
    {
        $hadiah = Hadiah::find($id);
        return view('generate', compact('hadiah'));
    }

    public function generatePemenang(Request $request)
    {
        $count = Peserta::where('id_hadiah', $request->id)->count();
        $jumlahHadiah = Hadiah::find($request->id)->jumlah;

        // Ngecek sisa
        $sisa = $jumlahHadiah - $count;

        if ($jumlahHadiah == $count && $sisa == 0) {
            return response()->json(['error' => 'Kuota hadiah sudah habis. Tidak dapat mengundi lagi.']);
        } else {
            $pesertaAcak = Peserta::where('status', 1)
                ->whereNull('id_hadiah')->inRandomOrder()->limit($sisa)->get();
            return response()->json(['peserta' => $pesertaAcak]);
        }
        // Ambil nama peserta secara acak sebanyak jumlah hadiah
    }

    public function lockPemenang(Request $request)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'pemenang' => 'required|array',
            'id' => 'required|exists:hadiah,id',
        ]);

        $hadiahId = $request->id;

        // Ambil hadiah berdasarkan ID
        $hadiah = Hadiah::find($hadiahId);

        if (!$hadiah) {
            return response()->json(['message' => 'Hadiah tidak ditemukan.']);
        }

        // Loop melalui array pemenang dan lakukan locking pada masing-masing peserta
        foreach ($request->input('pemenang') as $pesertaData) {
            // Cari peserta berdasarkan NPP atau ID peserta, sesuaikan dengan struktur data yang dikirim dari frontend
            $peserta = Peserta::where('npp', $pesertaData['npp'])->first();

            if ($peserta) {
                // Ubah status dan isi id_hadiah pada peserta
                $peserta->status = 2;  // Ganti sesuai status yang diinginkan
                $peserta->id_hadiah = $hadiah->id;
                $peserta->save();
            }
        }

        return response()->json(['message' => 'Pemenang berhasil di-lock.']);
    }

    public function buttonGen()
    {
        return view('button_trigger');
    }

    public function displayView()
    {
        return view('display');
    }

    public function ambilHadiah()
    {
        $hadiahs = Hadiah::all();
        return response()->json(['hadiah' => $hadiahs]);
    }

    public function display($id)
    {
        $existingDisplay = Display::where('status', 1)->first();

        if ($existingDisplay) {
            // Jika ada, ubah statusnya menjadi 0
            $existingDisplay->status = 0;
            $existingDisplay->save();
        }
        $tb_display = Display::where('id_hadiah', $id)->first();
        $tb_display->status = 1;
        $tb_display->save();
        // Panggil fungsi displayPanggung dan teruskan nilai $id
        // $this->ambilDisplay($id);
        return response()->json(['message' => 'berhasil']);
    }

    public function ambilDisplay()
    {
        $idHadiah = Display::where('status', 1)->first();
        $pesertaDaftar = Peserta::where('id_hadiah', $idHadiah->id_hadiah)->get();

        $hadiah = Hadiah::where('id', $idHadiah->id)->first();
        // $namaHadiah = $hadiah->nama_hadiah;
        // Lakukan operasi lain sesuai kebutuhan
        // Return atau tampilkan hasil sesuai kebutuhan Anda
        return response()->json(['pesertaDaftar' => $pesertaDaftar, 'message' => 'berhasil display panggung', 'hadiah' => $hadiah]);
    }
}
