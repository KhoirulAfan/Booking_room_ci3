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
                    <form action="<?= site_url('bookings/store')?>" method="post">                      
                        <div class="mb-3">                          
                          <label for="select2" class="form-label">Room</label>
                          <select id="select2" class="form-select" data-allow-clear="true" name="room_id">
                            <?php foreach($rooms as $room):?>
                              <option value="<?=$room->id?>"><?= $room->name ?></option>
                            <?php endforeach;?>                              
                          </select>                          
                        </div>     
                        <div class="mb-3">
                          <label for="start_time" class="form-label">Start Time</label>
                          <input type="time" name="start_time" id="start_time" class="form-control">
                        </div>                                          
                        <div class="mb-3">
                          <label for="end_time" class="form-label">End Time</label>
                          <input type="time" name="end_time" id="end_time" class="form-control">
                        </div>                                          
                        <div class="mb-3">                          
                          <label for="select2" class="form-label">Status</label>
                          <select id="select2" class="form-select" data-allow-clear="true" name="status_id">
                            <?php foreach($status as $item):?>
                              <option value="<?=$item->id?>"><?= $item->name ?></option>
                            <?php endforeach;?>                              
                          </select>    
                        </div>     
                        <div class="mb-3">
                          <label for="purpose" class="form-label">Purpose</label>
                          <textarea name="purpose" id="purpose" class="form-control" placeholder="Purpose "></textarea>
                        </div>                      
                        <button type="submit" class="btn btn-primary"><i class="bx bx-plus"></i>Create</button>
                      </form>
                </div>
              </div>
               
              </div>
			      </c>
            <!-- / Content -->
<?php $this->load->view('layout/footer.php')?>
     