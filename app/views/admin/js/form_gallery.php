
<script type="text/javascript">
		
		var rowNum = 0;
			
		$('#add_item').on( "click", function(e){
			e.preventDefault();
//			console.log( $( this ).text() );
			var i = ++rowNum;
			 $('#itemRows').append('<div id="rowNum'+i+'" >\
			 <input type="hidden" name="pengulang[]" value="'+i+'">\
				<div class="col-md-6">\
					<div class="form-group">\
					  <label>Foto:</label>\
					  <div class="input-group col-xs-12" >\
					  <input name="foto'+i+'" type="file" required>\
					  </div>\
					</div>\
					</div>\
					<div class="col-md-6 ">\
					<div class="form-group">\
					  <label>Keterangan Singkat Foto:</label>\
					  <div class="input-group col-xs-12" >\
					  <textarea name="keterangan_foto[]" class="form-control" rows="3" > </textarea>\
					  </div>\
					</div>\
					</div><div class="col-md-12">\
					<div class="form-group">\
                      <div class="input-group">\
                        <a class="btn btn-app" onclick="removeRow('+i+');">\
							<i class="fa fa-minus"></i> Hapus\
						</a>\
                      </div>\
                    </div>\
					</div></div>');
					
		});
		
		
		
		function removeRow(i) {
			jQuery('#rowNum'+i).remove();
		}
	</script>
	
<script type="text/javascript">
		
		var rowNum2 = 0;
			
		$('#add_item2').on( "click", function(e){
			e.preventDefault();
//			console.log( $( this ).text() );
			var j = ++rowNum2;
			 $('#itemRows2').append('<div id="rowNum2'+j+'" >\
			 <input type="hidden" name="pengulang[]" value="'+j+'">\
				<div class="col-md-6">\
					<div class="form-group">\
					  <label>Foto:</label>\
					  <div class="input-group col-xs-12" >\
					  <input name="foto'+j+'" type="file" required>\
					  </div>\
					</div>\
					</div>\
					<div class="col-md-6 ">\
					<div class="form-group">\
					  <label>Keterangan Singkat Foto:</label>\
					  <div class="input-group col-xs-12" >\
					  <textarea name="keterangan_foto[]" class="form-control" rows="3" > </textarea>\
					  </div>\
					</div>\
					</div><div class="col-md-12">\
					<div class="form-group">\
                      <div class="input-group">\
                        <a class="btn btn-app" onclick="removeRow('+j+');">\
							<i class="fa fa-minus"></i> Hapus\
						</a>\
                      </div>\
                    </div>\
					</div></div>');
					
		});
		
		
		
		function removeRow2(j) {
			jQuery('#rowNum2'+j).remove();
		}
	</script>
	