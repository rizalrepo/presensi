<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'tugas';
include_once '../../template/sidebar.php';

$user = $con->query("SELECT * FROM user WHERE id_user = '$_SESSION[id_user]'")->fetch_array();
$log = $user['id_pegawai'];
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fas fa-briefcase ml-1 mr-1"></i> Data Peritah Tugas</h4>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-purple card-outline">
                        <!-- form start -->
                        <div class="card-body" style="background-color: white;">

                            <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { ?>
                                <div id="notif" class="alert bg-teal" role="alert"><i class="fa fa-check-circle mr-2"></i><b><?= $_SESSION['pesan'] ?></b></div>
                            <?php $_SESSION['pesan'] = '';
                            } ?>

                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped dataTable">
                                    <thead class="bg-purple">
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Nomor Surat</th>
                                            <th>Perihal</th>
                                            <th>Waktu</th>
                                            <th>Tempat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM tugas a JOIN sub_tugas b ON a.id_tugas = b.id_tugas WHERE b.id_pegawai = '$log' ORDER BY a.id_tugas DESC");
                                        while ($row = $data->fetch_array()) {
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td align="center"><?= $row['no_surat'] ?></td>
                                                <td align="center"><?= $row['perihal'] ?></td>
                                                <td align="center">
                                                    <?= tgl_indo($row['tanggal']) ?><br>
                                                    <?= $row['jam'] ?> WITA
                                                </td>
                                                <td align="center"><?= $row['tempat'] ?></td>
                                                <td align="center" width="10%">
                                                    <a href="surat?id=<?= $row[0] ?>" class="btn bg-olive btn-xs" title="Surat Tugas" target="_blank"><i class="fa fa-mail-bulk"></i> Surat</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!--/.col (left) -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include_once '../../template/footer.php';
?>