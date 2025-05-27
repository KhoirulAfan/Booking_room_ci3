
	<?php $this->load->view('layout/header.php')?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->            
            <c class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Booking rooms /</span> Dashboard</h4>
            
              <div class="alert alert-primary alert-dismissible" role="alert">
                Selamat datang di website kami, <?= $this->session->userdata('name')?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
              </div>
			</c>
            <!-- / Content -->
		<?php $this->load->view('layout/footer.php')?>
     