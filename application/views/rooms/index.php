<?php $this->load->view('layout/header.php')?>
        <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->            
            <c class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Booking rooms /</span> <?= $title ?></h4>			  
              <?php if($this->session->flashdata('error')):?>
                <script>
                  alert(`<?= $this->session->flashdata('error')?>`)
                </script>
              <?php endif;?>
              <div class="row">
                <div class="card">
                <div class="card-header">
                  <h4>Table <?= $title ?></h4>
                  <div class="action">
                    <a href="<?= base_url('rooms/create')?>" class="btn btn-primary"><i class="bx bx-plus me-3"></i>Create</a>
                  </div>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Location</th>
                        <th>Capacity</th>
                        <th>Description</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php $no=0; foreach($data as $item):$no++?>
                        <tr>
                          <td><?= $no ?></td>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $item->name ?></strong></td>
                          <td><?= $item->status ?></td>
                          <td><?= $item->location ?></td>
                          <td><?= $item->capacity ?></td>
                          <td><?= $item->description ?></td>
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a href="<?= base_url('rooms/edit/'.$item->id)?>" class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                <a href="<?= base_url('rooms/delete/'.$item->id)?>" class="dropdown-item" href="javascript:void(0);" onclick="confirm('Are you sure to delete this room data?')"><i class="bx bx-trash me-1"></i> Delete</a>
                              </div>
                            </div>
                          </td>
                        </tr>                                                   
                      <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
              </div>
               
              </div>
			      </c>
            <!-- / Content -->
<?php $this->load->view('layout/footer.php')?>
     