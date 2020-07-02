<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= form_open_multipart('user/prosesadd') ?>
            <div class="form-group row">
                <label for="judul_materi" class="col-sm-2 col-form-label">Judul Materi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="judul" name="judul">
                </div>
            </div>
            <div class="form-group row">
                <label for="namafile" class="col-sm-2 col-form-label">Nama File</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="namafile" name="namafile">
                                <label class="custom-file-label" for="namafile">Choose file</label>
                                <small class="text-secondary pl-2">Format upload file .pdf | maximum upload file size: 5MB</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-10">
                    <select name="kelas" id="kelas" class="form-control">
                        <option value="">-- Select Kelas --</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-10">
                    <select name="jurusan" id="jurusan" class="form-control">
                        <option value="">-- Select Jurusan --</option>
                        <option value="Multimedia">Multimedia</option>
                        <option value="AKL">Auntansi dan Keuangan Lembaga</option>
                        <option value="OTKP">Otomatisasi dan Tata Kelola Perkantoran</option>
                        <option value="BDPM">Bisnis Daring dan Pemasaran</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                        <label class="form-check-label" for="is_active">
                            Active?
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->