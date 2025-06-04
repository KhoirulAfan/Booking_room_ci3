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
                  <div class="action d-flex justify-content-between">
                    <div>
                      <a href="<?= base_url('bookings/create')?>" class="btn btn-primary"><i class="bx bx-plus me-3"></i>Create</a>
                    </div>
                    <div>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#printModal">
                        <i class="bx bx-printer"></i>
                        Print
                      </button>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#downloadPDFModal">
                        <i class="bx bx-file"></i>
                        Download PDF
                      </button>
                    </div>
                  </div>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Ruang</th>
                        <th>purpose</th>
                        <th>Nama user</th>                        
                        <th>status</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>action</th>
                      </tr>
                    </thead>
                    <?php if($data >1):?>
                    <tbody class="table-border-bottom-0">
                      <?php $no=0; foreach($data as $item): $no++?>
                        <tr>
                          <td><?= $no ?></td>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $item->nama_room ?></strong></td>
                          <td><?= $item->purpose ?></td>
                          <td><?= $item->nama_user ?></td>                          
                          <td>
                            <?php                             
                            $statusBadge = [
                              'pending'  => 'warning',
                              'approved' => 'success'
                            ];
                            $bade = $statusBadge[$item->status] ?? 'danger';
                            if($item->canceled):
                            ?>
                            <div class="badge bg-label-warning">
                              Canceled
                            </div>     
                            <?php else:;?>
                            <div class="badge bg-label-<?= $bade?>">
                              <?= $item->status ?>
                            </div>     
                            <?php endif;?>                       
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
                    <?php else:?>
                      <tbody class="table-border-bottom-0">
                        <tr>
                          <td class="text-center" colspan="8">Data kosong</td>
                        </tr>
                      </tbody>
                    <?php endif;?>
                  </table>
                </div>
              </div>
               
              </div>
			      </c>
            <!-- / Content -->
<?php $this->load->view('layout/footer.php')?>

<!-- modal print-->
<div class="modal fade" id="printModal" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" action="<?= site_url('bookings/print')?>" method="get">
      <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">Print PDF</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">              
        <div class="row g-4">
          <div class="col-12 mb-0">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" id="judulPrint" class="form-control" name="judul" >
          </div>
          <div class="col-12 mb-0">
            <label for="subJudul" class="form-label">SubJudul</label>
            <input type="text" id="subJudul" class="form-control" name="subjudul" >
          </div>
          <div class="col mb-0">
            <label for="tanggalMulai" class="form-label">Tanggal mulai</label>
            <input type="date" id="tanggalMulaiPrint" class="form-control" name="tanggal_mulai">
          </div>
          <div class="col mb-0">
            <label for="tanggalSelesai" class="form-label">Tanggal Selesai</label>
            <input type="date" id="tanggalSelesaiPrint" class="form-control" name="tanggal_selesai">
          </div>
        </div>
        <div class="row mt-3  ">
          <div class="col">
            <label for="checkbox_all_print">Semua</label>
            <input type="checkbox" name="all" id="checkbox_all_print">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Print</button>
      </div>
    </form>
  </div>
</div>

<script>
  const checkboxSemuaPrint = document.getElementById('checkbox_all_print');
  const inputStartTimePrint = document.getElementById('tanggalMulaiPrint');
  const inputEndTimePrint = document.getElementById('tanggalSelesaiPrint');
  checkboxSemuaPrint.addEventListener('change',function(){
    if(checkboxSemuaPrint.checked === true){
      inputStartTimePrint.disabled = true;
      inputEndTimePrint.disabled = true;
    }else if(checkboxSemuaPrint.checked === false){
      inputStartTimePrint.disabled = false;
      inputEndTimePrint.disabled = false;
    }
  })
  // const fitur lain kali jika sempat: jika all ceklist maka input start time dan endrime akan disabled
</script>

<!-- modal download pdf-->
<div class="modal fade" id="downloadPDFModal" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-4">
            <label for="nameBackdrop" class="form-label">Name</label>
            <input type="text" id="nameBackdrop" class="form-control" placeholder="Enter Name">
          </div>
        </div>
        <div class="row g-4">
          <div class="col mb-0">
            <label for="emailBackdrop" class="form-label">Email</label>
            <input type="email" id="emailBackdrop" class="form-control" placeholder="xxxx@xxx.xx">
          </div>
          <div class="col mb-0">
            <label for="dobBackdrop" class="form-label">DOB</label>
            <input type="date" id="dobBackdrop" class="form-control" >
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>
