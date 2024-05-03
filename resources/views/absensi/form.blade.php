<div class="modal fade" id="modalFormAbsensi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Data absensi</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formAbsensi" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="namaKaryawan" class="form-label">Nama Karyawan</label>
                        <input type="text" class="form-control" id="namaKaryawan" name="namaKaryawan">
                    </div>
                    <div class="mb-3">
                        <label for="tanggalMasuk" class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="tanggalMasuk" name="tanggalMasuk">
                    </div>
                    <div class="mb-3">
                        <label for="waktuMasuk" class="form-label">Waktu Masuk</label>
                        <input type="time" class="form-control" id="waktuMasuk" name="waktuMasuk">
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" id="status"  class="form-control" required>
                            <option value="masuk">Masuk</option>
                            <option value="sakit">Sakit</option>;
                            <option value="cuti">Cuti</option>;
                        </select>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="waktuKeluar" class="form-label">Waktu Keluar</label>
                        <input type="time" class="form-control" id="waktuKeluar" name="waktuKeluar">
                    </div> --}}
                    
                    <div class="mb-3">
                        <label for="waktuKeluar" class="form-label">Waktu Keluar</label>
                        <input type="time" class="form-control" id="waktuKeluar" name="waktuKeluar">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
