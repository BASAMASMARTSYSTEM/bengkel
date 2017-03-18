<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<?php 
$data['page_title'] = 'Supplier';
$data['bss'] = ' - BSS';
$this->load->view('header', $data); 
?>

<div class="container-fluid text-center">	
	<p><h2>DAFTAR SUPPLIER</h2></p>	
</div>


<!-- Button trigger modal -->
<div class="container-fluid">
	<div class="panel-body">		
		<button class="btn btn-success" onclick="add_supplier()"><i class="glyphicon glyphicon-plus"></i> Tambah Supplier</button>		
	</div>	
</div>

<!-- Modal Form-->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data Supplier</h4>
			</div>
			<div class="modal-body" form>
				<form action="#" id="form" role="form" data-toggle="validator">
					<input type="hidden" value="" name="KodeSupplier"/>
					<div class="form-group">
						<label for="inputNama">Nama*</label>
						<input type="text" class="form-control" name="inputNama" placeholder="Nama" data-error="Silahkan isi nama supplier" required>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="inputAlamat">Alamat*</label>
						<textarea name="inputAlamat" placeholder="Alamat" class="form-control" rows="3" data-error="Silahkan isi alamat supplier" required></textarea>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="inputTelepon1">Telepon 1*</label>
						<input type="text" class="form-control" name="inputTelepon1" placeholder="Nomor Telepon" data-error="Silahkan isi nomor telepon supplier" required>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="inputTelepon2">Telepon 2</label>
						<input type="text" class="form-control" name="inputTelepon2" placeholder="Nomor Telepon">
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
					<th class="text-center">NAMA</th>
					<th class="text-center">ALAMAT</th>
					<th class="text-center" style="width:19%">TELP/HP</th>
					<th class="text-center">TELP/HP</th>
					<th style="width:6%;"></th>
				</tr>
			</thead>		    
		    <tbody>
			</tbody>
		</table>
	</div>
</div>

<!-- Modal Panel -->
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
            "url": "<?php echo site_url('supplier/tampil')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        { 			
			"visible": false,  
			"targets": [ 3 ] 
		},
		{
			"targets": [ 2 ],
			"render": function ( data, type, row){
				return row[2] + ' | ' + row[3];
			}
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

	function add_supplier()
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
	        url = "<?php echo site_url('supplier/tambah')?>";
	    } else {
	        url = "<?php echo site_url('supplier/perbaharui')?>";
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
	            $('.modal-title').text('Tambah Data Supplier'); // Set title to Bootstrap modal title	
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

	function hapus(KodeSupplier)
	{
	    if(confirm('Anda yakin akan menghapus data ini?'))
	    {
	        // ajax delete data to database
	        $.ajax({
	            url : "<?php echo site_url('supplier/hapus')?>/"+KodeSupplier,
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


	function ubah(KodeSupplier)
	{
	    save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string

	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('supplier/ubah/')?>/" + KodeSupplier,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	        	$('[name="KodeSupplier"]').val(data.KodeSupplier);
	            $('[name="inputNama"]').val(data.Nama);
	            $('[name="inputAlamat"]').val(data.Alamat);
	            $('[name="inputTelepon1"]').val(data.NoTelp1);
	            $('[name="inputTelepon2"]').val(data.NoTelp2);
	            $('#tambahModal').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text('Ubah Data Supplier'); // Set title to Bootstrap modal title	
	            $('#btnSimpan').text('Ubah'); //change button text

	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	}


</script>

<?php $this->load->view('footer')
; ?>