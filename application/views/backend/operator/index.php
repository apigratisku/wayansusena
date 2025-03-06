<!-- PANEL HEADLINE -->

<div class="panel panel-headline">

    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6">
                <h3 class="panel-title"><?php echo $title; ?></h3>
            </div>
            <div class="col-md-6 panel-action">
                <a href="<?php echo base_url('manage/operator/tambah'); ?>" class="btn btn-success">TAMBAH DATA</a>
            </div>
        </div>
    </div>

    <hr class="panel-divider">

    <div class="panel-body">

        <?php if ($this->session->flashdata('message') == 'success'): ?>

            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Berhasil menghapus data.
            </div>

        <?php elseif ($this->session->flashdata('message') == 'failed'): ?>

            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Gagal menghapus data.
            </div>

        <?php endif; ?>

        <div class="table-responsive">

            <table class="table table-hover table-bordered table-act" id="data-table">

                <thead>

                    <tr>
                        <th>Nama</th>
                        <th>UserID</th>
                        <th>Level</th>
						<th>Tindakan</th>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($items as $item): ?>

                        <tr>
                            <td nowrap>
                                <?php echo $item['nama']; ?>
                            </td>
                            <td nowrap>
                                <?php echo $item['email']; ?>
                            </td><td>
                                <?php if ($item['admin'] == "0") { echo "Operator"; } elseif ($item['admin'] == "2") { echo "Sales"; }else { echo "Super Admin"; }  ?>
                            </td>
                            <td nowrap>
								
                                <a href="<?php echo base_url('manage/operator/' . $item['id']); ?>" class="btn btn-xs btn-primary">
                                    <i class="fa fa-search-plus"></i>
                                </a>
								
                                &nbsp;
								<?php if($item['email'] != "adhit"): ?>
                                <a href="<?php echo base_url('manage/operator/' . $item['id'] . '/ubah'); ?>" class="btn btn-xs btn-warning">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                &nbsp;
                                <a href="<?php echo base_url('manage/operator/' . $item['id'] . '/hapus'); ?>" onClick="javascript:return confirm('Yakin ingin menghapus data?')" class="btn btn-xs btn-danger">
                                    <i class="fa fa-trash-o"></i>
                                </a>
								<?php endif; ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- END PANEL HEADLINE -->
