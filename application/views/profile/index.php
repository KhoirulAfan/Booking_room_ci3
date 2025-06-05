<?php 
$this->load->view('layout/header.php');
?>          
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->            
            <c class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Profile /</span> <?= $judul ?></h4>
              <div class="row">
                <div class="col-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-text">
                                <?=$judul?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <?php 
                            foreach($data as $key =>$item):?>
                            <p class="card-text"><?= $key.' : '.$item ?></p>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
              </div>
                     
			</c>
            <!-- / Content -->
