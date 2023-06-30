<?= $this->extend('templates/template'); ?>

<?= $this->section('content'); ?>

<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title"><?php echo (user()->satker == null) ? 'Data Pekerjaan Admin' : 'Data Pekerjaan Satker' .' '. user()->satker; ?></h4>
                <!-- Pesan Flash Data Hapus -->
                <?php if (session()->getFlashdata('pesanhapus')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesanhapus'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('errorsisaanggaranupdate')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('errorsisaanggaranupdate'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <!-- Pesan Flash Data DiUbah-->
                <?php if (session()->getFlashdata('pesan_diubah')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_diubah'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <!-- Pesan Flash File Tidak Ditemukan-->
                <?php if (session()->getFlashdata('file_notfound')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('file_notfound'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="button-container">
        <div class="form-container">
            <form action="<?= site_url('tabel/pdfsave');?>" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="excel_file">Pilih File Excel:</label>
                    <input type="file" name="excel_file">
                    <p>Menerima format file: .xlsx, .xls</p>
                </div>
                <div class="form-group">
                    <label for="output_filename">Nama File Keluaran:</label>
                    <input type="text" id="output_filename" name="output_filename" placeholder="Masukkan Nama File">
                    <p>Biarkan kosong untuk menggunakan nama file default</p>
                </div>
                <button type="submit" class="btn btn-danger"><i class="fas fa-file-download fa-lg"></i> Convert to PDF</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </form>
        </div>
        <form action="<?= site_url('tabel/export');?>" method="">
            <button type="submit" class="btn btn-success"><i class="fas fa-file-download fa-lg"></i> Export Excel</button>
        </form>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="tab-content">

                        <div class="tab-pane show active" id="buttons-table-preview">
<?php if(in_groups('admin')) : ?>
                        <table id="alternative-page-datatable" class="table dt-responsive nowrap">
                                <thead class="table-dark">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th style="width:10%" rowspan="2">Nama Pengadaan</th>
                                        <th style="width:6%" rowspan="2">Jenis Pengadaan</th>
                                        <th style="width:10%" rowspan="2">Nama PPK</th>
                                        <th style="width:10%" rowspan="2">Nama Penyedia</th>
                                        <th style="width:10%" rowspan="2">Nomor Kontrak</th>
                                        <th style="width:6%" rowspan="2">Tanggal Kontrak</th>
                                        <th style="width:6%" rowspan="2">Batas Akhir Kontrak</th>
                                        <th rowspan="2">Pagu</th>
                                        <th rowspan="2">Nilai Kontrak</th>
                                        <th rowspan="2">Sisa Pagu</th>
                                        <th colspan="4" class="text-center">Penarikan / Relasi Anggaran</th>
                                        <th rowspan="2">Sisa Anggaran</th>
                                        <th rowspan="2">Jumin</th>
                                        <th rowspan="2">Jusik</th>
                                        <th rowspan="2">TKDN</th>
                                        <th rowspan="2">Satker</th>
                                        <th rowspan="2">Tahun Anggaran</th>
                                        <th rowspan="2">Keterangan</th>
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th>Uang Muka</th>
                                        <th>Tahap I</th>
                                        <th>Tahap II</th>
                                        <th>Pelunasan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($laporan as $l) : ?>
                                        <tr id=<?= $l['id']; ?>>
                                            <td><?= $i++; ?></td>
                                            <td class="text-wrap" data-target="pengadaan"><?= $l['pengadaan']; ?></td>
                                            <td data-target="jenispengadaan"><?= $l['jenispengadaan']; ?></td>
                                            <td data-target="ppk"><?= $l['ppk']; ?></td>
                                            <td data-target="penyedia"><?= $l['penyedia']; ?></td>
                                            <td data-target="nokontrak"><?= $l['nokontrak']; ?></td>
                                            <td data-target="tglkontrak"><?= $l['tglkontrak']; ?></td>
                                            <td data-target="akhirkontrak"><?= $l['akhirkontrak']; ?></td>
                                            <td data-target="pagu">
                                            <?php
                                                $formattedValue = number_format($l['pagu'], 2, ',', '.');
                                                echo substr($formattedValue, -2) == '00' ? number_format($l['pagu'], 0, ',', '.') : $formattedValue;
                                                ?>
                                            </td>
                                            <td data-target="nilaikontrak">
                                            <?php
                                                $formattedValue = number_format($l['nilaikontrak'], 2, ',', '.');
                                                echo substr($formattedValue, -2) == '00' ? number_format($l['nilaikontrak'], 0, ',', '.') : $formattedValue;
                                                ?>
                                            </td>
                                            <td >
                                            <?php
                                                $formattedValue = number_format($l['sisapagu'], 2, ',', '.');
                                                echo substr($formattedValue, -2) == '00' ? number_format($l['sisapagu'], 0, ',', '.') : $formattedValue;
                                                ?>                                                
                                            </td>
                                            <td data-target="uangmuka">
                                            <?php
                                                $formattedValue = number_format($l['uangmuka'], 2, ',', '.');
                                                echo substr($formattedValue, -2) == '00' ? number_format($l['uangmuka'], 0, ',', '.') : $formattedValue;
                                                ?>   
                                            </td>
                                            <td data-target="tahap1">
                                            <?php
                                                $formattedValue = number_format($l['tahap1'], 2, ',', '.');
                                                echo substr($formattedValue, -2) == '00' ? number_format($l['tahap1'], 0, ',', '.') : $formattedValue;
                                                ?>
                                            </td>
                                            <td data-target="tahap2">
                                            <?php
                                                $formattedValue = number_format($l['tahap2'], 2, ',', '.');
                                                echo substr($formattedValue, -2) == '00' ? number_format($l['tahap2'], 0, ',', '.') : $formattedValue;
                                                ?>
                                            </td>
                                            <td data-target="pelunasan">
                                            <?php
                                                $formattedValue = number_format($l['pelunasan'], 2, ',', '.');
                                                echo substr($formattedValue, -2) == '00' ? number_format($l['pelunasan'], 0, ',', '.') : $formattedValue;
                                                ?>
                                            </td>
                                            <td >
                                                <?php
                                                $formattedValue = number_format($l['sisaanggaran'], 2, ',', '.');
                                                echo substr($formattedValue, -2) == '00' ? number_format($l['sisaanggaran'], 0, ',', '.') : $formattedValue;
                                                ?>                                                
                                            </td>
                                            <td data-target="jumin"><?= $l['jumin']; ?>%</td>
                                            <td ><?= $l['jusik']; ?>%</td>
                                            <td data-target="tkdn"><?= $l['tkdn']; ?>%</td>
                                            <td class="text-wrap" data-target="ket"><?= $l['satker']; ?></td>
                                            <td class="text-wrap" data-target="ket"><?= $l['tahun']; ?></td>
                                            <td class="text-wrap" data-target="ket"><?= $l['ket']; ?></td>
                                            <td class="table-action">
                                                    <a href="#" id="update" class="action-icon" data-bs-toggle="modal" data-role="edit" data-bs-target="#full-width-modal" data-id="<?= $l['id']; ?>"> <i class="fa-solid fa-pencil"></i></a>
                                                <form action="/tabel/<?= $l['id']; ?>" method="post" class="d-inline">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="action-icon fa-solid fa-trash btn-light btn-outline-light" style="color: #db0000;" onclick="return confirm('apakah anda yakin?')"></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
<?php else : ?>
                            <table id="alternative-page-datatable" class="table dt-responsive nowrap">
                                <thead class="table-dark">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th style="width:10%" rowspan="2">Nama Pengadaan</th>
                                        <th style="width:6%" rowspan="2">Jenis Pengadaan</th>
                                        <th style="width:10%" rowspan="2">Nama PPK</th>
                                        <th style="width:10%" rowspan="2">Nama Penyedia</th>
                                        <th style="width:10%" rowspan="2">Nomor Kontrak</th>
                                        <th style="width:6%" rowspan="2">Tanggal Kontrak</th>
                                        <th style="width:6%" rowspan="2">Batas Akhir Kontrak</th>
                                        <th rowspan="2">Pagu</th>
                                        <th rowspan="2">Nilai Kontrak</th>
                                        <th rowspan="2">Sisa Pagu</th>
                                        <th colspan="4" class="text-center">Penarikan / Relasi Anggaran</th>
                                        <th rowspan="2">Sisa Anggaran</th>
                                        <th rowspan="2">Jumin</th>
                                        <th rowspan="2">Jusik</th>
                                        <th rowspan="2">TKDN</th>
                                        <th rowspan="2">Keterangan</th>
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th>Uang Muka</th>
                                        <th>Tahap I</th>
                                        <th>Tahap II</th>
                                        <th>Pelunasan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($laporan as $l) : ?>
                                        <tr id=<?= $l['id']; ?>>
                                            <td><?= $i++; ?></td>
                                            <td class="text-wrap" data-target="pengadaan"><?= $l['pengadaan']; ?></td>
                                            <td data-target="jenispengadaan"><?= $l['jenispengadaan']; ?></td>
                                            <td data-target="ppk"><?= $l['ppk']; ?></td>
                                            <td data-target="penyedia"><?= $l['penyedia']; ?></td>
                                            <td data-target="nokontrak"><?= $l['nokontrak']; ?></td>
                                            <td data-target="tglkontrak"><?= $l['tglkontrak']; ?></td>
                                            <td data-target="akhirkontrak"><?= $l['akhirkontrak']; ?></td>
                                            <td data-target="pagu">
                                            <?php
                                                $formattedValue = number_format($l['pagu'], 2, ',', '.');
                                                echo substr($formattedValue, -2) == '00' ? number_format($l['pagu'], 0, ',', '.') : $formattedValue;
                                                ?>
                                            </td>
                                            <td data-target="nilaikontrak">
                                            <?php
                                                $formattedValue = number_format($l['nilaikontrak'], 2, ',', '.');
                                                echo substr($formattedValue, -2) == '00' ? number_format($l['nilaikontrak'], 0, ',', '.') : $formattedValue;
                                                ?>
                                            </td>
                                            <td >
                                            <?php
                                                $formattedValue = number_format($l['sisapagu'], 2, ',', '.');
                                                echo substr($formattedValue, -2) == '00' ? number_format($l['sisapagu'], 0, ',', '.') : $formattedValue;
                                                ?>                                                
                                            </td>
                                            <td data-target="uangmuka">
                                            <?php
                                                $formattedValue = number_format($l['uangmuka'], 2, ',', '.');
                                                echo substr($formattedValue, -2) == '00' ? number_format($l['uangmuka'], 0, ',', '.') : $formattedValue;
                                                ?>   
                                            </td>
                                            <td data-target="tahap1">
                                            <?php
                                                $formattedValue = number_format($l['tahap1'], 2, ',', '.');
                                                echo substr($formattedValue, -2) == '00' ? number_format($l['tahap1'], 0, ',', '.') : $formattedValue;
                                                ?>
                                            </td>
                                            <td data-target="tahap2">
                                            <?php
                                                $formattedValue = number_format($l['tahap2'], 2, ',', '.');
                                                echo substr($formattedValue, -2) == '00' ? number_format($l['tahap2'], 0, ',', '.') : $formattedValue;
                                                ?>
                                            </td>
                                            <td data-target="pelunasan">
                                            <?php
                                                $formattedValue = number_format($l['pelunasan'], 2, ',', '.');
                                                echo substr($formattedValue, -2) == '00' ? number_format($l['pelunasan'], 0, ',', '.') : $formattedValue;
                                                ?>
                                            </td>
                                            <td >
                                                <?php
                                                $formattedValue = number_format($l['sisaanggaran'], 2, ',', '.');
                                                echo substr($formattedValue, -2) == '00' ? number_format($l['sisaanggaran'], 0, ',', '.') : $formattedValue;
                                                ?>                                                
                                            </td>
                                            <td data-target="jumin"><?= $l['jumin']; ?>%</td>
                                            <td ><?= $l['jusik']; ?>%</td>
                                            <td data-target="tkdn"><?= $l['tkdn']; ?>%</td>
                                            <td class="text-wrap" data-target="ket"><?= $l['ket']; ?></td>
                                            <td class="table-action">
                                                    <a href="#" id="update" class="action-icon" data-bs-toggle="modal" data-role="edit" data-bs-target="#full-width-modal" data-id="<?= $l['id']; ?>"> <i class="fa-solid fa-pencil"></i></a>
                                                <form action="/tabel/<?= $l['id']; ?>" method="post" class="d-inline">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="action-icon fa-solid fa-trash btn-light btn-outline-light" style="color: #db0000;" onclick="return confirm('apakah anda yakin?')"></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
<?php endif; ?>
                        </div> <!-- end preview-->


                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->




</div> <!-- container -->

</div> <!-- content -->

<!-- Full width modal -->
<div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <form action="/tabel/update" method="post">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Form Ubah</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" id="id" class="form-control" name="id">
                                <label for="pengadaan">Nama Pengadaan</label>
                                <input type="text" class="form-control" id="pengadaan" name="pengadaan" required />
                            </div>

                            <div class="form-group">
                                <label for="jenispengadaan">Jenis Pengadaan:</label>
                                    <select class="form-select" id="jenispengadaan" name="jenispengadaan" aria-label="Pilih opsi">
                                        <option disabled>Pilih salah satu</option>
                                        <option value="1" >Konsultansi</option>
                                        <option value="2" >Konstruksi</option>
                                        <option value="3" >Barang</option>
                                        <option value="4" >Jasa Lainnya</option>
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
                            <div class="form-group">
                                <label for="pagu">Pagu</label>
                                <input type="text" class="form-control" id="pagu" name="pagu" required />
                            </div>
                            <div class="form-group">
                                <label for="nilaikontrak">Nilai Kontrak</label>
                                <input type="text" class="form-control" id="nilaikontrak" name="nilaikontrak" required />
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="uangmuka">Uang Muka</label>
                                <input type="text" class="form-control" id="uangmuka" name="uangmuka" required />
                            </div>

                            <div class="form-group">
                                <label for="tahap1">Tahap I</label>
                                <input type="text" class="form-control" id="tahap1" name="tahap1" required />
                            </div>

                            <div class="form-group">
                                <label for="tahap2">Tahap II</label>
                                <input type="text" class="form-control" id="tahap2" name="tahap2" required />
                            </div>

                            <div class="form-group">
                                <label for="pelunasan">Pelunasan</label>
                                <input type="text" class="form-control" id="pelunasan" name="pelunasan" required />
                            </div>

                            <div class="form-group">
                                <label for="jumin">Jumin</label>
                                <input type="number" step="0.01" class="form-control" id="jumin" name="jumin" required />
                            </div>
                            <div class="form-group">
                                <label for="tkdn">TKDN</label>
                                <input type="number" class="form-control" id="tkdn" name="tkdn" required />
                            </div>
                            <div class="form-group">
                                <label for="ket">Ket</label>
                                <input type="text" class="form-control" id="ket" name="ket" required />
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Ubah Data</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?= $this->endSection(); ?>