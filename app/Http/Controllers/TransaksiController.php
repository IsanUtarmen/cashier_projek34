<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\DetailTransaksi;
use PDOException;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Request;
use App\Http\Controllers\first;
use App\Models\Stok;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransaksiRequest $request)
    {
        try {
            DB::beginTransaction();
            // Menghitung nomor transaksi baru
            $last_id = Transaksi::whereDate('tanggal', today())->orderBy('id', 'desc')->first();
            $last_id_number = $last_id ? substr($last_id->id, 8) : 0;
            $notrans = today()->format('Ymd') . str_pad($last_id_number + 1, 4, '0', STR_PAD_LEFT);


            // Membuat transaksi baru
            $transaksi = Transaksi::create([
                'id' => $notrans,
                'tanggal' => today(),
                'total_harga' => $request->total,
                'metode_pembayaran' => 'cash', // Metode pembayaran default, bisa disesuaikan
                'keterangan' => '-' // Keterangan default, bisa disesuaikan
            ]);

            // Menghitung nomor transaksi baru
            // $last_id_number = $transaksi ? $transaksi->id : 0;
            // $notrans = today()->format('Ymd') . str_pad($last_id_number, 4, '0', STR_PAD_LEFT);

            // Update ID transaksi dengan nomor transaksi yang baru dihasilkan
            // $transaksi->update(['id' => $notrans]);

            // Membuat detail transaksi
            foreach ($request->orderedList as $detail) {
                $stok = Stok::where('menu_id', $detail['menu_id'])->first();
                $stok->jumlah = $stok->jumlah - $detail['qty'];
                $stok->save();
                DetailTransaksi::create([
                    'transaksi_id' => $notrans,
                    'menu_id' => $detail['menu_id'],
                    'jumlah' => $detail['qty'],
                    'subtotal' => $detail['harga'] * $detail['qty']
                ]);
            }

            DB::commit();

            return response()->json(['status' => true, 'message' => 'Pemesanan Berhasil!', 'notrans' => $notrans]);
        } catch (Exception $e) {
            DB::rollBack();
            // dd($e);
            return response()->json(['status' => false, 'message' => 'Pemesanan Gagal!', 'error' => $e->getMessage()]);
        }
    }

    public function faktur($nofaktur)
    {
        try {
            $transaksi = Transaksi::with('detailTransaksi')->where('id', $nofaktur)->with(['DetailTransaksi' => function ($query) {
                $query->with('menu');
            }])->first();
            // dd($transaksi);
            return view('faktur.index', compact('transaksi'));
            // dd($data);
        } catch (Exception | QueryException | PDOException $e) {
            dd($e);
            // return response()->json(['status' => false, 'message' => 'Pemesanan Gagal']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
