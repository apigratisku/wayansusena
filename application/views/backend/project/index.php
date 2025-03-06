<!-- PANEL HEADLINE -->

<div class="panel panel-headline">

    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6">
                <h3 class="panel-title"><?php echo $title; ?></h3>
            </div>
            <div class="col-md-6 panel-action">
                <a href="<?php echo base_url('manage/project/tambah'); ?>" class="btn btn-success">TAMBAH DATA</a>
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
						<th>Sum Nilai Operasional</th>
						<th>Status</th>
						<th>Tindakan</th>
                    </tr>

                </thead>

                <tbody>
					<?php if(isset($items)): ?>
                    <?php foreach ($items as $item): ?>

                        <tr>
                            <td nowrap>
                                <?php echo $item['nama']; ?>
                            </td>
							<td nowrap>
                                <?php 
								$this->db->select_sum('nilai');
								$this->db->where('project',$item['id']);
								$result_nilai = $this->db->get('tb_itemproject')->row();
								if(isset($result_nilai)){echo "Rp " . number_format($result_nilai->nilai, 0, ",", ".");} 
								?>
                            </td>
							<td nowrap>
                                <span style="font-weight:bold"><?php if($item['status'] == "0"){echo "<span style=\"color: red\">&#9745 Progress</span>";}else{echo "<span style=\"color: green\">&#9989; Selesai</span>";} ?></span>
                            </td>
                            <td nowrap>
							 <a href="<?php echo base_url('manage/project/' . $item['id'] . '/show'); ?>" class="btn btn-xs btn-primary">
                                    Detail
                                </a>
                                <a href="<?php echo base_url('manage/project/' . $item['id'] . '/ubah'); ?>" class="btn btn-xs btn-warning">
                                    Ubah
                                </a>
                                <a href="<?php echo base_url('manage/project/' . $item['id'] . '/hapus'); ?>" onClick="javascript:return confirm('Yakin ingin menghapus data?')" class="btn btn-xs btn-danger">
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
