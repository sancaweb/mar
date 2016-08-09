<script type="text/javascript">
	//color picker with addon
        $(".my-colorpicker").colorpicker();
		
		
		var rowNum = 0;
			
		$('#add_item').on( "click", function(e){
			e.preventDefault();
//			console.log( $( this ).text() );
			var i = ++rowNum;
			 $('#itemRows').append('<div class="row" id="rowNum'+i+'" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">\
			 <input type="hidden" name="pengulang[]" value="'+i+'">\
			 <div class="col-md-6">\
					<div class="form-group">\
                      <label>Nama Rekanan:</label>\
                      <div class="input-group col-xs-12" >\
					  <input name="rekanan[]" type="text" class="form-control " required>\
                      </div>\
                    </div>\
                    </div>\
					<div class="col-md-6 ">\
					<div class="form-group">\
                      <label>Alamat:</label>\
                      <div class="input-group col-xs-12" >\
                        <textarea name="alamat[]" class="form-control" rows="3" placeholder="Enter ..."></textarea>\
                      </div>\
                    </div>\
					</div>\
					<div class="col-md-6 ">\
					<div class="form-group">\
                      <label>Warna rekanan (untuk keperluan report graph):</label>\
                      <div class="input-group my-colorpicker'+i+'">\
					  <input type="text" name="warna[]" class="form-control" required/>\
                      <div class="input-group-addon">\
                        <i></i>\
                      </div>\
                    </div>\
                      </div>\
                    </div>\
					<div class="col-md-6 ">\
					<div class="form-group">\
                      <label>Jenis:</label>\
                      <div class="input-group">\
					  <select name="jenis[]" class="form-control" required>\
					<option value="">Pilih Jenis Rekanan</option>\
					<option value="umum">Umum</option>\
					<option value="rekanan">Rekanan</option>\
					</select>\
                    </div>\
                      </div>\
                    </div>\
                    <div class="col-md-2">\
					<div class="form-group">\
                      <div class="input-group">\
                        <a class="btn btn-app" onclick="removeRow('+i+');">\
							<i class="fa fa-minus"></i> Hapus\
						</a>\
                      </div>\
                    </div>\
					</div></div>');
					
			$(".my-colorpicker"+i).colorpicker();
		});
		
		
		
		function removeRow(i) {
			jQuery('#rowNum'+i).remove();
		}
	</script>