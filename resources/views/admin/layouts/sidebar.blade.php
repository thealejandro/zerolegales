<div class="side-content-wrap">
  <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
    <ul class="navigation-left">
        <!-- <li class="nav-item active" data-item="dashboard">
            <a class="nav-item-hold" href="#">
                <i class="nav-icon i-Bar-Chart"></i>
                <span class="nav-text">Dashboard</span>
            </a>
            <div class="triangle"></div>
        </li>-->
        <li class="nav-item" data-item="uikits">
            <a class="nav-item-hold" href="#">
                <i class="nav-icon i-Library"></i>
                <span class="nav-text">{{ __('test.users') }}</span>
            </a>
            <div class="triangle"></div>
        </li> 
        <li class="nav-item" data-item="extrakits">
            <a class="nav-item-hold" href="#">
                <i class="nav-icon i-Suitcase"></i>
                <span class="nav-text">{{ __('test.basic') }}</span>
            </a>
            <div class="triangle"></div>
        </li>
         <li class="nav-item" data-item="apps">
            <a class="nav-item-hold" href="#">
                <i class="nav-icon i-Computer-Secure"></i>
                <span class="nav-text">Reporte</span>
            </a>
            <div class="triangle"></div>
        </li>
        <!--<li class="nav-item" data-item="forms">
            <a class="nav-item-hold" href="#">
                <i class="nav-icon i-File-Clipboard-File--Text"></i>
                <span class="nav-text">Forms</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item">
            <a class="nav-item-hold" href="datatables.html">
                <i class="nav-icon i-File-Horizontal-Text"></i>
                <span class="nav-text">Datatables</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item" data-item="sessions">
            <a class="nav-item-hold" href="#">
                <i class="nav-icon i-Administrator"></i>
                <span class="nav-text">Sessions</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item" data-item="others">
            <a class="nav-item-hold" href="#">
                <i class="nav-icon i-Double-Tap"></i>
                <span class="nav-text">Others</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item">
            <a class="nav-item-hold" href="http://demos.ui-lib.com/gull-html-doc/" target="_blank">
                <i class="nav-icon i-Safe-Box1"></i>
                <span class="nav-text">Doc</span>
            </a>
            <div class="triangle"></div>
        </li> -->
    </ul>
  </div>

  <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
      <!-- Submenu Dashboards -->
      <!-- <ul class="childNav" data-parent="dashboard">
          <li class="nav-item">
              <a href="dashboard.v1.html" class="open">
                  <i class="nav-icon i-Clock-3"></i>
                  <span class="item-name">Version 1</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="dashboard.v2.html">
                  <i class="nav-icon i-Clock-4"></i>
                  <span class="item-name">Version 2</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="dashboard.v3.html">
                  <i class="nav-icon i-Over-Time"></i>
                  <span class="item-name">Version 3</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="dashboard.v4.html">
                  <i class="nav-icon i-Clock"></i>
                  <span class="item-name">Version 4</span>
              </a>
          </li>
      </ul>
      <ul class="childNav" data-parent="forms">
          <li class="nav-item">
              <a href="form.basic.html">
                  <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                  <span class="item-name">Basic Elements</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="form.layouts.html">
                  <i class="nav-icon i-Split-Vertical"></i>
                  <span class="item-name">Form Layouts</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="form.input.group.html">
                  <i class="nav-icon i-Receipt-4"></i>
                  <span class="item-name">Input Groups</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="form.validation.html">
                  <i class="nav-icon i-Close-Window"></i>
                  <span class="item-name">Form Validation</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="smart.wizard.html">
                  <i class="nav-icon i-Width-Window"></i>
                  <span class="item-name">Smart Wizard</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="tag.input.html">
                  <i class="nav-icon i-Tag-2"></i>
                  <span class="item-name">Tag Input</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="editor.html">
                  <i class="nav-icon i-Pen-2"></i>
                  <span class="item-name">Rich Editor</span>
              </a>
          </li>
      </ul>
       <ul class="childNav" data-parent="apps">
          <li class="nav-item">
              <a href="invoice.html">
                  <i class="nav-icon i-Add-File"></i>
                  <span class="item-name">Invoice</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="inbox.html">
                  <i class="nav-icon i-Email"></i>
                  <span class="item-name">Inbox</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="chat.html">
                  <i class="nav-icon i-Speach-Bubble-3"></i>
                  <span class="item-name">Chat</span>
              </a>
          </li>
      </ul> -->
      <ul class="childNav" data-parent="extrakits">
          <li class="nav-item">
              <a href="{{ route('admin.lawyers.directory.index') }}">
                  <i class="nav-icon i-File-Horizontal"></i>
                  <span class="item-name">{{ __('test.lawyers-directory') }}</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('admin.category.index') }}">
                  <i class="nav-icon i-File-Horizontal-Text"></i>
                  <span class="item-name">{{ __('test.category') }}</span>
              </a>
          </li>

          <!-- <li class="nav-item">
              <a href="{{ route('admin.input.variable.index') }}">
                  <i class="nav-icon i-File-Horizontal-Text"></i>
                  <span class="item-name">{{ __('test.input-variable') }}</span>
              </a>
          </li> -->

          <li class="nav-item">
              <a href="{{ route('admin.terms-conditions.index') }}">
                  <i class="nav-icon i-File-Horizontal-Text"></i>
                  <span class="item-name">{{ __('test.terms-conditions') }}</span>
              </a>
          </li>

          <li class="nav-item">
              <a href="{{ route('admin.template.index') }}">
                  <i class="nav-icon i-File-Horizontal-Text"></i>
                  <span class="item-name">{{ __('test.legal-document-template') }}</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('admin.price.matrix.index') }}">
                  <i class="nav-icon i-File-Horizontal-Text"></i>
                  <span class="item-name">{{ __('test.price-matrix') }}</span>
              </a>
          </li>

         <li class="nav-item">
            <a href="{{route('admin.invoice-data.index')}}">
              <i class="nav-icon i-File-Horizontal-Text"></i>
                  <span class="item-name">{{ __('test.Invoice Data') }}</span>
              </a>
          </li>
           <!-- <li class="nav-item">
              <a href="toastr.html">
                  <i class="nav-icon i-Bell"></i>
                  <span class="item-name">Toastr</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="sweet.alerts.html">
                  <i class="nav-icon i-Approved-Window"></i>
                  <span class="item-name">Sweet Alerts</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="tour.html">
                  <i class="nav-icon i-Plane"></i>
                  <span class="item-name">User Tour</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="upload.html">
                  <i class="nav-icon i-Data-Upload"></i>
                  <span class="item-name">Upload</span>
              </a>
          </li> -->
      </ul>
      <ul class="childNav" data-parent="uikits">
          <li class="nav-item">
              <a href="{{route('admin.users.index')}}">
                  <i class="nav-icon  i-File-Horizontal-Text"></i>
                  <span class="item-name">{{ __('test.users') }}</span>
              </a>
          </li>
       <!--   <li class="nav-item">
              <a href="accordion.html">
                  <i class="nav-icon i-Split-Horizontal-2-Window"></i>
                  <span class="item-name">Accordion</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="badges.html">
                  <i class="nav-icon i-Medal-2"></i>
                  <span class="item-name">Badges</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="buttons.html">
                  <i class="nav-icon i-Cursor-Click"></i>
                  <span class="item-name">Buttons</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="cards.html">
                  <i class="nav-icon i-Line-Chart-2"></i>
                  <span class="item-name">Cards</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="card.metrics.html">
                  <i class="nav-icon i-ID-Card"></i>
                  <span class="item-name">Card Metrics</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="carousel.html">
                  <i class="nav-icon i-Video-Photographer"></i>
                  <span class="item-name">Carousels</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="lists.html">
                  <i class="nav-icon i-Belt-3"></i>
                  <span class="item-name">Lists</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="pagination.html">
                  <i class="nav-icon i-Arrow-Next"></i>
                  <span class="item-name">Paginations</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="popover.html">
                  <i class="nav-icon i-Speach-Bubble-2"></i>
                  <span class="item-name">Popover</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="progressbar.html">
                  <i class="nav-icon i-Loading"></i>
                  <span class="item-name">Progressbar</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="tables.html">
                  <i class="nav-icon i-File-Horizontal-Text"></i>
                  <span class="item-name">Tables</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="tabs.html">
                  <i class="nav-icon i-New-Tab"></i>
                  <span class="item-name">Tabs</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="tooltip.html">
                  <i class="nav-icon i-Speach-Bubble-8"></i>
                  <span class="item-name">Tooltip</span>
              </a>
          </li>

          <li class="nav-item">
              <a href="modals.html">
                  <i class="nav-icon i-Duplicate-Window"></i>
                  <span class="item-name">Modals</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="nouislider.html">
                  <i class="nav-icon i-Width-Window"></i>
                  <span class="item-name">Sliders</span>
              </a>
          </li>-->
      </ul>
      <ul class="childNav" data-parent="apps">
          <!-- <li class="nav-item">
              <a href="{{route('admin.users.report')}}">
                  <i class="nav-icon i-File-Horizontal-Text"></i>
                  <span class="item-name">Informe de usuario</span>
              </a>
          </li> -->
          <li class="nav-item">
              <a href="{{route('admin.report1')}}">
                  <i class="nav-icon i-File-Horizontal-Text"></i>
                  <span class="item-name">Informe de usuario</span>
              </a>
          </li>
          <!-- <li class="nav-item">
              <a href="{{route('admin.subscription.report')}}">
                  <i class="nav-icon i-File-Horizontal-Text"></i>
                  <span class="item-name">Informe de facturación</span>
              </a>
          </li> -->
          <li class="nav-item">
              <a href="{{route('admin.report2')}}">
                  <i class="nav-icon i-File-Horizontal-Text"></i>
                  <span class="item-name">Informe de facturación</span>
              </a>
          </li>
            <li class="nav-item">
              <a href="{{route('admin.report3')}}">
                  <i class="nav-icon i-File-Horizontal-Text"></i>
                  <span class="item-name">{{ __('test.All legal documents') }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.report4')}}">
                  <i class="nav-icon i-File-Horizontal-Text"></i>
                  <span class="item-name">Informar documentos auténticos</span>
              </a>
            </li>
         <!-- <li class="nav-item">
              <a href="signup.html">
                  <i class="nav-icon i-Add-User"></i>
                  <span class="item-name">Sign up</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="forgot.html">
                  <i class="nav-icon i-Find-User"></i>
                  <span class="item-name">Forgot</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="profile_new.html">
                  <i class="nav-icon i-Find-User"></i>
                  <span class="profile_new.html">WAC User Profile</span>
              </a>
          </li>-->
      </ul>
      <!--<ul class="childNav" data-parent="others">
          <li class="nav-item">
              <a href="not.found.html">
                  <i class="nav-icon i-Error-404-Window"></i>
                  <span class="item-name">Not Found</span>
              </a>
          </li>
           <li class="nav-item">
              <a href="user.profile.html">
                  <i class="nav-icon i-Male"></i>
                  <span class="item-name">User Profile</span>
              </a>
          </li>
          <li class="nav-item">
              <a href="blank.html">
                  <i class="nav-icon i-File-Horizontal"></i>
                  <span class="item-name">Blank Page</span>
              </a>
          </li>
      </ul> -->
  </div>
  <div class="sidebar-overlay"></div>
</div>