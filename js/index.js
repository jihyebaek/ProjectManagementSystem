// Inline popups
$('#inline-popups, #inline-popups2, #inline-popups3, #inline-popups4, #inline-popups5, #inline-popups6').magnificPopup({
  delegate: 'a',
  removalDelay: 500, //delay removal by X to allow out-animation
  callbacks: {
    beforeOpen: function() {
       this.st.mainClass = this.st.el.attr('data-effect');
    }
  },
  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
});


// Image popups
$('#image-popups, #image-popups2, #image-popups3, #image-popups4, #image-popups5, #image-popups6').magnificPopup({
  delegate: 'a',
  type: 'image',
  removalDelay: 500, //delay removal by X to allow out-animation
  callbacks: {
    beforeOpen: function() {
      // just a hack that adds mfp-anim class to markup 
       this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
       this.st.mainClass = this.st.el.attr('data-effect');
    }
  },
  closeOnContentClick: true,
  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
});


// Hinge effect popup
$('a.hinge').magnificPopup({
  mainClass: 'mfp-with-fade',
  removalDelay: 1000, //delay removal by X to allow out-animation
  callbacks: {
    beforeClose: function() {
        this.content.addClass('hinge');
    }, 
    close: function() {
        this.content.removeClass('hinge'); 
    }
  },
  midClick: true
});