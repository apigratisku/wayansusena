<!-- PANEL HEADLINE -->

<div class="panel panel-headline">

    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $title; ?></h3>
    </div>

    <div class="panel-body">

        <?php if ($this->session->flashdata('success')): ?>

            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>

        <?php elseif ($this->session->flashdata('error')): ?>

            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $this->session->flashdata('error'); ?>
            </div>

        <?php endif; ?>

        <?php
        if (isset($item2)) {
            echo form_open_multipart('manage/docproject/' . $item['id'] . '/timpa');
        } else {
            echo form_open_multipart('manage/docproject/simpan');
        }
        ?>

            <div class="row">

                <div class="col-md-6">

					<div class="form-group">
                        <label for="level">Nama Project</label>
                        <select class="form-control" id="admin" name="project" placeholder="Nama Project">
						<?php 
						$query = $this->db->get('tb_project')->result_array(); 
						foreach ($query as $qry): ?>
						<option value="<?php echo $qry['id']; ?>"><?php echo $qry['nama']; ?></option>
						<?php endforeach; ?>
						</select>
                    </div>
					<div class="form-group">
                        <label for="nama">Foto</label>
                        <input type="text" class="form-control" id="foto" name="foto" value="<?php echo isset($item) ? $item['foto'] : ''; ?>" autofocus>
                    </div>
					

                </div>

            </div>

            <hr>

            <div class="row">
                <div class="col-md-12 form-buttons">
                    <a href="<?php echo base_url('manage/docproject'); ?>" class="btn btn-warning"><i class="fa fa-arrow-circle-left"></i>&nbsp; KEMBALI</a>
                    &nbsp;
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i>&nbsp; SIMPAN</button>
                </div>
            </div>

        </form>

    </div>

</div>

<!-- END PANEL HEADLINE -->
