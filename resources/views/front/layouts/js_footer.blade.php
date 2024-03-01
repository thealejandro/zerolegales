
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('front/assets/js/vendors/jquery-3.5.1.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{asset('front/assets/js/vendors/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/assets/js/vendors/jquery.validate.min.js')}}"></script>
    <script src="{{asset('front/assets/js/vendors/bootstrap3-typeahead.min.js')}}"></script>

    <!-- bootstrap select -->
    <script src="{{asset('front/assets/js/vendors/bootstrap-select.min.js')}}"></script>
    <!-- isotope -->
    <script src="{{asset('front/assets/js/vendors/isotope.pkgd.min.js')}}"></script>

    <!-- data-table -->
     <script src="{{asset('front/assets/js/vendors/datatables.min.js')}}"></script>
   <!-- Lazyload -->
    <script src="{{asset('front/assets/js/vendors/ls.parent-fit.min.js')}}" async=""></script>

    <script src="{{asset('front/assets/js/vendors/ls.bgset.min.js')}}" async=""></script>
    <script src="{{asset('front/assets/js/vendors/lazysizes.min.js')}}" async=""></script>
    <!-- input mask -->
    <script src="{{asset('front/assets/js/vendors/inputmask/jquery.inputmask.min.js')}}"></script>
    <!-- custom scrollbar -->
    <script src="{{asset('front/assets/js/vendors/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('front/assets/js/vendors/bootstrap-table.min.js')}}"></script>
    <script src="{{asset('front/assets/js/vendors/jquery.anythingzoomer.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('front/assets/js/vendors/jspdf.debug.js')}}"></script>

    <script src="{{asset('front/assets/js/vendors/html2pdf.bundle.min.js')}}"></script>
    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
<!-- <script src="assets/js/vendors/slick.min.js"></script> -->

<!-- tweenmax animation -->
<!-- <script type="text/javascript" src="assets/js/TweenMax.min.js"></script>
<script type="text/javascript" src="assets/js/ScrollMagic.js"></script>
<script type="text/javascript" src="assets/js/animation.gsap.min.js"></script>
<script type="text/javascript" src="assets/js/animation.js"></script> -->

<!-- datepicker -->
<script src="{{asset('front/assets/js/vendors/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('front/assets/js/vendors/moment_local_es.min.js')}}" type="text/javascript"></script>
<script src="{{asset('front/assets/js/vendors/tempusdominus-bootstrap-4.js')}}" type="text/javascript"></script>
<script src="{{ asset('front/assets/js/vendors/toastr.min.js') }}"></script>
<script type="text/javascript" src="{{asset('front/assets/js/main.js')}}"></script>
<script>
    function loadJS(u) {
    var r = document.getElementsByTagName("script")[0],
    s = document.createElement("script");
    s.src = u;
    r.parentNode.insertBefore(s, r);
    }
    if (!window.HTMLPictureElement || document.msElementsFromPoint) {
    loadJS("{{ asset('front/assets/js/vendors/ls.respimg.min.js')}}");
    }

    $(document).ready(function(){
    $(".zoom-view .btn").click(function(){
       
        $(this).toggleClass('zoom-active');
    })
})

</script>
<script src="{{ asset('front/assets/js/vendors/Drift.js')}}"></script>
<script>
//     $( document ).ready(function() {
//         const driftImgs = document.querySelectorAll('.drift-demo-trigger');
//     // new Drift(document.querySelectorAll('.drift-demo-trigger'), {
//     //     paneContainer: document.querySelector('.detail'),
//     //     inlinePane: true,
//     //     // inlineOffsetY: -85,
//     //     containInline: true,
//     //     // hoverBoundingBox: true
//     // });
//     driftImgs.map(img => {
// 	new Drift(img, {
// 		paneContainer: pane,
// 		inlinePane: true
// 	});
// });
// })
</script>
<!-- <script>
$(document).ready(function () {
if (window.location.href.indexOf('#_=_') > 0) {
window.location = window.location.href.replace(/#.*/, '');
}});
</script> -->