@extends('layout.layadm')

  @section('menu')
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item">
                <a href="{{ url('/admin')}}">
                    <i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>
            <li class=" navigation-header"><span>Data</span></li>
            <li class=" nav-item ">
                <a href="{{ url('/datapengguna')}}">
                    <i class="feather icon-users"></i>
                    <span class="menu-title" data-i18n="Email">Data Pengguna</span>
                </a>
            </li>
            <li class=" nav-item ">
                <a href="{{ url('/datakategori')}}">
                    <i class="feather icon-tag"></i><span class="menu-title" data-i18n="Email">Data Kategori</span>
                </a>
            </li>
            <li class=" nav-item">
                <a href="#"><i class="feather icon-mail"></i>
                    <span class="menu-title" data-i18n="Dashboard">Data Dumas</span>
                </a>
              <ul class="menu-content">
                  <li>
                    <a href="{{ url('/datadumas')}}">
                        <i class="feather icon-circle"></i>
                        <span class="menu-item" data-i18n="Analytics">telah masuk</span><span class="badge badge  badge-pill float-right" style="background-color: #323859">@foreach($jmasuk as $jm){{$jm->jum}}@endforeach</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/datatlkdumas')}}">
                        <i class="feather icon-circle"></i>
                        <span class="menu-item" data-i18n="eCommerce">telah ditolak</span>
                        <span class="badge badge  badge-pill float-right" style="background-color: #323859">@foreach($jtlk as $jm){{$jm->jum}}@endforeach</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/dataverdumas')}}">
                        <i class="feather icon-circle"></i>
                        <span class="menu-item" data-i18n="eCommerce">telah diverifikasi</span><span class="badge badge  badge-pill float-right" style="background-color: #323859">@foreach($jver as $jm){{$jm->jum}}@endforeach</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/dataprodumas')}}">
                        <i class="feather icon-circle"></i>
                        <span class="menu-item" data-i18n="eCommerce">sedang diproses</span><span class="badge badge  badge-pill float-right" style="background-color: #323859">@foreach($jpro as $jm){{$jm->jum}}@endforeach</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('/datatladumas')}}">
                        <i class="feather icon-circle"></i>
                        <span class="menu-item" data-i18n="eCommerce">telah ditindak</span><span class="badge badge  badge-pill float-right" style="background-color: #323859">@foreach($jtla as $jm){{$jm->jum}}@endforeach</span>
                    </a>
                  </li>
              </ul>
            </li> 
            <li class=" nav-item">
                <a href="{{ url('/datastat')}}">
                    <i class="feather icon-bar-chart-2"></i>
                    <span class="menu-title" data-i18n="Email">Data Statistik</span>
                </a>
            </li>
            <li class=" nav-item">
                <a href="{{ url('/datakritik')}}">
                    <i class="feather icon-message-square"></i>
                    <span class="menu-title" data-i18n="Email">Data Kritik & Saran</span>
                </a>
            </li>
        </ul>
    </div>
  @endsection

    <?php 

        $lev = array('Admin','Pimpinan','Pengunjung');

    ?>

    @section('content')
    <div class="app-content content">
       <!--  <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div> -->
        <div class="content-wrapper">
          <div class="content-header row">
              <div class="content-header-left col-md-12 col-12 mb-2">
                  <div class="row breadcrumbs-top">
                      <div class="col-12">
                          <h2 class="content-header-title float-left mb-0">Data Pengaduan Masuk</h2>
                          <div class="breadcrumb-wrapper col-12">
                              <ol class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="index.html">Data</a>
                                  </li>
                                  <li class="breadcrumb-item active">Data Data Pengaduan Masuk
                                  </li>
                              </ol>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="content-body">
              <section id="add-row">
                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-content">
                                  <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table add-rows">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>Isi</th>
                                                    <th>Tgl</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            @foreach($data as $dat)
                                            <tbody>
                                                <tr>
                                                    <td>{{$dat->SARAN_ID}}</td>
                                                    <td>{{$dat->NAMA}}</td>
                                                    <td>{{$dat->ISI}}</td>
                                                    <td style="width:110px;"><?= date('d M Y',strtotime($dat->TGL)); ?></td>
                                                    <td  style="width:20px;">
                                                        <button type="button" class="btn btn-icon btn-icon btn-info" data-toggle="modal" data-target="#statdumas{{$dat->SARAN_ID}}"><i class="feather icon-message-square"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            @endforeach
                                        </table>
                                    </div>

                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
            </div>
          </div>
        </div>

    

@endsection

            