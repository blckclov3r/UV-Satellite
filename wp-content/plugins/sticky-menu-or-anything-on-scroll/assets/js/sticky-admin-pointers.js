/*
 * Sticky Anything
 * Backend GUI pointers
 * (c) WebFactory Ltd, 2015 - 2021
 */


jQuery(document).ready(function($){
  if (typeof sticky_pointers  == 'undefined') {
    return;
  }

  $.each(sticky_pointers, function(index, pointer) {
    if (index.charAt(0) == '_') {
      return true;
    }
    $(pointer.target).pointer({
        content: '<h3>Sticky Menu (or Anything!) on Scroll</h3><p>' + pointer.content + '</p>',
        position: {
            edge: pointer.edge,
            align: pointer.align
        },
        width: 320,
        close: function() {
                $.post(ajaxurl, {
                    notice_name: index,
                    _ajax_nonce: sticky_pointers._nonce_dismiss_notice,
                    action: 'sticky_dismiss_notice'
                });
        }
      }).pointer('open');
  });
});
