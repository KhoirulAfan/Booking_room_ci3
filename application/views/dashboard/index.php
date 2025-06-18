<?php $this->load->view('layout/header.php')?>
  <div class="content-wrapper">                
    <c class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4" ><span class="text-muted fw-light">Booking rooms /</span> Dashboard</h4>    
      <?php if($this->session->flashdata('success')):?>
                <div class="row">
                  <div class="alert alert-success alert-dismissible" role="alert">
                   <i class="bx bx-check"></i> <?= $this->session->flashdata('success') ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  </button>
                </div>
              <?php endif;?>
      <?php if($this->session->flashdata('login_success')):?>
        <div class="alert alert-primary alert-dismissible" role="alert">
          Selamat datang di website kami, <?= $this->session->userdata('name')?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
          </div>         
      <?php endif;?>
      <div class="row mb-4">
        <!-- total room -->
        <div class="mt-2 mt-lg-0 col-6 col-md-4 col-lg-3">
          <div class="card h-100">                 
            <div class="card-header d-flex justify-content-between"> 
              <h5 class="card-title">Total Room</h5>
              <div>
                <span class="badge bg-label-primary">All</span>
              </div>              
            </div>          
            <div class="card-body">
              <h1 class="card-text"><?= $summary_card['total_room'] ?></h1>
            </div>           
          </div>
        </div>         
        <!-- total users -->
        <div class="mt-2 mt-lg-0 col-6 col-md-4 col-lg-3">
          <div class="card h-100">                 
            <div class="card-header d-flex justify-content-between"> 
              <h5 class="card-title">Total Users</h5>
              <div>
                <span class="badge bg-label-primary">All</span>
              </div>              
            </div>          
            <div class="card-body">
              <h1 class="card-text"><?= $summary_card['total_user'] ?></h1>
            </div>            
          </div>
        </div>         
        <div class="mt-2 mt-lg-0 col-6 col-md-4 col-lg-3">
          <div class="card h-100">                 
            <div class="card-header d-flex justify-content-between"> 
              <h5 class="card-title">Room Booked</h5>
              <div>
                <span class="badge bg-label-primary">Now</span>
              </div>              
            </div>          
            <div class="card-body">
              <h1 class="card-text"><?= $summary_card['total_room_booked'] ?></h1>
            </div>            
          </div>
        </div>         
        <div class="mt-2 mt-lg-0 col-6 col-md-4 col-lg-3">
          <div class="card h-100"> 
            <div class="card-header d-flex justify-content-between"> 
              <h5 class="card-title">Room Avaliable</h5>
              <div>
                <span class="badge bg-label-primary">Now</span>
              </div>              
            </div>          
            <div class="card-body">
              <h1 class="card-text"><?= $summary_card['total_room_avaliable'] ?></h1>
            </div>            
          </div>
        </div>         
      </div>
      <!-- chart -->
      <div class="row mb-4">
        <div class="col-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h4 class="card-title m-0">Bookings Overview</h4>
              <div class="d-flex">
                <form action="">
                  <?php 
                      $select_overview = [
                        [
                          'value' => '',
                          'title' => 'This Week'
                        ],                                         
                        [
                          'value' => 'this_month',
                          'title' => 'This Month'
                        ],
                        [
                          'value' => 'last_month',
                          'title' => 'Last Month'
                        ],                        
                        [
                          'value' => 'this_year',
                          'title' => 'This Year'
                        ] 
                      ]
                      ?>
                      <select class="form-select form-select-sm" aria-label="Small select example" name="short" id="shortBy"> 
                        <?php foreach($select_overview as $select):?>  
                          <!-- <?= $overview == $select['value'] ? 'selected' : ''?> -->
                          <option   value="<?= $select['value']?>"><?= $select['title'] ?></option>
                        <?php endforeach?>
                      </select>
                  </form>                
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-8 mt-2">
          <div class="card h-100">
            <div class="card-body d-flex align-items-center justify-content-center">
              <canvas id="totalBooking" ></canvas>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-4 mt-2">
          <div class="card h-100">
            <div class="card-body d-flex align-items-center justify-content-center">
              <canvas id="statusBooking" width="300px" height="300px"></canvas>
            </div>
          </div>
        </div>
      </div>
      <!-- table booking terbaru -->
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Booking terbaru</h4>
            </div>
            <div class="card-body">
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
                      <?php if(count($booking_terbaru) >1):?>
                      <tbody class="table-border-bottom-0">
                        <?php $no=0; foreach($booking_terbaru as $item): $no++?>
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
                                  <a href="<?= base_url('bookings/update/'.$item->id.'/approve'.'?from=dashboard')?>" class="dropdown-item" href="javascript:void(0);" onclick="confirm('Are you sure to approve this booking data?')"><i class="bx bx-check me-1"></i>Approve</a>
                                  <a href="<?= base_url('bookings/update/'.$item->id.'/reject'.'?from=dashboard')?>" class="dropdown-item" href="javascript:void(0);" onclick="confirm('Are you sure to reject this booking data?')"><i class="bx bx-x me-1"></i> Reject</a>
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
       </div>
    </c>            
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const totalBooking = document.getElementById('totalBooking').getContext('2d');
    const statusBooking = document.getElementById('statusBooking').getContext('2d');
    new Chart(totalBooking, {
      type: 'line',
      data: {
        labels: <?= $chart_total_booking['label'] ?>,
        datasets: [{
          label:'<?= $chart_total_booking['title'] ?>',
          data: <?= $chart_total_booking['data'] ?>,
          fill:true,
          backgroundColor: 'rgba(54, 162, 235, 0.5)'
        }]
      }
    });
    new Chart(statusBooking, {
      type: 'doughnut',
      data: {
        labels: ['Approved', 'Pending', 'Rejected'],
        datasets: [{
          label: 'Status Booking',
          data: [150, 100, 50],
          backgroundColor: [
            'rgba(21, 231, 0, 0.6)',
            'rgba(231, 186, 0, 0.6)',
            'rgba(255, 99, 132, 0.6)',
          ],
          borderColor: [
            'rgba(21, 231, 0, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(255, 99, 132, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top'
          },
          title: {
            display: true,
            text: 'Status Booking'
          }
        }
      }
    });
    </script>
    <?php $this->load->view('layout/footer.php')?>
     