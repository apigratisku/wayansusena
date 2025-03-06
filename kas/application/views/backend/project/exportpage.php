<!-- PANEL HEADLINE -->

<div class="panel panel-headline">

    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $title; ?></h3>
    </div>

    <hr class="panel-divider">

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
            echo form_open('manage/prospek/export');
        ?>
		<div class="col-md-10">
		
			<div class="col-md-6">
				 <div class="form-group">
                <label for="nama_keahlian">Tanggal Awal</label>
					<input style="width:170px" type="text" class="form-control datetimepicker-alt" id="datetime1" name="tgl_a" placeholder="Pilih Tanggal Mulai" required autofocus>
					<script type="text/javascript">
					$("#datetime1").datetimepicker({
						format: 'yyyy-mm-dd',
						autoclose: true
					});
					</script>
				</div>
				 <div class="form-group">
                <label for="nama_keahlian">Tanggal Akhir</label>
					<input style="width:170px" type="text" class="form-control datetimepicker-alt" id="datetime2" name="tgl_b"  placeholder="Pilih Tanggal Akhir"  required autofocus>
					<script type="text/javascript">
					$("#datetime2").datetimepicker({
						format: 'yyyy-mm-dd',
						autoclose: true
					});
					</script>
				</div>
				<div class="form-group">
				<button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i>&nbsp; PROSES</button>&nbsp;
                    <a href="<?php echo base_url('manage/prospek/'); ?>" class="btn btn-warning"><i class="fa fa-arrow-circle-left"></i>&nbsp; KEMBALI</a>
				</div>
			</div>
        <hr>

        </form>

    </div>

</div>

<!-- END PANEL HEADLINE -->
