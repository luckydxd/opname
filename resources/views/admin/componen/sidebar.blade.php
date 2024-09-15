 <!--  BEGIN SIDEBAR  -->
 <div class="sidebar-wrapper sidebar-theme">


     <nav id="sidebar">

         <ul class="navbar-nav theme-brand flex-row  text-center">

             <li class="nav-item theme-text">
                 <a href="index.html" class="nav-link"> OPNAME </a>
             </li>
             <li class="nav-item toggle-sidebar">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-arrow-left sidebarCollapse">
                     <line x1="19" y1="12" x2="5" y2="12"></line>
                     <polyline points="12 19 5 12 12 5"></polyline>
                 </svg>
             </li>
         </ul>

         <div class="shadow-bottom"></div>
         <ul class="list-unstyled menu-categories" id="accordionExample">
             <li class="menu {{ $title == 'Dashboard' ? 'active' : '' }}">
                 <a href="{{ route('dashboard_admin') }}" aria-expanded="true" class="dropdown-toggle nav-link"
                     style="text-decoration: none">
                     <div class="fs-6 ">
                         <i class="bi bi-speedometer mx-2"></i>
                         <span> Dashboard</span>
                     </div>
                 </a>
             </li>
             <li class="menu {{ $title == 'Data Gudang' ? 'active' : '' }}">
                 <a href="{{ route('data_gudang') }}" aria-expanded="true" class="dropdown-toggle nav-link">
                     <div class="fs-6 ">
                         <i class="bi bi-card-heading mx-2"></i>
                         <span> Data Gudang</span>
                     </div>
                 </a>
             </li>
             <li class="menu {{ $title == 'Stok Barang' ? 'active' : '' }}">
                 <a href="{{ route('stok_barang') }}" aria-expanded="true" class="dropdown-toggle nav-link">
                     <div class="fs-6 ">
                         <i class="bi bi-card-heading mx-2"></i>
                         <span> Stok Barang</span>
                     </div>
                 </a>
             </li>
             <li class="menu ">
                 <a href="{{ route('data_produk') }}" aria-expanded="true" class="dropdown-toggle nav-link">
                     <div class="fs-6">
                         <i class="bi bi-box-fill mx-2"></i>
                         <span> Data Produk</span>
                     </div>
                 </a>
             </li>
         </ul>
     </nav>

 </div>
 <!--  END SIDEBAR  -->
