<footer class="footer">

<div class="footer-wrap">
<div class="footer-content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-4">
<div class="widget">
<div class="foot-company-logo">
    <div class="foot-logo-wrap">
        <img src="{{asset('front/assets/img/logo-vertical.svg')}}" class="lazyload" alt="Herramientas Legales" title="Herramientas Legales"/>
    </div>
    <div class="footer-copy-right d-none d-md-block">
        <p class="FooterCopyright-2">Copyright <a href="#">Herramientas Legales</a>,  {{ now()->year }}. Todos los derechos reservados.</p>
    </div>
</div>


</div>
</div>
<div class="col-lg-8">
    <div class="footer-links">
<div class="row">
<!-- <div class="col-lg-3">
<div class="widget">
<div class="FooterTitle-2">Home</div>
<ul class="list">
<li class="FooterSubtitle-2"><a href="#">Beneficios</a></li>
<li class="FooterSubtitle-2"><a href="#">Servicios</a></li>
<li class="FooterSubtitle-2"><a href="#">Precio</a></li>
<li class="FooterSubtitle-2"><a href="#">Contacto</a></li>
</ul>
</div>
</div>
<div class="col-lg-3">
<div class="widget">
<div class="FooterTitle-2 ">Lista de Documentos</div>
<ul class="list filters-button-group">
    @guest
        <li class="FooterSubtitle-2" ><a href="{{route('document.index'). '#filtrar=.contratos'}}">Contratos</a></li>
        <li class="FooterSubtitle-2" ><a href="{{route('document.index'). '#filtrar=.testamentos'}}">Testamentos</a></li>
        <li class="FooterSubtitle-2"><a href="{{route('document.index'). '#filtrar=.pagarés'}}">Pagarés</a></li>
        <li class="FooterSubtitle-2"><a href="{{route('document.index'). '#filtrar=.listados'}}">Listados</a></li>
    @endguest
    @if (Auth::check())
    <li class="FooterSubtitle-2" ><a href="{{route('user.document'). '#filtrar=.contratos'}}">Contratos</a></li>
    <li class="FooterSubtitle-2" ><a href="{{route('user.document'). '#filtrar=.testamentos'}}">Testamentos</a></li>
    <li class="FooterSubtitle-2"><a href="{{route('user.document'). '#filtrar=.pagarés'}}">Pagarés</a></li>
    <li class="FooterSubtitle-2"><a href="{{route('user.document'). '#filtrar=.listados'}}">Listados</a></li>
    @endif
</ul>

</div>
</div> -->
<div class="col-lg-3">
 <div class="widget myprfl">
<div class="FooterTitle-2">Perfil</div>
<ul class="list">
<li class="FooterSubtitle-2 account"><a href="{{route('user.profile'). '#profile-account-info'}}">Información de Cuenta</a></li>
<li class="FooterSubtitle-2 account"><a href="{{route('user.profile'). '#profile-personal'}}">Información Personal</a></li>
<li class="FooterSubtitle-2 account"><a href="{{route('user.profile'). '#profile-subscription'}}">Suscripción</a></li>
<!-- <li class="FooterSubtitle-2 account"><a href="{{route('user.profile'). '#profile-payment'}}">Información de Pago</a></li> -->
</ul>
</div>
</div>
<div class="col-lg-3">
<div class="widget bold_menu">

<ul class="list">
<li><a class="FooterTitle-2" href="{{route('user.purchase.history')}}">Historial de Compras</a></li>
<li><a class="FooterTitle-2" href="{{route('user.legalisation.state')}}">Estados de Auténticas</a></li>
<li><a class="FooterTitle-2" href="{{route('user.document.progress')}}">Documentos de Processo</a></li>
<li><a  class="FooterTitle-2" href="{{route('user.price')}}">Suscripciones</a></li>
<li><a class="FooterTitle-2" href="{{route('user.myfolder.index')}}">Mi carpeta</a></li>
<li><a class="FooterTitle-2" href=" https://www.herramientaslegales.com/politica-de-privacidad">Política de Privacidad</a></li>

</ul>
</div>
</div>
</div>
    </div>
</div>
<div class="footer-copy-right d-block d-md-none d-sm-block d-lg-none">
        <p class="FooterCopyright-2">Copyright <a href="#">Herramientas Legales</a>, {{ now()->year }}. Todos los derechos reservados.</p>
    </div>
</div>
</div>
</div>
</div>
</footer>
