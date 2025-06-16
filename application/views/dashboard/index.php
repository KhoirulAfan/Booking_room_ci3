<?php $this->load->view('layout/header.php')?>
  <div class="content-wrapper">                
    <c class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4" ><span class="text-muted fw-light">Booking rooms /</span> Dashboard</h4>    
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
      <div class="row">
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
                          'value' => 'last_week',
                          'title' => 'Last Week'
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
     