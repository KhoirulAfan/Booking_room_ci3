<?php $this->load->view('layout/header.php')?>
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
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Ruang</th>
                        <th>purpose</th>
                        <th>Nama user</th>
                        <th>canceled</th>                        
                        <th>status</th>                        
                        <th>Start</th>
                        <th>End</th>                        
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php $no=0; foreach($data as $item): $no++?>
                        <tr>
                          <td><?= $no ?></td>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $item->nama_room ?></strong></td>
                          <td><?= $item->purpose ?></td>
                          <td><?= $item->nama_user ?></td>                          
                          <td>
                            <div class="badge bg-label-warning">
                                <?= $item->canceled ? 'canceled' : 'not canceled' ?>
                            </div>                            
                          </td>                          
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
                          <td>
                            <small>
                              <?= date('d-m-Y',strtotime($item->start_time))?>
                            </small>
                            <span class="badge bg-label-primary">
                              <?= date('H:i',strtotime($item->start_time))?>
                            </span>
                          </td>
                          <td>
                            <small>
                              <?= date('d-m-Y',strtotime($item->end_time))?>
                            </small>
                            <span class="badge bg-label-primary">
                              <?= date('H:i',strtotime($item->end_time))?>
                            </span>
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