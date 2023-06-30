<?= $this->extend('templates/template'); ?>

<?= $this->section('content'); ?>

<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Form Tambah Data</h4>
                <!-- Pesan Flash Data -->
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('pesangagal')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesangagal'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errorsisaanggaran')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('errorsisaanggaran'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- error data -->
                <?= session('validation')?->listErrors() ?>
                <?php if (session('validation')) : ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <ul>
                            <?php foreach (session('validation')->getErrors() as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>
                <!-- error data -->
            </div>
        </div>
    </div>
    <!-- end page title -->

    <form action="/tabel/save" method="post">
        <!-- csrf_field() digunakan untuk membuat form hanya bisa di isi lewat halaman ini saja -->
        <?= csrf_field(); ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pengadaan">Nama Pengadaan</label>
                    <input type="text" class="form-control" id="pengadaan" name="pengadaan" required />
                </div>

                <div class="form-group">
                    <label for="jenispengadaan">Jenis Pengadaan:</label>
                        <select class="form-select" id="jenispengadaan" name="jenispengadaan" aria-label="Pilih opsi">
                            <option selected disabled>Pilih salah satu</option>
                            <option value="1">Konsultansi</option>
                            <option value="2">Konstruksi</option>
                            <option value="3">Barang</option>
                            <option value="4">Jasa Lainnya</option>
                        </select>
                </div>

                <div class="form-group">
                    <label for="ppk">Nama PPK</label>
                    <input type="text" class="form-control" id="ppk" name="ppk" required />
                </div>

                <div class="form-group">
                    <label for="penyedia">Nama Penyedia</label>
                    <input type="text" class="form-control" id="penyedia" name="penyedia" required />
                </div>

                <div class="form-group">
                    <label for="nokontrak">Nomor Kontrak</label>
                    <input type="text" class="form-control" id="nokontrak" name="nokontrak" required />
                </div>

                <div class="form-group">
                    <label for="tglkontrak">Tanggal Kontrak</label>
                    <input type="date" class="form-control" id="tglkontrak" name="tglkontrak" required />
                </div>

                <div class="form-group">
                    <label for="akhirkontrak">Batas Akhir Kontrak</label>
                    <input type="date" class="form-control" id="akhirkontrak" name="akhirkontrak" required />
                </div>

                <div class="form-group with-hintrp">
                    <label for="pagu">Pagu (Rp)</label>
                    <input type="text" class="form-control input-field" id="pagu" name="pagu" required />
                </div>

                <div class="form-group with-hintrp">
                    <label for="nilaikontrak">Nilai Kontrak (Rp)</label>
                    <input type="text" class="form-control input-field" id="nilaikontrak" name="nilaikontrak" />
                </div>

                <div class="form-group">
                    <label for="sisapagu">Sisa Pagu (Rp)</label>
                    <input type="text" class="form-control" id="sisapagu" name="sisapagu" readonly="readonly" />
                </div>

            </div>

            <div class="col-md-6">

                <!-- <div class="form-group with-hint">
                    <label for="persenuangmuka">Uang Muka (%)</label>
                    <input type="text" class="form-control input-field" id="persenuangmuka" name="persenuangmuka" required />
                </div> -->

                <div class="form-group">
                    <label for="uangmuka">Uang Muka (Rp)</label>
                    <input type="text" class="form-control input-field" id="uangmuka" name="uangmuka"/>
                </div>

                <div class="form-group with-hintrp">
                    <label for="tahap1">Tahap I (Rp)</label>
                    <input type="text" class="form-control input-field" id="tahap1" name="tahap1" />
                </div>

                <div class="form-group with-hintrp">
                    <label for="tahap2">Tahap II (Rp)</label>
                    <input type="text" class="form-control input-field" id="tahap2" name="tahap2" />
                </div>

                <div class="form-group with-hintrp">
                    <label for="pelunasan">Pelunasan (Rp)</label>
                    <input type="text" class="form-control input-field" id="pelunasan" name="pelunasan" />
                </div>

                <div class="form-group">
                    <label for="sisaanggaran">Sisa Anggaran (Rp)</label>
                    <input type="text" class="form-control" id="sisaanggaran" name="sisaanggaran" readonly="readonly" />
                </div>

                <div class="form-group with-hint">
                    <label for="jumin">Jumin (%)</label>
                    <input type="number" step="0.01" class="form-control" id="jumin" name="jumin" required />
                </div>

                <div class="form-group with-hint">
                    <label for="tkdn">TKDN (%)</label>
                    <input type="number" class="form-control" id="tkdn" name="tkdn" required />
                </div>

                <div class="form-group">
                    <label for="ket">Ket</label>
                    <input type="text" class="form-control" id="ket" name="ket" />
                </div>

                <div class="mb-3 mb-0" style="padding-top: 22px;">
                    <button style="width:50%" class="btn btn-primary" type="submit"> + Tambah Data </button>
                </div>
            </div>
        </div>
    </form>



    <!-- end row-->




</div> <!-- container -->

</div> <!-- content -->

<?= $this->endSection(); ?>