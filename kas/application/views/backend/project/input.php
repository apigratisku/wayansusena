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
        if (isset($item)) {
            echo form_open_multipart('manage/project/' . $item['id'] . '/timpa');
        } else {
            echo form_open_multipart('manage/project/simpan');
        }
        ?>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="nama">Nama Project</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo isset($item) ? $item['nama'] : ''; ?>" required autofocus>
                    </div>
					
					<div class="form-group">
                        <label for="level">Status</label>
                        <select class="form-control" id="admin" name="status" placeholder="Status Project" value="<?php echo isset($item) ? $item['status'] : ''; ?>">
						<option value="0">Progress</option>
						<option value="1">Selesai</option>
						</select>
                    </div>

                </div>

            </div>

            <hr>

            <div class="row">
                <div class="col-md-12 form-buttons">
                    <a href="<?php echo base_url('manage/project'); ?>" class="btn btn-warning"><i class="fa fa-arrow-circle-left"></i>&nbsp; KEMBALI</a>
                    &nbsp;
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i>&nbsp; SIMPAN</button>
                </div>
            </div>

        </form>

    </div>

</div>

<!-- END PANEL HEADLINE -->
