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

        <div class="row">

            <div class="col-md-3">
                <a href="" class="thumbnail">
                    <?php if (empty($item['foto'])): ?>
                        <img src="<?php echo base_url('static/photos/default-user.png'); ?>">
                    <?php else: ?>
                        <img src="<?php echo base_url('static/photos/operator/' . $item['foto']); ?>">
                    <?php endif; ?>
                </a>
            </div>

            <div class="col-md-9">

                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <td>
                                <b>Nama Lengkap</b>
                            </td><td>
                                <?php echo $item['nama']; ?>
                            </td>
                        </tr><tr>
                            <td>
                                <b>Email</b>
                            </td><td>
                                <?php echo $item['email']; ?>
                            </td>
                        </tr><tr>
                            <td>
                                <b>Level</b>
                            </td><td>
                                <?php if ($item['admin'] == "0") { echo "Sales"; } else { echo "Super Admin"; }  ?>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>
<div align="center">
				<?php if($this->session->userdata('ses_admin')=='1'):?>
                <a href="<?php echo base_url('manage/operator'); ?>" class="btn btn-warning">KEMBALI</a>
				<?php endif; ?>
            </div>
 </div>

</div>

<!-- END PANEL HEADLINE -->
