<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-7">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="<?= base_url('user/informasiadd'); ?>" class="btn btn-primary mb-3">Add New Information</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul Information</th>
                        <th scope="col">Nama File</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($informasi as $info) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $info['judul']; ?></td>
                            <td><a href="<?= base_url('assets/informasi/') . $info['namafile']; ?>" target="_blank" class="badge badge-link"><?= $info['namafile']; ?></a></td>
                            <td>
                                <a href="<?= site_url('user/informasidel/' . $info['id']) ?>" onclick="return confirm('APAKAH ANDA YAKIN???')" class="badge badge-danger"></i> Delete</a>
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