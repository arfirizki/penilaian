<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <div class="row">
        <div class="col-lg-8">
            <?= form_open_multipart('user/infoprosesadd') ?>
            <div class="form-group row">
                <label for="judul_materi" class="col-sm-3 col-form-label">Judul Information</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="judul" name="judul">
                </div>
            </div>
            <div class="form-group row">
                <label for="namafile" class="col-sm-3 col-form-label">Nama File</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="namafile" name="namafile">
                                <label class="custom-file-label" for="namafile">Choose file</label>
                                <small class="text-secondary pl-2">Format upload file pdf, jpg, jpeg, png | maximum upload file size: 5MB</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row justify-content-end">
                <div class="col-sm-9">
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