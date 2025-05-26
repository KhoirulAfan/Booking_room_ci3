<?php $this->load->view('layout/header.php')?>
        <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->            
            <c class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Booking rooms /</span> <?= $title ?></h4>			  
              <div class="row">
                <div class="card col-8">
                <div class="card-header">
                  <h4><?= $title ?></h4>
                  <div class="action">
                    <a href="<?= base_url('rooms/')?>" class="btn btn-secondary"><i class="bx bx-arrow-to-left me-1"></i>Back</a>
                  </div>
                </div>
                <div class="card-body">
                    <form action="<?= site_url('rooms/store')?>" method="post">
                        <div class="mb-3">
                          <label class="form-label" for="name">Name</label>
                          <input type="text" class="form-control" id="name" placeholder="Meeting Rooms" name="name">
                        </div>                        
                        <div class="mb-3">
                          <label class="form-label" for="location">Location</label>
                          <input type="text" class="form-control" id="location" placeholder="Lantai 2" name="location">
                        </div>                        
                        <div class="mb-3">
                          <label class="form-label" for="capacity">Capacity</label>
                          <input type="text" id="capacity" class="form-control phone-mask" placeholder="3" name="capacity">
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="description">Description</label>
                          <textarea id="description" class="form-control" placeholder="Ruang untuk kegiatan meeting ataupun yang lainya" name="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="bx bx-plus"></i>Create</button>
                      </form>
                </div>
              </div>
               
              </div>
			      </c>
            <!-- / Content -->
<?php $this->load->view('layout/footer.php')?>
     