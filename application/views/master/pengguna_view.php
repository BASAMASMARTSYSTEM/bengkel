<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<?php 
$data['page_title'] = 'Pengguna';
$data['bss'] = ' - BSS';
$this->load->view('header', $data); 
?>

<div class="container-fluid text-center">
	<p class="text-center"><h2>DAFTAR PENGGUNA</h2></p>		
</div>


<!-- Button trigger modal -->
<div class="container-fluid">
	<div class="panel-body">		
		<button class="btn btn-success" onclick="add_pengguna()"><i class="glyphicon glyphicon-plus"></i> Tambah Pengguna</button>		
	</div>	
</div>





<!-- Modal Form-->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data Pengguna</h4>
			</div>
			<div class="modal-body" form>
				<form action="#" id="form" role="form" data-toggle="validator">
					<input type="hidden" value="" name="KodePengguna"/>
					<div class="form-group">
						<label for="Nama">Nama Lengkap*</label>
						<input type="text" class="form-control" name="Nama" placeholder="Nama" data-error="Silahkan isi nama lengkap pengguna" required>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="Username">Nama Pengguna*</label>
						<input type="text" class="form-control" name="Username" placeholder="Username" data-error="Silahkan isi nama pengguna" required>						
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="Password">Password*</label>
						<input type="password" class="form-control" name="Password" placeholder="Password" data-error="Silahkan isi Password pengguna" required>						
						<div class="help-block with-errors"></div>
					</div>					
					<div class="form-group">
						<label for="NoTelp">Nomor Telepon*</label>
						<input type="text" class="form-control" name="NoTelp" placeholder="Nomor Telepon" data-error="Silahkan isi nomor telepon pengguna" required>						
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="Status">Status*</label>
							<select class="form-control" name="Status" title="" data-error="Silahkan pilih kelompok pengguna" required>								 
								 <option disabled selected value> -- pilih -- </option>
								 <option value="USER">USER</option>
								 <option value="ADMINISTRATOR">ADMINISTRATOR</option>  								 
							 </select>  
						<div class="help-block with-errors"></div>
					</div>					
				</form>		
			</div>
			<div class="modal-footer">				
				<button class="btn btn-default" data-dismiss="modal"></span>Tutup</button>
				<button class="btn btn-primary" onclick="simpan()" id="btnSimpan">Simpan</button>
			</div>
		</div><!-- End of modal content -->
	</div><!-- End of modal dialog -->
</div> <!-- End of modal form -->




<!-- tabel -->
<div class="container-fluid">
	<div class="panel-body">
		<table id="table" class="table table-bordered table-hover" cellspacing="0" width="100%">
			<thead>
				<tr>					
					<th class="text-center">NAMA LENGKAP</th>					
					<th class="text-center">NAMA PENGGUNA</th>					
					<th class="text-center">TELEPON</th>
					<th class="text-center">STATUS</th>
					<th style="width:6%;"></th>
				</tr>
			</thead>		    
		    <tbody>
			</tbody>
		</table>
	</div>
</div>





<!-- Kode untuk Event -->
<script type="text/javascript">
	var save_method;


	$(document).ready(function() {

		//datatables
	    table = $('#table').DataTable({ 

	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.

	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('pengguna/tampil')?>",
	            "type": "POST"
	        },

	        //Set column definition initialisation properties.
	        "columnDefs": [
	        { 
	            "targets": [ -1 ], //last column
	            "orderable": false, //set not orderable
	        },
	        ],

	    });


	    //set input/textarea/select event when change value, remove class error and remove text help block 
	    $("input").change(function(){
	        $(this).parent().parent().removeClass('has-error');
	        $(this).next().empty();
	    });
	    $("textarea").change(function(){
	        $(this).parent().parent().removeClass('has-error');
	        $(this).next().empty();
	    });
	    $("select").change(function(){
	        $(this).parent().parent().removeClass('has-error');
	        $(this).next().empty();
	    });

	});



	function add_pengguna()
	{
	    save_method = 'add';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
    	$('.help-block').empty(); // clear error string
	    $('#tambahModal').modal('show'); // show bootstrap modal	    
	}


	function simpan()
	{		
		var url;
		
		$('#btnSimpan').attr('disabled',true); //set button disable

		if(save_method == 'add') {
	        url = "<?php echo site_url('pengguna/tambah')?>";
	    } else {
	        url = "<?php echo site_url('pengguna/perbaharui')?>";
	    }

	    // ajax adding data to database
	    $.ajax({
	        url : url,
	        type: "POST",
	        data: $('#form').serialize(),
	        dataType: "JSON",
	        success: function(data)
	        {

	            if(data.status) //if success close modal and reload ajax table
	            {
	                $('#tambahModal').modal('hide');
	                reload_table();
	            }
	            else
	            {
	                for (var i = 0; i < data.inputerror.length; i++) 
	                {
	                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
	                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
	                }
	            }
	            $('.modal-title').text('Tambah Data Pengguna'); // Set title to Bootstrap modal title	
	            $('#btnSimpan').text('Simpan'); //change button text
	            $('#btnSimpan').attr('disabled',false); //set button enable 


	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Gagal menambahkan data');	            
	            $('#btnSimpan').attr('disabled',false); //set button enable 

	        }
	    });
	}


	function reload_table()
	{
	    table.ajax.reload(null,false); //reload datatable ajax 
	}


	function ubah(KodePengguna)
	{
	    save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string

	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('pengguna/ubah/')?>/" + KodePengguna,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	        	$('[name="KodePengguna"]').val(data.KodePengguna);
	            $('[name="Nama"]').val(data.Nama);
	            $('[name="Username"]').val(data.Username);
	            $('[name="Password"]').val(data.Password);	            
	            $('[name="NoTelp"]').val(data.NoTelp);
	            $('[name="Status"]').val(data.Status);
	            $('#tambahModal').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text('Ubah Data Pengguna'); // Set title to Bootstrap modal title	
	            $('#btnSimpan').text('Ubah'); //change button text

	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	}


	function hapus(KodePengguna)
	{
	    if(confirm('Anda yakin akan menghapus data ini?'))
	    {
	        // ajax delete data to database
	        $.ajax({
	            url : "<?php echo site_url('pengguna/hapus')?>/"+KodePengguna,
	            type: "POST",
	            dataType: "JSON",
	            success: function(data)
	            {
	                //if success reload ajax table
	                $('#tambahModal').modal('hide');
	                reload_table();
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Data tidak bisa dihapus');
	            }
	        });

	    }
	}



</script>
<?php $this->load->view('footer'); ?>