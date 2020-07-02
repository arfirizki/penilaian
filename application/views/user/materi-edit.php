<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= form_open_multipart('user/materiadd'); ?>
            <input type="hidden" name="id" value="<?= $row->id ?>">
            <div class="form-group row">
                <label for="judul_materi" class="col-sm-2 col-form-label">Judul Materi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="judul" name="judul" value="<?= $this->input->post('judul') ?? $row->judul ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="namafile" class="col-sm-2 col-form-label">Nama File</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namafile" name="namafile" value="<?= $this->input->post('namafile') ?? $row->namafile ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $this->input->post('kelas') ?? $row->kelas ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= $this->input->post('jurusan') ?? $row->jurusan ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="active" id="active" checked>
                        <label class="form-check-label" for="isactive">
                            Active?
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->