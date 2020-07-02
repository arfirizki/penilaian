<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="<?= base_url('user/materiadd'); ?>" class="btn btn-primary mb-3">Add New Materi</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul Materi</th>
                        <th scope="col">Nama File</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($Materi as $mt) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $mt['judul']; ?></td>
                            <td><a href="<?= base_url('assets/materi/') . $mt['namafile']; ?>" target="_blank" class="badge badge-link"><?= $mt['namafile']; ?></a></td>
                            <td><?= $mt['kelas']; ?></td>
                            <td><?= $mt['jurusan']; ?></td>
                            <td><?= $mt['isactive']; ?></td>
                            <td>
                                <!-- <a href="<?= site_url('user/materiedit/' . $mt['id']) ?>" class="badge badge-success">Upload</a> -->
                                <a href="<?= site_url('user/delmateri/' . $mt['id']) ?>" onclick="return confirm('APAKAH ANDA YAKIN???')" class="badge badge-danger"></i> Delete
                                </a>

                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="newMateriModal" tabindex="-1" role="dialog" aria-labelledby="newMateriModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMateriModalLabel">Add New Materi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/materi'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul Materi">
                    </div>
                    <!-- <div class="custom-file">
                        <input type="file" class="custom-file-input" id="nama_file" name="nama_file">
                        <label class="custom-file-label" for="nama_file">Choose file</label>
                    </div> -->
                    <div class="form-group mt-3">
                        <select name="kelas" id="kelas" class="form-control">
                            <option value="">-- Select Kelas --</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="jurusan" id="jurusan" class="form-control">
                            <option value="">-- Select Jurusan --</option>
                            <option value="Multimedia">Multimedia</option>
                            <option value="AKL">Auntansi dan Keuangan Lembaga</option>
                            <option value="OTKP">Otomatisasi dan Tata Kelola Perkantoran</option>
                            <option value="BDPM">Bisnis Daring dan Pemasaran</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>