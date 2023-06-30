<?= $this->extend('templates/template_index'); ?>

<?= $this->section('content'); ?>
<!-- Start Content-->
<div class="container-fluid">

<!-- Start Content-->
<?php if (session()->getFlashdata('password_diubah')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('password_diubah'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
<?php endif; ?>
<div>
<img class="img-fluid" style="max-width: 100%; max-height: 100%; " src="<?= base_url(); ?>/assets/images/sisppbj.png">

</div>
<?php if(in_groups('admin')) : ?>
<div class="row justify-content-center" style="padding-top: 20px;">
        <?php if (session()->getFlashdata('datasatkerkosong')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('datasatkerkosong'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    <div class="col-md-6 d-flex">
        <form method="post" action="/Home/totalPerSatker" class="w-100 d-flex align-items-center">
            <div class="form-group flex-grow-1">
                <label for="selectedSatker">Pilih Satker:</label>
                <select class="form-control" name="selectedSatker" id="selectedSatker">
                <?php if(isset($selectedSatker)) : ?>
                    <option value="0" <?= ($selectedSatker == 'Keseluruhan') ? 'selected' : '' ?>>Keseluruhan</option>
                    <option value="1" <?= ($selectedSatker == 'RUMKIT BHAYANGKARA PONTIANAK') ? 'selected' : '' ?> >RUMKIT BHAYANGKARA PONTIANAK</option>
                    <option value="2" <?= ($selectedSatker == 'SPRIPIM') ? 'selected' : '' ?> >SPRIPIM</option>
                    <option value="3" <?= ($selectedSatker == 'RO OPS') ? 'selected' : '' ?>>RO OPS</option>
                    <option value="4" <?= ($selectedSatker == 'DIT INTELKAM') ? 'selected' : '' ?>>DIT INTELKAM</option>
                    <option value="5" <?= ($selectedSatker == 'DIT RESKRIMUM') ? 'selected' : '' ?>>DIT RESKRIMUM</option>
                    <option value="6" <?= ($selectedSatker == 'DIT SAMAPTA') ? 'selected' : '' ?>>DIT SAMAPTA</option>
                    <option value="7" <?= ($selectedSatker == 'DIT LANTAS') ? 'selected' : '' ?>>DIT LANTAS</option>
                    <option value="8" <?= ($selectedSatker == 'RO SDM') ? 'selected' : '' ?>>RO SDM</option>
                    <option value="9" <?= ($selectedSatker == 'SPN') ? 'selected' : '' ?>>SPN</option>
                    <option value="10" <?= ($selectedSatker == 'ROLOG') ? 'selected' : '' ?>>ROLOG</option>
                    <option value="11" <?= ($selectedSatker == 'SAT BRIMOB') ? 'selected' : '' ?>>SAT BRIMOB</option>
                    <option value="12" <?= ($selectedSatker == 'DIT POLAIR') ? 'selected' : '' ?>>DIT POLAIR</option>
                    <option value="13" <?= ($selectedSatker == 'BID KEU') ? 'selected' : '' ?>>BID KEU</option>
                    <option value="14" <?= ($selectedSatker == 'BID DOKKES') ? 'selected' : '' ?>>BID DOKKES</option>
                    <option value="15" <?= ($selectedSatker == 'BID PROPAM') ? 'selected' : '' ?>>BID PROPAM</option>
                    <option value="16" <?= ($selectedSatker == 'BID TIK') ? 'selected' : '' ?>>BID TIK</option>
                    <option value="17" <?= ($selectedSatker == 'BIDKUM') ? 'selected' : '' ?>>BIDKUM</option>
                    <option value="18" <?= ($selectedSatker == 'DIT RESNARKOBA') ? 'selected' : '' ?>>DIT RESNARKOBA</option>
                    <option value="19" <?= ($selectedSatker == 'ITWASDA') ? 'selected' : '' ?>>ITWASDA</option>
                    <option value="20" <?= ($selectedSatker == 'RORENA') ? 'selected' : '' ?>>RORENA</option>
                    <option value="21" <?= ($selectedSatker == 'DIT BINMAS') ? 'selected' : '' ?>>DIT BINMAS</option>
                    <option value="22" <?= ($selectedSatker == 'DIT RESKRIMSUS') ? 'selected' : '' ?>>DIT RESKRIMSUS</option>
                    <option value="23" <?= ($selectedSatker == 'DITPAMOBVIT') ? 'selected' : '' ?>>DITPAMOBVIT</option>
                    <option value="24" <?= ($selectedSatker == 'POLRES LANDAK') ? 'selected' : '' ?>>POLRES LANDAK</option>
                    <option value="25" <?= ($selectedSatker == 'POLRES BENGKAYANG') ? 'selected' : '' ?>>POLRES BENGKAYANG</option>
                    <option value="26" <?= ($selectedSatker == 'POLRES SINGKAWANG') ? 'selected' : '' ?>>POLRES SINGKAWANG</option>
                    <option value="27" <?= ($selectedSatker == 'POLRES SEKADAU') ? 'selected' : '' ?>>POLRES SEKADAU</option>
                    <option value="28" <?= ($selectedSatker == 'POLRES MELAWI') ? 'selected' : '' ?>>POLRES MELAWI</option>
                    <option value="29" <?= ($selectedSatker == 'POLRESTA PONTIANAK KOTA') ? 'selected' : '' ?>>POLRESTA PONTIANAK KOTA</option>
                    <option value="30" <?= ($selectedSatker == 'POLRES MEMPAWAH') ? 'selected' : '' ?>>POLRES MEMPAWAH</option>
                    <option value="31" <?= ($selectedSatker == 'POLRES SAMBAS') ? 'selected' : '' ?>>POLRES SAMBAS</option>
                    <option value="32" <?= ($selectedSatker == 'POLRES SANGGAU') ? 'selected' : '' ?>>POLRES SANGGAU</option>
                    <option value="33" <?= ($selectedSatker == 'POLRES SINTANG') ? 'selected' : '' ?>>POLRES SINTANG</option>
                    <option value="34" <?= ($selectedSatker == 'POLRES KAPUAS HULU') ? 'selected' : '' ?>>POLRES KAPUAS HULU</option>
                    <option value="35" <?= ($selectedSatker == 'POLRES KETAPANG') ? 'selected' : '' ?>>POLRES KETAPANG</option>
                    <option value="36" <?= ($selectedSatker == 'POLRES KAYONG UTARA') ? 'selected' : '' ?>>POLRES KAYONG UTARA</option>
                    <option value="37" <?= ($selectedSatker == 'POLRES KUBU RAYA') ? 'selected' : '' ?>>POLRES KUBU RAYA</option>
                    <option value="38" <?= ($selectedSatker == 'BIDHUMAS') ? 'selected' : '' ?>>BIDHUMAS</option>
                    <!-- Add more options as needed -->
                <?php endif; ?>
                <option value="0">Keseluruhan</option>
                    <option value="1">RUMKIT BHAYANGKARA PONTIANAK</option>
                    <option value="2">SPRIPIM</option>
                    <option value="3">RO OPS</option>
                    <option value="4">DIT INTELKAM</option>
                    <option value="5">DIT RESKRIMUM</option>
                    <option value="6">DIT SAMAPTA</option>
                    <option value="7">DIT LANTAS</option>
                    <option value="8">RO SDM</option>
                    <option value="9">SPN</option>
                    <option value="10">ROLOG</option>
                    <option value="11">SAT BRIMOB</option>
                    <option value="12">DIT POLAIR</option>
                    <option value="13">BID KEU</option>
                    <option value="14">BID DOKKES</option>
                    <option value="15">BID PROPAM</option>
                    <option value="16">BID TIK</option>
                    <option value="17">BIDKUM</option>
                    <option value="18">DIT RESNARKOBA</option>
                    <option value="19">ITWASDA</option>
                    <option value="20">RORENA</option>
                    <option value="21">DIT BINMAS</option>
                    <option value="22">DIT RESKRIMSUS</option>
                    <option value="23">DITPAMOBVIT</option>
                    <option value="24">POLRES LANDAK</option>
                    <option value="25">POLRES BENGKAYANG</option>
                    <option value="26">POLRES SINGKAWANG</option>
                    <option value="27">POLRES SEKADAU</option>
                    <option value="28">POLRES MELAWI</option>
                    <option value="29">POLRESTA PONTIANAK KOTA</option>
                    <option value="30">POLRES MEMPAWAH</option>
                    <option value="31">POLRES SAMBAS</option>
                    <option value="32">POLRES SANGGAU</option>
                    <option value="33">POLRES SINTANG</option>
                    <option value="34">POLRES KAPUAS HULU</option>
                    <option value="35">POLRES KETAPANG</option>
                    <option value="36">POLRES KAYONG UTARA</option>
                    <option value="37">POLRES KUBU RAYA</option>
                    <option value="38">BIDHUMAS</option>
                </select>
            </div>
            <div class="ms-3 mt-auto">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>
<!-- container -->
<div class="row" style="padding-top: 20px;">
<?php if(isset($total)) : ?>
    <?php foreach ($total as $t) : ?>
    <div class="col-sm-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title text-center" style="font-size: large;">REKAPITULASI</h5>
                <div class="table-responsive">
                    <table class="table" style=" font-weight: bold;">
                        <thead class="table-dark">
                            <tr>
                            <th scope="col">URAIAN</th>
                            <th colspan="2">JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: small;">
                            <tr class="table-primary">
                                <td>JUMLAH PAGU</td>
                                <td>Rp.</td>
                                <td style="text-align: right;"> <?= number_format($t['jumlahpagu'], 2, ',', '.'); ?> </span></td>
                            </tr>
                            <tr class="table-primary">
                                <td>JUMLAH TOTAL PAKET</td>
                                <td></td>
                                <td class="text-end"><?= number_format($t['totalpaket'], 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-primary">
                                <td>JUMLAH TOTAL PENGADAAN</td>
                                <td>Rp.</td><td style="text-align: right;"> <?= number_format($t['totalpengadaan'], 2, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-secondary">
                                <td class="ps-4">JUMLAH KONSULTASI</td>
                                <td>Rp.</td><td style="text-align: right;"> <?= number_format($t['konsultansi'], 2, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-secondary">
                                <td class="ps-4">JUMLAH KONSTRUKSI</td>
                                <td>Rp.</td><td style="text-align: right;"> <?= number_format($t['konstruksi'], 2, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-secondary">
                                <td class="ps-4">JUMLAH BARANG</td>
                                <td>Rp.</td><td style="text-align: right;"> <?= number_format($t['barang'], 2, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-secondary">
                                <td class="ps-4">JUMLAH JASA LAINYA</td>
                                <td>Rp.</td><td style="text-align: right;"> <?= number_format($t['jasalainnya'], 2, ',', '.'); ?></td>
                            </tr>
                            
                    
                        </tbody>
                        </table>
                </div>
        </div> <!-- end card-->
        </div>
    </div> <!-- end col-->
    <div class="col-sm-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title text-center" style="font-size: large;">PROGRES</h5>
                    <div class="table-responsive">
                        <table class="table" style=" font-weight: bold;">
                            <thead class="table-dark">
                                <tr>
                                <th scope="col">URAIAN</th>
                                <th scope="col">PERSENTASE (%)</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: small;">
                                <tr class="table-primary">
                                    <td>KEMAJUAN ADMINISTRASI</td>
                                    <td class="text-center"><?= $t['administrasi']; ?>%</td>
                                </tr>
                                <tr class="table-primary">
                                    <td>KEMAJUAN FISIK</td>
                                    <td class="text-center"><?= $t['fisik']; ?>%</td>
                                </tr>
                                <tr class="table-primary">
                                    <td>TOTAL PENYERAPAN</td>
                                    <td class="text-center"><?= $t['totalpenyerapan']; ?>%</td>
                                </tr>
                                <tr class="table-primary">
                                    <td>SISA ANGGARAN</td>
                                    <td class="text-center"><?= $t['sisaanggaran']; ?>%</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>    
                    <div class="table-responsive">
                        <table class="table" style=" font-weight: bold;">
                            <thead class="table-dark">
                                <tr>
                                <th scope="col">URAIAN</th>
                                <th colspan="2">JUMLAH (RP)</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: small;">
                                <tr class="table-primary">
                                    <td>TOTAL PENYERAPAN</td>
                                    <td>Rp.</td><td style="text-align: right;"><?= number_format(($t['totalpenyerapan'] / 100) * $t['totalpengadaan'], 2, ',', '.'); ?></td>
                                </tr>
                                <tr class="table-primary">
                                    <td>SISA ANGGARAN</td>
                                    <td>Rp.</td><td style="text-align: right;"><?= number_format(($t['sisaanggaran'] / 100) * $t['totalpengadaan'], 2, ',', '.'); ?></td>
                                </tr>                               
                            </tbody>
                        </table>
                    </div>    
            </div> <!-- end card-->
        </div>
    </div> <!-- end col-->
    <?php endforeach; ?>
    <?php elseif(isset($totalpagu)) : ?>
        <div class="col-sm-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title text-center" style="font-size: large;">REKAPITULASI</h5>
                <div class="table-responsive">
                    <table class="table" style=" font-weight: bold;">
                        <thead class="table-dark">
                            <tr>
                            <th scope="col">URAIAN</th>
                            <th colspan="2">JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: small;">
                            <tr class="table-primary">
                                <td>JUMLAH PAGU</td>
                                <td>Rp.</td>
                                <td style="text-align: right;"><?= number_format($totalpagu, 2, ',', '.'); ?></span></td>
                            </tr>
                            <tr class="table-primary">
                                <td>JUMLAH TOTAL PAKET</td>
                                <td></td>
                                <td class="text-end"><?= number_format($totalpaket, 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-primary">
                                <td>JUMLAH TOTAL PENGADAAN</td>
                                <td>Rp.</td><td style="text-align: right;"> <?= number_format($totalpengadaan, 2, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-secondary">
                                <td class="ps-4">JUMLAH KONSULTASI</td>
                                <td>Rp.</td><td style="text-align: right;"> <?= number_format($konsultansi, 2, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-secondary">
                                <td class="ps-4">JUMLAH KONSTRUKSI</td>
                                <td>Rp.</td><td style="text-align: right;"> <?= number_format($konstruksi, 2, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-secondary">
                                <td class="ps-4">JUMLAH BARANG</td>
                                <td>Rp.</td><td style="text-align: right;"> <?= number_format($barang, 2, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-secondary">
                                <td class="ps-4">JUMLAH JASA LAINYA</td>
                                <td>Rp.</td><td style="text-align: right;"> <?= number_format($jasalainnya, 2, ',', '.'); ?></td>
                            </tr>
                            
                    
                        </tbody>
                        </table>
                </div>
        </div> <!-- end card-->
        </div>
    </div> <!-- end col-->
    <div class="col-sm-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title text-center" style="font-size: large;">PROGRES</h5>
                    <div class="table-responsive">
                        <table class="table" style=" font-weight: bold;">
                            <thead class="table-dark">
                                <tr>
                                <th scope="col">URAIAN</th>
                                <th scope="col">PERSENTASE (%)</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: small;">
                                <tr class="table-primary">
                                    <td>KEMAJUAN ADMINISTRASI</td>
                                    <td class="text-center"><?= $roundedtotaljumin; ?>%</td>
                                </tr>
                                <tr class="table-primary">
                                    <td>KEMAJUAN FISIK</td>
                                    <td class="text-center"><?= $roundedtotaljusik; ?>%</td>
                                </tr>
                                <tr class="table-primary">
                                    <td>TOTAL PENYERAPAN</td>
                                    <td class="text-center"><?= $roundedtotalpenyerapan; ?>%</td>
                                </tr>
                                <tr class="table-primary">
                                    <td>SISA ANGGARAN</td>
                                    <td class="text-center"><?= $roundedtotalsisaanggaran; ?>%</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table" style=" font-weight: bold;">
                            <thead class="table-dark">
                                <tr>
                                <th scope="col">URAIAN</th>
                                <th colspan="2">JUMLAH (RP)</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: small;">
                                <tr class="table-primary">
                                    <td>TOTAL PENYERAPAN</td>
                                    <td>Rp.</td><td style="text-align: right;"><?= number_format(($roundedtotalpenyerapan / 100) * $totalpengadaan , 2, ',', '.'); ?></td>
                                </tr>
                                <tr class="table-primary">
                                    <td>SISA ANGGARAN</td>
                                    <td>Rp.</td><td style="text-align: right;"><?= number_format(($roundedtotalsisaanggaran / 100) * $totalpengadaan , 2, ',', '.'); ?></td>
                                </tr>                               
                            </tbody>
                        </table>
                    </div>    
            </div> <!-- end card-->
        </div>
    </div> <!-- end col-->
<?php endif; ?>
</div>
<!-- end row -->
<div class="row d-flex justify-content-center align-items-center" style="padding-top: 20px;">
<?php if(isset($satkerYangKosong)) : ?>
    <div class="col-sm-4">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title text-center" style="font-size: large;">Data Satker Yang Masih Kosong</h5>
                <div class="table-responsive">
                    <table class="table" style="font-weight: bold;">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Nama Satker</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: small;">
                            <?php foreach ($satkerYangKosong as $item) : ?>
                                <tr class="table-primary">
                                    <td><?= $item ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>



</div>
<!-- content -->
<?= $this->endSection(); ?>