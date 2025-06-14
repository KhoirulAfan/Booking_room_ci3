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
                <div class="card-header ">    
                  <div class="d-flex justify-content-between align-items-center">
                    <h2 class="card-text">Table <?= $title ?></h2>                                                           
                  </div>
                    <div class="d-flex justify-content-between align-items-center">  
                    <div>
                      <a href="<?= base_url('bookings/create')?>" class="btn btn-primary"><i class="bx bx-plus"></i>Create</a>
                    </div>                                
                    <!-- fitur lainya -->
                    <div class="d-flex gap-1 mt-2">  
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
                <div class="card-body border">
                  <form action="<?= base_url('bookings')?>" class="d-flex gap-1 align-items-baseline justify-content-between my-3" id="searchForm" method="get">
                    <!-- search -->
                    <div class="d-flex gap-1">
                      <div class="input-group" >
                      <label for="searchbar" class="input-group-text bg-white border-end-0">
                        <i class="bx bx-search"></i>
                      </label>
                      <input
                        id="searchbar"
                        type="text"
                        class="form-control border-start-0"
                        placeholder="Search… [CTRL + K]"
                        aria-label="Search"
                        name="search"
                        value="<?= $search ?? ''?>"
                      />                      
                      </div>
                    <button type="submit" class="btn btn-primary">
                      <i class="bx bx-search fs-5" id="iconInput"></i>
                    </button>
                    </div>
                    <!-- filtering -->
                    <div class="filtering d-flex gap-1">
                      <div>
                      <?php 
                      $selects = [
                        [
                          'value' => '',
                          'title' => 'Short By'
                        ],
                        [
                          'value' => 'nama_room',
                          'title' => 'Ruang'
                        ],
                        [
                          'value' => 'nama_user',
                          'title' => 'Nama User'
                        ],
                        [
                          'value' => 'status',
                          'title' => 'Status'
                        ],
                        [
                          'value' => 'start_time',
                          'title' => 'Start Time'
                        ],
                        [
                          'value' => 'end_time',
                          'title' => 'End time'
                        ]                        
                      ]
                      ?>
                      <select class="form-select form-select-sm" aria-label="Small select example" name="short" id="shortBy"> 
                        <?php foreach($selects as $select):?>  
                          <option <?= $short_by == $select['value'] ? 'selected' : ''?>  value="<?= $select['value']?>"><?= $select['title'] ?></option>
                        <?php endforeach?>
                      </select>
                    </div>
                    <!-- <div>                            
                      <select class="form-select form-select-sm" aria-label="Small select example" name="filter" id="filter">
                        <option selected value="">Order By</option>
                        <option value="asc">ASC</option>                            
                        <option value="asc">ASC</option>                            
                        <option value="asc">ASC</option>                            
                      </select>
                    </div> -->
                    </div>
                  </form>
                <!-- script untuk url agar rapi -->
                 <script>
                  const searchForm = document.getElementById('searchForm');                  
                  const searchInput = document.getElementById('searchbar');                          
                  const shortBy = document.getElementById('shortBy');
                  console.log(shortBy);
                  function removeAtributeNameIfNull(){
                    if (!shortBy.value) {
                      shortBy.removeAttribute('name');
                    }
                    // if (!filter.value) {
                    //   filter.removeAttribute('name');
                    // }
                    if (!searchInput.value) {                    
                      searchInput.removeAttribute('name');
                    }
                    searchForm.submit();
                  }
                  
                  shortBy.addEventListener('change', removeAtributeNameIfNull);                                                  
                  searchForm.addEventListener('submit', removeAtributeNameIfNull);  

                  document.addEventListener('keydown',function(e){
                    if(e.ctrlKey && e.key.toLowerCase() == 'k'){
                      e.preventDefault()
                      searchInput.focus()
                    }
                  });
                 </script>

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
                      <?php if(count($data) >1):?>
                      <tbody class="table-border-bottom-0">
                        <?php $no=0; foreach($data as $item): $no++?>
                          <tr>
                            <td><?= $no ?></td>
                            <td><i class="fab fa-angular fa-lg text-danger"></i> <strong><?= $item->nama_room ?></strong></td>
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
               
              </div>
			      </c>
            <!-- / Content -->
<?php $this->load->view('layout/footer.php')?>

<!-- modal print-->
<div class="modal fade" id="printModal" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" action="<?= site_url('bookings/print')?>" method="get" target="_blank">
      <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">Print PDF</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">              
        <div class="row g-4">
          <div class="col-12 mb-0">
            <label for="judulPrint" class="form-label">Judul</label>
            <input type="text" id="judulPrint" class="form-control" name="judul" >
          </div>
          <div class="col-12 mb-0">
            <label for="subJudul" class="form-label">SubJudul</label>
            <input type="text" id="subJudul" class="form-control" name="subjudul" >
          </div>
          <div class="col mb-0">
            <label for="tanggalMulaiPrint" class="form-label">Tanggal mulai</label>
            <input type="date" id="tanggalMulaiPrint" class="form-control" name="tanggal_mulai" >
          </div>
          <div class="col mb-0">
            <label for="tanggalSelesaiPrint" class="form-label">Tanggal Selesai</label>
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
        <button type="submit" class="btn btn-primary" >Print</button>
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

<!-- modal download-->
<div class="modal fade" id="downloadPDFModal" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" action="<?= site_url('bookings/download')?>" method="get" target="_blank">
      <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">Download PDF</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">              
        <div class="row g-4">
          <div class="col-12 mb-0">
            <label for="judulDownload" class="form-label">Judul</label>
            <input type="text" id="judulDownload" class="form-control" name="judul" >
          </div>    
          <div class="col mb-0">
            <label for="tanggalMulaiDownload" class="form-label">Tanggal mulai</label>
            <input type="date" id="tanggalMulaiDownload" class="form-control" name="tanggal_mulai">
          </div>
          <div class="col mb-0">
            <label for="tanggalSelesaiDownload" class="form-label">Tanggal Selesai</label>
            <input type="date" id="tanggalSelesaiDownload" class="form-control" name="tanggal_selesai">
          </div>
        </div>
        <div class="row mt-3  ">
          <div class="col">
            <label for="checkbox_all_download">Semua</label>
            <input type="checkbox" name="all" id="checkbox_all_download">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Download</button>
      </div>
    </form>
  </div>
</div>

<script>
  const checkboxSemuaDownload = document.getElementById('checkbox_all_download');
  const inputStartTimeDownload = document.getElementById('tanggalMulaiDownload');
  const inputEndTimeDownload = document.getElementById('tanggalSelesaiDownload');
  checkboxSemuaDownload.addEventListener('change',function(){
    if(checkboxSemuaDownload.checked === true){
      inputStartTimeDownload.disabled = true;
      inputEndTimeDownload.disabled = true;
    }else if(checkboxSemuaDownload.checked === false){
      inputStartTimeDownload.disabled = false;
      inputEndTimeDownload.disabled = false;
    }
  })
  // const fitur lain kali jika sempat: jika all ceklist maka input start time dan endrime akan disabled
</script>

