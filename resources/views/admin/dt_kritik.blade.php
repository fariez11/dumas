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
                                                    <th>Email</th>
                                                    <th>Tgl</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <?php $no = 1?> 
                                            <tbody>
                                            @foreach($data as $dat)
                                                <tr>
                                                    <td>{{$no++}}</td>
                                                    <td>{{$dat->NAMA}}</td>
                                                    <td>{{$dat->EMAIL}}</td>
                                                    <td style="width:110px;"><?= date('d M Y',strtotime($dat->TGL)); ?></td>
                                                    <td  style="width:80px;">
                                                        <button type="button" class="btn btn-icon btn-icon btn-info" data-toggle="modal" data-target="#detKritik{{$dat->SARAN_ID}}"><i class="feather icon-message-square"></i></button>
                                                        <a href="{{ url('/kritik:del=')}}{{$dat->SARAN_ID}}" class="btn btn-icon btn-icon btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="feather icon-trash"></i></a>
                                                    </td>
                                                </tr> 
                                            @endforeach
                                            </tbody>
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

    @foreach($data as $ed)
  <div class="modal fade text-left" id="detKritik{{$ed->SARAN_ID}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header bg-primary white">
                  <h5 class="modal-title" id="myModalLabel160">Detail Kritik dan Saran</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <?php
                  $upd = DB::SELECT("select*from saran where SARAN_ID = '$ed->SARAN_ID'");
              ?>
              @foreach($upd as $upd)
              <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Nama Pengisi</label>
                                    <input type="text" id="first-name-vertical" class="form-control" name="judul" value="{{$upd->NAMA}}" autocomplete="off" readonly=""  style="background-color: white;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Email </label>
                                    <input type="text" id="first-name-vertical" class="form-control" name="judul" value="{{$upd->EMAIL}}" autocomplete="off" readonly=""  style="background-color: white;">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email-id-vertical">Kritik dan Saran</label>
                                    <textarea type="email" id="email-id-vertical" class="form-control" name="isi" autocomplete="off" required="" style="height: 300px;resize: none;background-color: white;text-align: justify;white-space: pre-line;" readonly=""> {{$upd->ISI}} </textarea>
                                </div>
                              </div>
                          </div>
                          
                        </div>
                    </div>
                  </div>
              @endforeach
          </div>
      </div>
  </div>
  @endforeach

    

@endsection

            