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
                  <h4>Table <?= $title ?></h4>
                  <div class="action">
                    <a href="<?= base_url('bookings/create')?>" class="btn btn-primary"><i class="bx bx-plus me-3"></i>Create</a>
                  </div>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Ruang</th>
                        <th>Nama user</th>
                        <th>status</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php $no=0; foreach($data as $item): $no++?>
                        <tr>
                          <td><?= $no ?></td>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $item->nama_room ?></strong></td>
                          <td><?= $item->nama_user ?></td>
                          <td>
                            <?php 
                            $statusBadge = [
                              'pending'  => 'warning',
                              'approved' => 'success'
                            ];
                            $bade = $statusBadge[$item->status] ?? 'danger';
                            ?>
                            <div class="badge bg-label-<?= $bade?>">
                              <?= $item->status ?>
                            </div>                            
                          </td>
                          <td><?= $item->start_time ?></td>
                          <td><?= $item->end_time ?></td>                          
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a href="<?= base_url('bookings/update/'.$item->id.'/approve')?>" class="dropdown-item" href="javascript:void(0);" onclick="confirm('Are you sure to approve this booking data?')"><i class="bx bx-check me-1"></i>Approve</a>
                                <a href="<?= base_url('bookings/update/'.$item->id.'/reject')?>" class="dropdown-item" href="javascript:void(0);" onclick="confirm('Are you sure to reject this booking data?')"><i class="bx bx-x me-1"></i> Reject</a>
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
     