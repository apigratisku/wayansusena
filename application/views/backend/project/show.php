<!-- PANEL HEADLINE -->

<div class="panel panel-headline">

    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6">
                <h3 class="panel-title"><?php echo $title; ?></h3>
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
						<th>Project</th>
                        <th>Item</th>
						<th>Nilai</th>
						<th width="10%">Tindakan</th>
                    </tr>

                </thead>

                <tbody>
					
					<?php if(isset($items)): ?>
                    <?php foreach ($items as $item): ?>

                        <tr>
							<td nowrap>
                                <?php 
								$project = $this->db->get_where('tb_project', array('id' => $item['project']))->row_array();
								echo $project['nama']; ?>
                            </td>
                            <td nowrap>
                                <?php echo $item['nama']; ?>
                            </td>
							<td nowrap>
                                <?php echo "Rp " . number_format($item['nilai'], 0, ",", "."); ?>
                            </td>

                            <td nowrap>
                                <a href="<?php echo base_url('manage/itemproject/' . $item['id'] . '/ubah'); ?>" class="btn btn-xs btn-warning">
                                    Ubah
                                </a>
                                <a href="<?php echo base_url('manage/itemproject/' . $item['id'] . '/hapus'); ?>" onClick="javascript:return confirm('Yakin ingin menghapus data?')" class="btn btn-xs btn-danger">
                                    Hapus
                                </a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
					<?php endif;?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- END PANEL HEADLINE -->
