/**
 * Sticky Menu or Anything
 * (c) WebFactory 2021, https://wpsticky.com/
 */

jQuery(function ($) {
  $('.nav-tab-wrapper a, a.faq').not('.nav-tab-pro').on('click', function (t) {
    var tab_id = $(this).attr('href').replace('#', '.tab-sticky-');
    var tab_name = $(this).attr('href').replace('#', '');

    // Set the current tab active
    $(this).parent().children().removeClass('nav-tab-active');
    $(this).addClass('nav-tab-active');

    // Show the active content
    $('.tab-content').addClass('hide');
    $('.tabs-content div' + tab_id).removeClass('hide');
    $('input[name="sa_tab"]').val(tab_name);

    // Change the URL
    var currentURL = window.location.href;
    if (currentURL.indexOf('&tab') > 0) {
      var newURL = currentURL.substring(0, currentURL.indexOf('&tab')) + '&tab=' + tab_name;
    } else {
      var newURL = currentURL + '&tab=' + tab_name;
    }

    switch (tab_name) {
      case 'advanced':
        var tab_title = 'Advanced Settings';
        break;
      case 'faq':
        var tab_title = 'Support/FAQ';
        break;
      default:
        var tab_title = 'Basic Settings';
    }

    window.history.pushState(tab_title, tab_title, newURL);
    t.preventDefault();
  });

  $('a.faq').on('click', function (t) {
    $('.nav-tab-wrapper a').removeClass('nav-tab-active');
    $('.nav-tab-wrapper a[href="#faq"]').addClass('nav-tab-active');
  });

  $('#sa_legacymode').on('change', function () {
    if ($('#sa_legacymode').is(':checked')) {
      $('#row-dynamic-mode').removeClass('disabled-feature');
      $('#row-dynamic-mode .showhide').slideDown();
    } else {
      $('#row-dynamic-mode').addClass('disabled-feature');
      $('#row-dynamic-mode .showhide').slideUp();
    }
  });

  $('.sticky-color-field').wpColorPicker();

  $('.form-table').on('click', '.disabled-feature', function (e) {
    e.preventDefault();
  });

  $('.open-sticky-pro-dialog').on('click', function(e) {
    e.preventDefault();

    $('#sticky-pro-dialog').dialog('open');

    pro_feature = $(this).data('pro-feature');
    if (!pro_feature) {
      pro_feature = 'unknown';
    }

    $('.button-buy').each(function(ind, el) {
      tmp = $(el).data('href-org');
      tmp = tmp.replace('pricing-table', pro_feature);
      $(el).attr('href', tmp);
    });

    return false;
  });

  $('#sticky-pro-dialog').dialog({
    dialogClass: 'wp-dialog sticky-pro-dialog',
    modal: true,
    resizable: false,
    width: 800,
    height: 'auto',
    show: 'fade',
    hide: 'fade',
    close: function (event, ui) {
    },
    open: function (event, ui) {
      $(this).siblings().find('span.ui-dialog-title').html('WP Sticky PRO is here!');
      sticky_fix_dialog_close(event, ui);
    },
    autoOpen: false,
    closeOnEscape: true,
  });

  if (wpsticky.auto_open_pro_dialog) {
    $('#sticky-pro-dialog').dialog('open');
  }
});

function sticky_fix_dialog_close(event, ui) {
  jQuery('.ui-widget-overlay').bind('click', function () {
    jQuery('#' + event.target.id).dialog('close');
  });
} // sticky_fix_dialog_close
