   <?php
    $uri = $_SERVER['REQUEST_URI'];
    ?>

   <nav class="sidebar sidebar-offcanvas" id="sidebar">
       <ul class="nav">
           <li class="nav-item <?= (strpos($uri, '/home') !== false || $uri == '/') ? 'active' : '' ?>">
               <a class="nav-link" href="/">
                   <i class="ti-dashboard menu-icon"></i>
                   <span class="menu-title">Dashboard</span>
               </a>
           </li>
           <li class="nav-item  <?= (strpos($uri, '/user') !== false) ? 'active' : '' ?>">
               <a class="nav-link" href="/user">
                   <i class="ti-user menu-icon"></i>
                   <span class="menu-title">User</span>
               </a>
           </li>
           <li class="nav-item  ">
               <a class="nav-link" data-toggle="collapse" href="#ui-basic22" aria-expanded="false" aria-controls="ui-basic">
                   <i class="ti-folder menu-icon"></i>
                   <span class="menu-title">Master Produk</span>
                   <i class="menu-arrow"></i>
               </a>
               <div class="collapse" id="ui-basic22">
                   <ul class="nav flex-column sub-menu">
                       <li class="nav-item <?= (strpos($uri, '/kategori') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/kategori">Kategori Produk</a></li>
                       <li class="nav-item <?= (strpos($uri, '/jenis') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/jenis">Jenis Produk</a></li>
                   </ul>
               </div>

           </li>
           <li class="nav-item  <?= (strpos($uri, '/produk') !== false) ? 'active' : '' ?>">
               <a class="nav-link" href="/produk">
                   <i class="ti-package menu-icon"></i>
                   <span class="menu-title">Data Produk</span>
               </a>

           </li>

           <li class="nav-item  <?= (strpos($uri, '/masuk') !== false) ? 'active' : '' ?>">
               <a class="nav-link" href="/masuk">
                   <i class="ti-arrow-top-right menu-icon"></i>
                   <span class="menu-title">Barang Masuk</span>
               </a>

           </li>

           <li class="nav-item  <?= (strpos($uri, '/keluar') !== false) ? 'active' : '' ?>">
               <a class="nav-link" href="/keluar">
                   <i class="ti-arrow-top-left menu-icon"></i>
                   <span class="menu-title">Barang Keluar</span>
               </a>

           </li>

       </ul>
   </nav>