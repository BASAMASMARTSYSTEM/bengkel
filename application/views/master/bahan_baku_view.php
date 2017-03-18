<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<?php 
$data['page_title'] = 'Bahan Baku';
$data['bss'] = ' - BSS';
$this->load->view('header', $data); 
?>

<div class="container-fluid text-center">
	<p class="text-center"><h2>DAFTAR BAHAN BAKU</h2></p>		
</div>


<!-- Button trigger modal -->
<div class="container-fluid">
	<div class="panel-body">		
		<button class="btn btn-success" onclick="add_bahan()"><i class="glyphicon glyphicon-plus"></i> Tambah Bahan Baku</button>		
	</div>	
</div>


<!-- Modal Form-->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data Bahan</h4>
			</div>
			<div class="modal-body" form>
				<form action="#" id="form" role="form" data-toggle="validator">
				<div class="form-body">	
						<input type="hidden" value="" name="KodeBarang"/>
						<div class="form-group">
							<label for="Nama">Nama Bahan*</label>
							<input type="text" class="form-control" name="Nama" placeholder="Nama" data-error="Silahkan isi nama bahan" required>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="HargaBeli">Harga Beli*</label>
							<div class="input-group">
								<div class="input-group-addon">Rp</div>
								<input type="number" class="form-control" name="HargaBeli" placeholder="Harga Beli" data-error="Silahkan isi harga beli" required>
								<div class="input-group-addon">.00</div>
						    </div>						
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="HargaJual">Harga Jual*</label>
							<div class="input-group">
								<div class="input-group-addon">Rp</div>
								<input type="number" class="form-control" name="HargaJual" placeholder="Harga Jual" data-error="Silahkan isi harga jual" required>
								<div class="input-group-addon">.00</div>
						    </div>						
							<div class="help-block with-errors"></div>
						</div>					
						<div class="form-group">
							<label for="Stok">Stok*</label>
							<input type="number" class="form-control" name="Stok" placeholder="Stok" data-error="Silahkan isi stok bahan" required>						
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="Satuan">Satuan*</label>
							<input type="text" class="form-control" name="Satuan" placeholder="Satuan" data-error="Silahkan isi satuan bahan" required>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="KelompokAktiva">Kelompok Aktiva*</label>
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Aktiva Tetap = TIDAK HABIS 1X PAKAI | Aktiva Lancar = HABIS 1X PAKAI">
								<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
							</button>						
								<select class="form-control" name="KelompokAktiva" data-error="Silahkan pilih kelompok aktiva" required>								 
									 <option disabled selected value> -- pilih -- </option>
									 <option value="AKTIVA TETAP">AKTIVA TETAP</option>
									 <option value="AKTIVA LANCAR">AKTIVA LANCAR</option>
								 </select>  
							<div class="help-block with-errors"></div>
						</div>						
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
					<th class="text-center">NAMA BAHAN</th>
					<th class="text-center">HARGA BELI</th>
					<th class="text-center">HARGA JUAL</th>
					<th class="text-center">STOK</th>										
					<th class="text-center">SATUAN</th>					
					<th class="text-center">KELOMPOK</th>					
					<th style="width:6%"></th>
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
            "url": "<?php echo site_url('bahan_baku/tampil')?>",
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
			"targets": [ 4 ] 
		},
		{
			"targets": [ 3 ],
			"render": function ( data, type, row){
				return row[3] + ' ' + row[4];
			}
		},
		{
			"render": $.fn.dataTable.render.number( ',', '.', 0, 'Rp ' ),
			"targets": [ 1 ]
		},
		{
			"render": $.fn.dataTable.render.number( ',', '.', 0, 'Rp ' ),
			"targets": [ 2 ]
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

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


function add_bahan()
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
        url = "<?php echo site_url('bahan_baku/tambah')?>";
    } else {
        url = "<?php echo site_url('bahan_baku/perbaharui')?>";
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
            $('.modal-title').text('Tambah Data Bahan'); // Set title to Bootstrap modal title	
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


function ubah(KodeBarang)
	{
	    save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string

	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('bahan_baku/ubah/')?>/" + KodeBarang,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	        	$('[name="KodeBarang"]').val(data.KodeBarang);
	            $('[name="Nama"]').val(data.Nama);
	            $('[name="HargaBeli"]').val(data.HargaBeli);
	            $('[name="HargaJual"]').val(data.HargaJual);	            
	            $('[name="Stok"]').val(data.Stok);
	            $('[name="Satuan"]').val(data.Satuan);
	            $('[name="KelompokAktiva"]').val(data.KelompokAktiva);
	            $('#tambahModal').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text('Ubah Data Bahan'); // Set title to Bootstrap modal title	
	            $('#btnSimpan').text('Ubah'); //change button text

	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	}


function hapus(KodeBarang)
{
    if(confirm('Anda yakin akan menghapus data ini?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('bahan_baku/hapus')?>/"+KodeBarang,
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