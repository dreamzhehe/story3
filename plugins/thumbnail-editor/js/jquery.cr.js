var jcrop_api;
var crop = false;
var rezize = false;
function ImageEditor(e){
   var xsize = jQuery('#target').width();
   var ysize = jQuery('#target').height();
   if(e == 'crop'){
	 jQuery('#crop-tool').addClass('tool-border');
	 jQuery('#resize-tool').removeClass('tool-border');
	 if(rezize){
		jQuery( "#target" ).resizable( "destroy" );
	 }
	 crop = true;
	 jQuery('#target').Jcrop({
	  onChange:   showCoords,
	  onSelect:   showCoords,
	  onRelease:  clearCoords,
	  },function(){
		  jcrop_api = this;
	  });
   } else {
	   jQuery('#crop-tool').removeClass('tool-border');
	   jQuery('#resize-tool').addClass('tool-border');
	   if(crop){
		   jcrop_api.destroy();
	   }
	 rezize = true;
	 jQuery( "#target" ).resizable({
		aspectRatio: xsize / ysize,
		resize: function( event, ui ) {
			jQuery('#rw').val(ui.size.width);
			jQuery('#rh').val(ui.size.height);
		}
	});
   }
}
function showCoords(c) {
	jQuery('#x1').val(c.x);	jQuery('#y1').val(c.y);	jQuery('#x2').val(c.x2); jQuery('#y2').val(c.y2); jQuery('#w').val(c.w); jQuery('#h').val(c.h);
}
function clearCoords(){
	jQuery('#x1').val(''); jQuery('#y1').val(''); jQuery('#x2').val(''); jQuery('#y2').val('');	jQuery('#w').val(''); jQuery('#h').val('');
}
jQuery( function() {jQuery( ".tool-item" ).tooltip();});