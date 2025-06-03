<?php $this->load->view('layout/header.php')?>
        <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->            
            <c class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Booking rooms /</span> <?= $title ?? 'Default title' ?></h4>			  
              <?php if($this->session->flashdata('error')):?>
                <script>
                  alert(`<?= $this->session->flashdata('error')?>`)
                </script>
              <?php endif;?>
              <?php if($this->session->flashdata('success')):?>
                <div class="row">
                  <div class="alert alert-success alert-dismissible" role="alert">
                   <i class="bx bx-check"></i> <?= $this->session->flashdata('success') ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  </button>
                </div>
              <?php endif;?>
                <div class="card">
                <div class="card-header">
                  <h4><?= $title ?></h4>
                  <div class="d-flex justify-content-between">
                    <a href="<?= base_url('booked/canceled')?>" class="btn btn-primary">Canceled</a> 
                    <div>
                        <form >
                            <input type="date" name="tgk" id="tgl" class="form-control">  <!-- belum bisa-->
                        </form>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach($data as $item): ?>
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="card">                                
                                <img src="<?= base_url('asset/img/elements/1.jpg')?>" alt="" class="card-img-top">                                
                                <div class="card-body">
                                    <h5 class="card-text"><?= $item->nama_room ?></h5>
                                    <p class="card-text">Tanggal: <?= date('d-m-Y',strtotime($item->start_time)) ?></p>
                                    <p class="card-text">Waktu: <?= date('H:i',strtotime($item->start_time)) ?> - <?= date('H:i',strtotime($item->end_time)) ?></p>
                                    <h6 class="card-text">
                                         <?php 
                                            $statusBadge = [
                                            'pending'  => 'warning',
                                            'approved' => 'success'
                                            ];
                                            $bade = $statusBadge[$item->status] ?? 'danger';
                                            ?>
                                            Status : 
                                            <div class="badge bg-label-<?= $bade?>">

                                            <?= $item->status ?>
                                            </div>
                                    </h6>
                                    <p class="card-text">Purpose : <?= $item->purpose ?></p>
                                    <a href="<?= base_url('booked/cancel/'.$item->id)?>" class="btn btn-warning" onclick="confirm('Are you sure to cancel booking <?= $item->nama_room?> room?') ">Cancel</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
              </div>
               
              </div>
			      </c>
            <!-- / Content -->
<?php $this->load->view('layout/footer.php')?>        