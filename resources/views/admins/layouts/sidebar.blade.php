<aside class="main-sidebar elevation-4" style="background-color: white; overflow-x: hidden;">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
      <div class="d-flex align-items-center justify-content-between" style="margin-right: 30px;">
        <img src="{{asset('assets/image/Absensi.png')}}"class="img-icon" alt="">
        <a class="bars" data-widget="pushmenu" href="#" role="button" style="width: fit-content;">
          <img src="{{asset('assets/image/bars.png')}}" alt="">
        </a>
      </div>
    </a>
      <!-- Sidebar Menu -->
      <nav class="mt-2 start-nav">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item {{Request()->is('dashboard') ? 'active' : ''}}">
            <a href="/dashboard" class="nav-link {{Request()->is('dashboard') ? 'active' : ''}}">
              <i class="nav-icon fas fa-home" style="transform: translateX(-5px);"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item {{Request()->is('siswa') ? 'active' : ''}}">
            <a href="/siswa" class="nav-link {{Request()->is('siswa') ? 'active' : ''}}">
              <i class="fas fa-user-friends"></i>
              <p>
                Siswa
              </p>
            </a>
          </li>
          <li class="nav-item {{Request()->is('sekolah') ? 'active' : ''}}">
            <a href="/sekolah" class="nav-link {{Request()->is('sekolah') ? 'active' : ''}}">
              <i class="fas fa-school"></i>
              <p>
                Sekolah
              </p>
            </a>
          </li>
          <li class="nav-item {{Request()->is('per-siswa') || Request()->is('per-sekolah') ? 'active menu-open' : ''}}">
            <a href="#" class="nav-link {{Request()->is('per-siswa') || Request()->is('per-sekolah') ? 'active' : ''}}">
              <i class="fas fa-file"></i>
              <p>
                Report kehadiran
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item sub-item {{Request()->is('per-siswa') ? 'active' : ''}}">
                <a href="/per-siswa" class="nav-link {{Request()->is('per-siswa') ? 'active' : ''}}">
                  <p>Per Siswa</p>
                </a>
              </li>
              <li class="nav-item sub-item {{Request()->is('per-sekolah') ? 'active' : ''}}">
                <a href="/per-sekolah" class="nav-link {{Request()->is('per-sekolah') ? 'active' : ''}}">
                  <p>Per Sekolah</p>
                </a>
              </li>
            </ul>
          </li> 
          <li class="nav-item {{Request()->is('setting-jam') ? 'active' : ''}}">
            <a href="/setting-jam" class="nav-link {{Request()->is('setting-jam') ? 'active' : ''}}">
              <i class="fas fa-clock"></i>
              <p>
                Setting Jam
              </p>
            </a>
          </li>
          <li class="nav-item {{Request()->is('qrcode') ? 'active' : ''}}">
            <a href="/qrcode" class="nav-link {{Request()->is('qrcode') ? 'active' : ''}}">
              <i class="fas fa-qrcode"></i>
              <p>
                QR Scan
              </p>
            </a>
          </li>
          <li class="nav-item {{Request()->is('pengguna') ? 'active' : ''}}">
            <a href="/pengguna" class="nav-link {{Request()->is('pengguna') ? 'active' : ''}}">
              <i class="fas fa-users"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>