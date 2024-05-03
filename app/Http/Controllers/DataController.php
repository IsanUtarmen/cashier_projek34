<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pelanggan;
use App\Models\Stok;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function index(Request $request)
    {



        $count_menu = Menu::count();

        $pelanggan = Pelanggan::get();
        $data['count_pelanggan'] = $pelanggan->count();

        $transaksi = Transaksi::get();
        $data['count_transaksi'] = $transaksi->count();

        $stok = Stok::sum('jumlah'); // Mengambil jumlah total stok dari semua item
        $terjual = DetailTransaksi::sum('jumlah'); // Mengambil jumlah total yang sudah terjual atau digunakan dalam transaksi
        $sisa_stok = $stok - $terjual; // Menghitung sisa stok yang tersedia

        $data['count_stok'] = $sisa_stok; // Menyimpan sisa stok ke dalam array data


        $detail_transaksi = DetailTransaksi::get();
        $data['count_detail_transaksi'] = $detail_transaksi->count();

        //tampilkan 10 data pelanggan terakhir
        $data['pelanggan'] = Pelanggan::limit(10)->orderBy('created_at', 'desc')->get();


        // Menghitung jumlah pesanan untuk setiap menu
        $menu_counts = DetailTransaksi::select('menu_id', DB::raw('COUNT(*) as total'))
            ->groupBy('menu_id')
            ->orderBy('total', 'desc')
            ->limit(5) // Mengambil 5 menu yang paling sering dipesan
            ->get();


        $totalPendapatan = $this->totalPendapatan();

        // Kirim data total pendapatan ke view
        $data['totalPendapatan'] = $totalPendapatan;

        // Menyimpan hasil dalam array
        $most_ordered_menu = [];
        foreach ($menu_counts as $menu_count) {
            $menu = Menu::find($menu_count->menu_id);
            $most_ordered_menu[$menu->nama_menu] = $menu_count->total;
        }

        $data['most_ordered_menu'] = $most_ordered_menu;

        // Menampilkan sisa stok stok yang tersedia
        $sisaStok = Stok::sum('jumlah');

        // Mendapatkan jumlah menu
        $count_menu = Menu::count();

        // Mendapatkan jumlah transaksi
        $count_transaksi = Transaksi::count();

        // Mendapatkan pendapatan
        $pendapatan = DetailTransaksi::sum('subtotal');

         // Mendapatkan transaksi terbaru
         $latest_transactions = DetailTransaksi::latest()->limit(5)->get();



        // Mendapatkan stok terendah
        $stokTerendah = Stok::orderBy('jumlah')->limit(5)->get();

        $awal =  Carbon::now()->startOfMonth();
        $akhir = Carbon::now()->endOfMonth();

        $totalPendapatanPerHari = $this->tampilkanGrafikBetween($awal, $akhir);



        return view('dashboard.index', compact(
            'count_menu',
            'most_ordered_menu',
            'count_transaksi',
            'pelanggan',
            'pendapatan',
            'stokTerendah',
            'sisaStok',
            'latest_transactions',
            'totalPendapatanPerHari'

            // Sertakan tanggal untuk digunakan dalam form atau tampilan
        ));
    }
    public function tampilkanGrafikBetween($tanggalMulai, $tanggalSelesai): array
    {
        $totalPendapatanPerHari = [];

        $tanggalSekarang = $tanggalMulai;
        while ($tanggalSekarang <= $tanggalSelesai) {
            $tanggalFormat = date('d/m', strtotime($tanggalSekarang));
            $totalPendapatan = Transaksi::where('tanggal', $tanggalSekarang)->sum('total_harga');
            $totalPendapatanPerHari[$tanggalFormat] = $totalPendapatan;
            $tanggalSekarang = date('Y-m-d', strtotime($tanggalSekarang . ' +1 day'));
        }

        return $totalPendapatanPerHari;
    }



    public function getDataChart(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');
        $data = $this->tampilkanGrafikBetween($tanggalMulai, $tanggalSelesai);
        return response()->json($data);
    }

    public function totalPendapatan()
    {
        // Mengambil semua transaksi
        $transaksi = Transaksi::all();

        // Menghitung total pendapatan dari semua transaksi
        $totalPendapatan = $transaksi->sum('total_harga');

        return $totalPendapatan;
    }
}
