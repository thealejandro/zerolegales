$(document).ready(function () {
  $(".main-nav ul li:has(ul)").addClass("submenu");
  $(".main-nav ul li:has(ul)").append("<i></i>");
  $(".main-nav ul i").click(function () {
    $(this).parent("li").toggleClass("open");
    $(this).parent("li").children("ul").slideToggle();
  });
  $(".mob-btn").click(function () {
    if (!$("body").hasClass("show-menu")) {
      $("body").addClass("show-menu");
    } else {
      $("body").removeClass("show-menu");
    }
  });
  $(function () {
    $("select").selectpicker({
      width: "false",
    });
  });
  $(".overlay").click(function () {
    if ($("body").hasClass("show-menu")) {
      $("body").removeClass("show-menu");
    }
  });

  // mobile-only
  function backToScreen() {
    $("body").removeClass("show-menu");
  }

  $("#back-to-screen").click(function () {
    backToScreen();
  });
  moment.updateLocale("es", {
    week: { dow: 0 }, // Sunday is the first day of the week
    weekdaysMin: "D_L_M_M_J_V_S".split("_"),
  });

  $("#datetimepicker2").datetimepicker({
    format: "DD/MM/YYYY",
    useCurrent: false,
    viewDate: moment().subtract(18, 'years'),
    // maxDate: moment().millisecond(999).second(59).minute(59).hour(23),
    maxDate: moment().subtract(18, 'years'),
    widgetPositioning: {
      horizontal: "right",
      vertical: "bottom",
    },
    weekdaysShort: ["U", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
    icons: {
      previous: "icon-icons-arrow-chevron-left",
      next: "icon-icons-arrow-chevron-right",
    },
  });

  $("#datetimepicker3").datetimepicker({
    format: "DD/MM/YYYY",
    // debug: true,
    minDate: new Date().setHours(0, 0, 0, 0),
    widgetPositioning: {
      horizontal: "right",
      vertical: "bottom",
    },

    weekdaysShort: ["U", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
    icons: {
      previous: "icon-icons-arrow-chevron-left",
      next: "icon-icons-arrow-chevron-right",
    },
  });
  $("#datetimepicker4").datetimepicker({
    format: "DD/MM/YYYY",
    // debug: true,
    minDate: new Date().setHours(0, 0, 0, 0),
    widgetPositioning: {
      horizontal: "right",
      vertical: "bottom",
    },

    weekdaysShort: ["U", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
    icons: {
      previous: "icon-icons-arrow-chevron-left",
      next: "icon-icons-arrow-chevron-right",
    },
  });
  $("#datetimepicker5").datetimepicker({
    format: "MM/DD/YYYY",
    debug: true,
    useCurrent: false,
    // date: moment().subtract(18,'years'),
    maxDate: moment().subtract(18, 'years'),
    widgetPositioning: {
      horizontal: "right",
      vertical: "bottom",
    },
    weekdaysShort: ["U", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
    icons: {
      previous: "icon-icons-arrow-chevron-left",
      next: "icon-icons-arrow-chevron-right",
    },
  });
  //input mask
  $("#cardnumber").inputmask({
    mask: "9999 9999 9999 9999",
    showMaskOnHover: false,
    showMaskOnFocus: false,
    placeholder: "",
  });
  $("#expdate").inputmask({
    mask: "99/99",
    showMaskOnHover: false,
    showMaskOnFocus: false,
    placeholder: "",
  });
  $("#cvv").inputmask({
    mask: "***",
    showMaskOnHover: false,
    showMaskOnFocus: false,
    placeholder: "",
  });
  // switch toggle-content

  // $("#checklegalizatin").on("click", function (event) {
  //   $(".content-show").toggle();
  // });
  //   $('#checklegalizatin').on('change.bootstrapSwitch', function(state) {
  //     if(state== true){
  //       alert('hi');
  //     }
  //     else{
  //       alert('true');
  //     }
  // });
  // $("#checklegalizatin").on("click", function (e) {
  // $("#checklegalizatin").change.bootstrapSwitch({
  //   onSwitchChange: function(e, state) {
  //     $('.content-show').toggle(state);
  //   }
  // });
  // });
  // $('#checklegalizatin').click(function() {

  // });

  //   $('#checklegalizatin').change(function (event) {
  //     var state = $(this).bootstrapSwitch('state');
  //     if (state) {
  //      console.log('test');
  //     } else {
  //        // false
  //     }
  //     event.preventDefault();
  // });

  $("#savedoc").click(function () {
    //use a class, since your ID gets mangled
    //add the class to the clicked element
    $(".pay-form .form-inner-required").toggleClass("opact");
    $(".pay-form .form-control").prop("disabled", function (i, v) {
      return !v;
    });
  });
  $("#foreigncheck").click(function () {
    //use a class, since your ID gets mangled
    //add the class to the clicked element
    $(".opt-doc-sect").toggleClass("opact-2");
    $(".opt-doc-sect .form-control").toggleClass("disabled", function (i, v) {
      return !v;
    });
  });

  // isotope-filter
  // external js: isotope.pkgd.js

  // init Isotope
  var qsRegex;
  // filter functions


  function getHashFilter() {
    // get filter=filterName
    var matches = location.hash.match(/filtrar=([^&]+)/i);
    var hashFilter = matches && matches[1];
    return hashFilter && decodeURIComponent(hashFilter);

  }

  var $grid = $('.grid');

  // bind filter button click
  var $filterButtonGroup = $('.filters-button-group');
  $filterButtonGroup.on('click', 'li', function () {
    var filterAttr = $(this).attr('data-filter');
    // set filter in hash
    location.hash = 'filtrar=' + encodeURIComponent(filterAttr);


  });

  // // use value of search field to filter
  // var $quicksearch = $('.search-doc').keyup( debounce( function() {
  //   console.log('mnv');
  //   qsRegex = new RegExp( $quicksearch.val(), 'gi' );
  //   console.log(qsRegex);
  //   $grid.isotope();
  // }) );

  // debounce so filtering doesn't happen every millisecond
  // function debounce( fn, threshold ) {
  //   console.log('mnv1');
  //   var timeout;
  //   threshold = threshold || 100;
  //   return function debounced() {
  //     clearTimeout( timeout );
  //     var args = arguments;
  //     var _this = this;
  //     function delayed() {
  //       fn.apply( _this, args ); 
  //     }
  //     timeout = setTimeout( delayed, threshold );
  //   };
  // }


  $(".button-group-mb").each(function (i, buttonGroup) {
    var $buttonGroup = $(buttonGroup);
    $buttonGroup.on("click", "li a", function () {
      $buttonGroup.find(".active").removeClass("active");
      $(this).addClass("active");
    });
  });

  var isIsotopeInit = false;

  function onHashchange() {
    var hashFilter = getHashFilter();

    if (!hashFilter && isIsotopeInit) {
      return;
    }
    isIsotopeInit = true;
    // filter isotope
    $grid.isotope({
      itemSelector: '.element-item',
      layoutMode: 'fitRows',

      // use filterFns
      filter: function () {
        var $this = $(this);
        var searchResult = qsRegex ? $this.text().match(qsRegex) : true;
        var buttonResult = hashFilter ? $this.is(hashFilter) : true;
        return searchResult && buttonResult;
      }
    });
    // use value of search field to filter
    // var $quicksearch = $('.search-doc').keyup( debounce( function() {
    //   qsRegex = new RegExp( $quicksearch.val(), 'gi' );
    //   $grid.isotope();
    // }) );
    // set selected class on button
    if (hashFilter) {
      $filterButtonGroup.find('.is-checked').removeClass('is-checked');
      $filterButtonGroup.find('.is-checked a').removeClass('active');
      $filterButtonGroup.find('.active').removeClass('active');
      $filterButtonGroup.find('[data-filter="' + hashFilter + '"]').addClass('is-checked');
      $filterButtonGroup.find('[data-filter="' + hashFilter + '"]').addClass('active');
      $filterButtonGroup.find('[data-filter="' + hashFilter + '"] a').addClass('active');
      var catname;
      $catname = $filterButtonGroup.find('[data-filter="' + hashFilter + '"]').find('h6').text();
      $("#filtermobileselect .dropdown-select-2").text($catname);
    }
  }

  $(window).on('hashchange', onHashchange);

  // trigger event handler to init Isotope
  onHashchange();
  var $allButtons = $('.filters-button-group').find('[data-filter="*"]');
  var $fltButton = $('.filters-button-group li');

  $("#search-btn").click(function () {
    $("#search-input").val("");
    $("#search-btn").html('<i class="icon-icons-search"></i>');
    // reset filters
    filters = {};
    $grid.isotope({ filter: '*' });
    $fltButton.removeClass('is-checked');
    $fltButton.find('a').removeClass('active');
    $fltButton.removeClass('active');
    $allButtons.addClass('is-checked');
    $allButtons.find('a').addClass('active');
    $allButtons.addClass('active');

  });
  $('.search-doc').keyup(function () {
    if (!$.trim(this.value).length) { // zero-length string AFTER a trim
      $fltButton.removeClass('is-checked');
      $fltButton.find('a').removeClass('active');
      $fltButton.removeClass('active');
      $allButtons.addClass('is-checked');
      $allButtons.find('a').addClass('active');
      $allButtons.addClass('active');
    }

  })
  $(".search-doc").keyup(debounce(function () {
    var value = $(this).val();
    $grid.isotope({
      filter: function () {
        var name = $(this).closest('.element-item').find("h5").text();
        var subtitle = $(this).find('.card-subtitle').text();
        var descp = $(this).closest('.element-item').find("p").text();
        var prices = $(this).find('.price-show').text();
        var re = new RegExp("[\s\S]*" + value, "i");
        return name.match(re) || subtitle.match(re) || descp.match(re) || prices.match(re);

      },
    });
  }));
  // debounce so filtering doesn't happen every millisecond
  function debounce(fn, threshold) {
    var timeout;
    threshold = threshold || 100;
    return function debounced() {
      clearTimeout(timeout);
      var args = arguments;
      var _this = this;
      function delayed() {
        fn.apply(_this, args);
      }
      timeout = setTimeout(delayed, threshold);
    };
  }
  // flatten object by concatting values
  function concatValues(obj) {
    var value = '';
    for (var prop in obj) {
      value += obj[prop];
    }
    return value;
  }

  // zoom magnify certificate
  // var status = "enable";
  // $(".zoom-view").click(function () {
  //   $(this).toggleClass('zoomwrp');

  //   $(this).find(".btn").toggleClass('zoom-active');

  //   if (status == "enable") {
  //     status = "disable";
  //     $("#zoom1").anythingZoomer({
  //       clone: true,

  //     })
  //     $('#zoom1').anythingZoomer('enable');
  //     $(this).closest('.cert-wrap-inner').find('.cert-preview ').removeClass('disable-zoom');
  //   } else {
  //     status = "enable";
  //     $('#zoom1').anythingZoomer('disable');
  //     $(this).closest('.cert-wrap-inner').find('.cert-preview ').addClass('disable-zoom');
  //   }
  // })

  // var status = "enable";
  // $(".zoom-view").click(function () {
  //  alert('hello');
  //   $(this).toggleClass('zoomwrp');

  //   $(this).find("btn").toggleClass('zoom-active');

  //   if (status == "enable") {
  //     status = "disable";

  //      $zoom = $('.zoom').magnify({
  //       // magnifiedWidth : 900,
  //       // magnifiedHeight : 1200
  //       finalWidth:750
  //     });
  //   } 
  //   else {
  //     status = "enable";
  //     $zoom.destroy();
  //   }
  // })


  // profile-activate
  $(function () {
    $('a[data-toggle="pill"]').on('click', function (e) {
      window.localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = window.localStorage.getItem('activeTab');
    if (activeTab) {
      $('#profile-tab a[href="' + activeTab + '"]').tab('show');
      window.localStorage.removeItem("activeTab");
    }
  });

});

// custom scrollbar
(function ($) {
  $(window).load(function () {
    $("#cert-wrap-inner").mCustomScrollbar({
      // setHeight : '60%',
      theme: "light",

      autoHideScrollbar: true,
    });
    $("#dropdcst").mCustomScrollbar({
      autoHideScrollbar: true,
    });
    $("#dropdcst-2").mCustomScrollbar({
      autoHideScrollbar: true,

    });
    $(".drop-down-sort").mCustomScrollbar({
      autoHideScrollbar: true,
    });
  });
});

(function ($) {
  $(window).resize(function () {
    if ($(this).width() > 768) {
      $('#cert-wrap-inner').mCustomScrollbar(); //apply scrollbar with your options 
    } else {
      $('#cert-wrap-inner').mCustomScrollbar("destroy"); //destroy scrollbar 
    }
  }).trigger("resize");
})(jQuery);

// custom dropdown select
$("#chooselegaladvs .dropdown-menu .dropdown-item ").on("click", function () {
  var getValue = $(this).find("h6").text();
  $(".dropdown-select").text(getValue);
  $(".list-group-item").removeClass("active");
  $(this).find(".list-group-item").toggleClass("active");
  $(".check-marked").hide();
  $(this).find(".check-marked").show();
  if (getValue) {
    console.log(getValue);
    $("#chooselegaladvs").addClass("select-drp-active");

  }
});
$("#chooselegaloc .dropdown-menu .dropdown-item").click(function () {
  var getValue = $(this).find("h6").text();
  $(".dropdown-select-2").text(getValue);
  $(".dropdown-item").removeClass("active");
  $(this).addClass("active");
  $(".check-marked-normal").hide();
  $(this).find(".check-marked-normal").show();
  if (getValue) {
    console.log(getValue);
    $("#chooselegaloc").addClass("select-drp-active");
    $('html, body').animate({
      scrollTop: $("#before_purchase").offset().top
    }, 1000);
  }
});
$("#legalstatus .dropdown-menu .dropdown-item").click(function () {
  var getValue = $(this).find("h6").text();
  $(".dropdown-select-2").text(getValue);
  $(".dropdown-item").removeClass("active");
  $(this).addClass("active");
  $(".check-marked-normal").hide();
  $(this).find(".check-marked-normal").show();
  if (getValue) {
    console.log(getValue);
    $("#legalstatus").addClass("select-drp-active");
  }
});
$("#filtersort .dropdown-menu .dropdown-item").click(function () {
  let getValue = $(this).find("h6").text();
  $("#filtersort .dropdown-select-2").text(getValue);
  $("#filtersort .dropdown-item").removeClass("active");
  $(this).addClass("active");
  $(".check-marked-normal").hide();
  $(this).find(".check-marked-normal").show();
});
$("#filtermobileselect .dropdown-menu .dropdown-item").click(function () {
  let getValue = $(this).find("h6").text();
  $("#filtermobileselect .dropdown-select-2").text(getValue);
  $("#filtermobileselect .dropdown-item").removeClass("active");
  $(this).addClass("active");
  $(".check-marked-normal").hide();
  $(this).find(".check-marked-normal").show();
});
$(".profile-tab-link-wrap ul li").click(function () {
  $(".nav-item").removeClass("active2");
  if ($(this).hasClass("active2")) {
    $(this).removeClass("active2");
  } else {
    $(this).addClass("active2");
  }
});
// price selection
// $('[name]=priceplan').click(function() {
//   $('.save-title-inner').toggle($('#anual').prop('checked'));
// });
$("input[name='priceplan']").click(function () {
  var radioValue = $("[name='priceplan']:checked").val();
  if (radioValue == "Annual") {
    $(".save-title-inner").fadeIn(400);
  } else {
    $(".save-title-inner").fadeOut(400);
  }
});
$(".month-bt").click(function () {
  var radioValue = $("[name='priceplan']:checked").val();
  if (radioValue == "Annual") {
    $("#customRadio4").prop("checked", true);
  } else {
    $("#customRadio3").prop("checked", true);
  }
});
$(".month-bt1").click(function () {
  var radioValue = $("[name='priceplan']:checked").val();
  if (radioValue === 'Annual') {
    $("#customRadio6").prop("checked", true);
  }
  else {
    $("#customRadio5").prop("checked", true);
  }
})

// search icon toggle 

$("#search-input").keyup(function () {
  if ($("#search-input").val()) {
    $("#search-btn").html(
      '<i class="icon-icons-close-close-1 clearvalue" id="clearval"></i>'
    );
  } else {
    $("#search-btn").html('<i class="icon-icons-search"></i>');

  }
});

$("#search-btn").click(function () {
  $("#search-input").val("");
  $("#search-btn").html('<i class="icon-icons-search"></i>');
});

// data-table

// purchase_history
$(document).ready(function () {
  var table = $("#purchase_history").DataTable({
    paging: false,
    searching: false,
    bInfo: false,
    targets: "no-sort",
    bSort: false,
    order: [],
    language: {
      emptyTable: "Aún no hay transacciones… ",
    },
  });
  // scroll_tab_active
  $(function () {
    var hash = window.location.hash;
    hash && $('.profile-tab-link-wrap ul.nav a[href="' + hash + '"]').tab('show');

    $('.myprfl li a').click(function (e) {
      $(this).tab('show');
      var scrollmem = $('body').scrollTop();
      window.location.hash = this.hash;
      $('html,body').scrollTop(scrollmem);

    });
  });
});

//Footer link
$(function () {
  var scrollmem = $('body').scrollTop();
  $('html,body').scrollTop(scrollmem);
  $('.account a').click(function () {
    window.location = $(this).attr('href');
    var hash = window.location.hash;
    var scrollmem = $('body').scrollTop();
    window.location.hash = this.hash;
    $('html,body').scrollTop(scrollmem);
    $('#profile-tab a[href="' + hash + '"]').click();

  });
});

// useragent detect
if (navigator.userAgent.indexOf('Mac OS X') != -1) {
  $("body").addClass("mac");
}

// legalization states

$(document).ready(function () {
  var table = $("#profile_legalize_table").DataTable({
    paging: false,
    searching: false,
    bInfo: false,
    language: {
      emptyTable: "Aún no hay transacciones… ",
    },
  });

  $('#profile_legalize_table tbody').on('click', 'tr', function () {
    var tr = $(this);
    var row = table.row(tr);
    var document_id = $(this).attr('data-id');
    var document_template_id = $(this).attr('data-document');
    if (row.child.isShown()) {
      row.child.hide();
      tr.removeClass('shown');
    } else {
      row.child(format(row.data(), document_id, document_template_id)).show();
      tr.addClass('shown');
    }
  });
  function format(rowData, document_id, document_template_id) {
    var load = '<p class="mb-0">Cargando...</p>';
    var div = $(load);
    $.ajax({
      url: '../../legalisation/loading',
      data: {
        name: rowData.name,
        document_id: document_id,
        document_template_id: document_template_id
      },
      dataType: 'json',
      success: function (json) {
        div.html(json.html)
          .removeClass('loading');
      }
    });

    // function format(rowData) {
    //   var load = '<p class="mb-0">Loading...</p>';
    //   var div = $(load);

    //   setTimeout(function () {
    //     var contentdiv =
    //       '<div  class="hiddenRow"> \n\
    //     <div > \n\
    //     <div id="list-legal-doc-7" >\n\
    //     <div class="card">\n\
    //                                                 <div class="card-body">\n\
    //                                                     <div class="exapand-head">\n\
    //                                                         Datos para Firma\n\
    //                                                     </div>\n\
    //                                                     <div class="row">\n\
    //                                                         <div class="col-md-4">\n\
    //                                                             <table class="legal-info-wrap">\n\
    //                                                                 <tbody>\n\
    //                                                                     <tr class=" row">\n\
    //                                                                         <td class="col-lg-5 col-sm-12">\n\
    //                                                                             <div class="user-head-wi-ico">\n\
    //                                                                                 <i class="icon-icons-person-person"></i> Abogado:\n\
    //                                                                             </div>\n\
    //                                                                         </td>\n\
    //                                                                         <td class="col-lg-7 col-sm-12">\n\
    //                                                                             <ul class="user-legal-info">\n\
    //                                                                                 <li class="BodyBody-2">\n\
    //                                                                                 Jose Luis Gutierrez Fernández\n\
    //                                                                                 </li>\n\
    //                                                                                 <li class="BodyBody-2">2022-5689</li>\n\
    //                                                                                 <li class="BodyBody-2">superabogado@lawyer.com</li>\n\
    //                                                                             </ul>\n\
    //                                                                         </td>\n\
    //                                                                     </tr>\n\
    //                                                                         </tbody>\n\
    //                                                             </table>\n\
    //                                                         </div>\n\
    //                                                         <div class="col-md-4">\n\
    //                                                         <table class="legal-info-wrap">\n\
    //                                                                 <tbody>\n\
    //                                                                     <tr class=" row">\n\
    //                                                                         <td class="    col-lg-4 col-sm-12">\n\
    //                                                                             <div class="user-head-wi-ico">\n\
    //                                                                                 <i class="icon-icons-pin"></i> Firmar en:\n\
    //                                                                             </div>\n\
    //                                                                         </td>\n\
    //                                                                         <td class="   col-lg-8 col-sm-12">\n\
    //                                                                             <ul class="user-legal-info">\n\
    //                                                                               <li class="BodyBody-2">  18 ave. 15-74 Colonia Miraflores\n\
    //                                                                                   </li>\n\
    //                                                                                 <li class="BodyBody-2">Zona 11</li>\n\
    //                                                                                 <li class="BodyBody-2">Ciudad de Guatemala</li>\n\
    //                                                                                 <li class="BodyBody-2">Guatemala</li>\n\
    //                                                                             </ul>\n\
    //                                                                         </td>\n\
    //                                                                     </tr>\n\
    //                                                               </tbody>\n\
    //                                                             </table>\n\
    //                                                         </div>\n\
    //                                                         <div class="col-md-4">\n\
    //                                                             <div class="expand-note">\n\
    //                                                             <p class="mb-0 BodySmall-2">Los datos proporcionados son exclusivamente para ponerse en contacto con el abogado correspondiente para coordinar la legalización de su documento. </p>\n\
    //                                                             </div>\n\
    //                                                         </div>\n\
    //                                                     </div>\n\
    //                                                 </div>\n\
    //                                             </div>\n\
    //     </div\n\
    //     </div>\n\
    //     </div>';
    //     div.html(contentdiv);
    //   }, 1500);
    return div;
  }
});

// Will wait for everything on the page to load.
// $(window).bind('load', function() {
// 	setTimeout(function() {
// 		$('#loader').css({'display':'none'})
// 	}, 2000)
// });
$(window).on("load", function () {
  $("#loader").delay(2000).fadeOut();
  $("html, body").css({
    overflow: "auto",
  });
});
$(function () {
  $("body").tooltip({ selector: '[data-toggle=tooltip]' });
})
// (function(loader) {

//   window.addEventListener('beforeunload', function(e) {
//     activateLoader();
//   });

//   window.addEventListener('load', function(e) {
//     deactivateLoader();
//   });

//   function activateLoader() {
//     loader.style.display = 'flex';
//     loader.style.opacity = 1;
//   }

//   function deactivateLoader() {
//     /**
//      * ensures that the loading animation plays for at least a second to give the
//      * appearance of seamless loading on pages that execute and load extremely
//      * quickly (i.e., intranet pages)
//      */
//     setTimeout(function() {
//       deactivate();
//     }, 1000);

//     function deactivate() {
//       loader.style.opacity = 0;
//        loader.addEventListener('transitionend', function() {
//         loader.style.display = 'none';
//       }, false);
//     }
//   }

// })(document.querySelector('#loader'));

// multiple header
// var loc = window.location.href;
// var loc_spl = loc.split('/');
// if(loc_spl[loc_spl.length-1] == '' || loc_spl[loc_spl.length-1] == 'index.html' || loc_spl[loc_spl.length-1] == 'about-us.html'){
//    $('.rz-header').addClass('home-header');
// }
// else if(loc_spl[loc_spl.length-1] == 'newpage-1.html' || loc_spl[loc_spl.length-1] == 'newpage-2.html' || loc_spl[loc_spl.length-1] == 'newpage-3.html'){
//   $('.rz-header').addClass('admin-header');
//   $('.rz-header').addClass('inner-header');
// }
// else{
//   $('.rz-header').addClass('inner-header');
// }
// Slick slider
//   $('#exp-itemslide').slick({
//   draggable: false,
//   arrows: false,
//   dots: false,
//   infinite: false,
//   slidesToShow: 6,
//   slidesToScroll: 1,
//   responsive: [
//     {
//         breakpoint: 1450,
//         settings: {
//           slidesToShow: 5,
//           slidesToScroll: 1,

//         }
//       },
//       {
//         breakpoint: 1199,
//         settings: {
//           slidesToShow: 3,
//           slidesToScroll: 1,
//           arrows:true
//         }
//       },
//       {
//         breakpoint: 991,
//         settings: {
//           centerMode: true,
//         infinite: true,
//         centerPadding: '60px',
//         slidesToShow: 2,
//         speed: 500,
//         variableWidth: false,
//         arrows:true
//         }
//       },{
//         breakpoint: 767,
//         settings: {
//           centerMode: true,
//         infinite: true,
//         centerPadding: '60px',
//         slidesToShow: 1,
//         speed: 500,
//         variableWidth: false,
//         }
//       }]

// });
