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
            echo form_open_multipart('manage/operator/' . $item['id'] . '/timpa');
        } else {
            echo form_open_multipart('manage/operator/simpan');
        }
        ?>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap" value="<?php echo isset($item) ? $item['nama'] : ''; ?>" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="Email">UserID</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Isi dengan UserID anda" value="<?php echo isset($item) ? $item['email'] : ''; ?>" required>
                    </div>
					 <div class="form-group">
                        <label for="Password">Password <?php if($title == "Ubah Data Operator") { echo "<small style='color:#6688FF;'> (Kosongkan jika menggunakan password lama)</small>"; } ?></label>
                        <input type="password" class="form-control" id="password" name="password" value="" <?php if($title == "Tambah Data Operator") { echo "placeholder=\"Isi dengan password anda\" required"; } else { echo "placeholder=\"*****\"";} ?>>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control" id="admin" name="admin" placeholder="Tidak harus diisi" value="<?php echo isset($item) ? $item['admin'] : ''; ?>">
						<option value="1">Super Admin</option>
						</select>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto Operator<?php echo isset($item) ? "<small style='color:#6688FF;'> (kosongkan jika tidak ingin mengganti foto)</small>" : ""; ?></label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
					
					
					

                </div>

            </div>

            <hr>

            <div class="row">
                <div class="col-md-12 form-buttons">
                    <a href="<?php echo base_url('manage/operator'); ?>" class="btn btn-warning"><i class="fa fa-arrow-circle-left"></i>&nbsp; KEMBALI</a>
                    &nbsp;
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i>&nbsp; SIMPAN</button>
                </div>
            </div>

        </form>

    </div>

</div>

<!-- END PANEL HEADLINE -->
