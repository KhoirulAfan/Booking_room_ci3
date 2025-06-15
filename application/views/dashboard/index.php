<?php $this->load->view('layout/header.php')?>                    
  <div class="content-wrapper">            
    <c class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Booking rooms /</span> Dashboard</h4>    
      <?php if($this->session->flashdata('login_success')):?>
        <div class="alert alert-primary alert-dismissible" role="alert">
          Selamat datang di website kami, <?= $this->session->userdata('name')?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
          </div>         
      <?php endif;?>
      <!-- <div class="row mb-4">
        <div class="col">
          <div class="card">            
            <div class="card-body">
              <p class="card-text"> <i class="bx bx-search"></i>Total data</p>
            </div>          
          </div>
        </div>               
      </div> -->
      <!-- chart -->
      <div class="row">
        <div class="col-12 col-md-7">
          <div class="card">
            <div class="card-body">
              <canvas id="totalBooking" ></canvas>
            </div>
          </div>
        </div>
      </div>
    </c>            
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const totalBooking = document.getElementById('totalBooking').getContext('2d');
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
    </script>
    <?php $this->load->view('layout/footer.php')?>
     