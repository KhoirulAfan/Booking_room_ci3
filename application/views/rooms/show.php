<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Booking rooms /</span> <?= $title ?></h4>			  
        <div class="row">
                <div class="col-5">
                    <div class="card">                        
                        <div class="card-header">
                            <h3 class="card-text">
                                <?=$title?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <?php 
                            foreach($data as $key =>$item):?>
                            <p class="card-text"><?= $key === 'id' ? '' : $key.' : '.$item ?></p>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div class="row">
                        <?php foreach($gambar as $gamba):?>
                            <div class="col-4">
                                <div class="card ">                                
                                        <img src="<?= base_url('uploads/'.$gamba->filename)?>" alt="" class="card_img_top">
                                </div>
                            </div>
                        <?php endforeach?>                                                            
                    </div>
                </div>
              </div>
    </div>
</div>