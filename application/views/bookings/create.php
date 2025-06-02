<?php $this->load->view('layout/header.php')?>
        <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->            
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Booking rooms /</span> <?= $title ?></h4>			  
              <div class="row">
                <div class="card col-8">
                <div class="card-header">
                  <h4><?= $title ?></h4>
                  <div class="action">
                    <a href="<?= base_url('bookings/')?>" class="btn btn-secondary"><i class="bx bx-arrow-to-left me-1"></i>Back</a>
                  </div>
                </div>
                <php class="card-body">                  
                    <form action="<?= site_url('bookings/store')?>" method="post">                      
                        <php class="mb-3">                          
                          <label for="select2" class="form-label">Room</label>
                          <select id="select2" class="form-select" data-allow-clear="true" name="room_id">
                            <?php foreach($rooms as $room):?>                              
                              <option <?= set_value('room_id') === $room->id ? 'selected' : '' ?> value="<?=$room->id?>"><?= $room->name ?></option>
                            <?php endforeach;?>                              
                          </select>                          
                          <?= form_error('room_id','<small class="text-danger">', '</small>'); ?>                        
                        </php>     
                        <ph class="mb-3">
                          <label for="start_time" class="form-label">Start Time</label>
                          <input type="time" name="start_time" id="start_time" class="form-control" value=" <?= set_value('start_time')?> ">
                          <?php if($this->session->flashdata('error')):?>
                            <p class="text-danger">
                              <?= $this->session->flashdata('error') ?>
                            </p>
                          <?php endif;?>
                          <?= form_error('start_time','<small class="text-danger">', '</small>'); ?>
                        </ph>                                          
                        <div class="mb-3">
                          <label for="end_time" class="form-label">End Time</label>
                          <input type="time" name="end_time" id="end_time" class="form-control" value="<?= set_value('end_time') ?>">                          
                          <?= form_error('end_time','<small class="text-danger">', '</small>'); ?>
                        </div>                                          
                        <div class="mb-3">                          
                          <label for="select2" class="form-label">Status</label>
                          <select id="select2" class="form-select" data-allow-clear="true" name="status_id">
                            <?php foreach($status as $item):?>
                              <option <?= set_value('status_id') === $item->id ? 'selected' : '' ?> value="<?=$item->id?>"><?= $item->name ?></option>
                            <?php endforeach;?>                              
                          </select> 
                          <?= form_error('status_id','<small class="text-danger">', '</small>'); ?>   
                        </div>     
                        <div class="mb-3">
                          <label for="purpose" class="form-label">Purpose</label>
                          <textarea name="purpose" id="purpose" class="form-control" placeholder="Purpose "><?= set_value('purpose') ?></textarea>
                          <?= form_error('purpose','<small class="text-danger">', '</small>'); ?>
                        </div>                      
                        <button type="submit" class="btn btn-primary"><i class="bx bx-plus"></i>Create</button>
                      </form>
                </php>
              </div>
               
              </div>
			      </div>
            <!-- / Content -->
<?php $this->load->view('layout/footer.php')?>
     