<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<?php 
$data['page_title'] = 'Pembelian Bahan Baku';
$data['bss'] = ' - BSS';
$this->load->view('header', $data); 
?>

<div class="container-fluid text-center">
	<p class="text-center"><h2>PEMBELIAN BAHAN BAKU</h2></p>		
</div>

<div class="container-fluid">
	<div class="panel-body">
		
		<!-- tab panel begin -->
		<div>
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#head" aria-controls="head" role="tab" data-toggle="tab">Head Pembelian</a></li>
		    <li role="presentation"><a href="#detail" aria-controls="detail" role="tab" data-toggle="tab">Detail Pembelian</a></li>		    
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
		    <!-- tab panel head transaction -->
		    <div role="tabpanel" class="tab-pane active" id="head">
		    	<!-- begin of head transaction -->
		    	<div class="modal-body">
					<div class="well well-lg">
						<div class="modal-body" form>
							<form action="#" id="form" role="form" data-toggle="validator">
							<div class="form-body">							
								<div class="form-group">
									<label for="KodeToko">Pilih Toko Bahan*</label>
									<input type="text" class="form-control" name="KodeToko" placeholder="Nama Toko Bahan" data-error="Silahkan isi nama toko bahan" required>
									<div class="help-block with-errors"></div>
								</div>						
			                </div>					
							</form>		
						</div>
					</div>
					<div class="container-fluid text-center">
						<button class="btn btn-info" type="submit">
							<span class="glyphicon glyphicon-step-forward" aria-hidden="true"></span> Selanjutnya
						</button>
					</div>					
				</div>
				<!-- end of head transacrion -->
		    </div>
		    <!-- end of tab panel head transaction -->


		    <!-- tab panel detail transacrion -->
		    <div role="tabpanel" class="tab-pane" id="detail">
		    	<div class="container-fluid text-center">
					<p class="text-center"><h2>2</h2></p>		
				</div>
		    </div>		    
		    <!-- end of tab panel detail transacrion -->

		  </div>

		</div>
		<!-- tab panel end -->

	</div>
</div>


<!-- Kode untuk event -->
<script type="text/javascript">
	
$('#KodeToko').select2({
	
});


</script>

<?php $this->load->view('footer'); ?>