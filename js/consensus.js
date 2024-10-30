var cboxOptions = {
  iframe: true,
  fixed: true,
  width: '95%',
  height: '95%',
  maxWidth: '1120px',
  maxHeight: '740px'
};

// Resize lightbox when browser window is resized.
jQuery(window).resize(function() {
  jQuery.colorbox.resize({
    width: window.innerWidth > parseInt(cboxOptions.maxWidth) ? cboxOptions.maxWidth : cboxOptions.width,
    height: window.innerHeight > parseInt(cboxOptions.maxHeight) ? cboxOptions.maxHeight : cboxOptions.height
  });
});

// Remove scrolling of parent content when lightbox is open.
jQuery(document).bind('cbox_open', function() {
    jQuery('body').css({ overflow: 'hidden' });
}).bind('cbox_closed', function() {
    jQuery('body').css({ overflow: '' });
});

jQuery(document).ready(function() {

  // Show lightbox on desktop and open a new tab to demo player on mobile.
  jQuery('.embed-video').on('click', function(e) {
    e.preventDefault();
    var mobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Mobile|HTC/i.test(navigator.userAgent);

    if (jQuery(this).data('mobile') === "newtab" && mobile) {
      window.open(jQuery('.embed-video').attr('href'), '_blank');
    }
    else {
      jQuery('.embed-video').colorbox(cboxOptions);
    }
  });

});
