@extends('layout.laypgg')

    @section('menu')
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
              <li class=" nav-item"><a href="{{ url('/pengunjung')}}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
              </li>
              <li class=" navigation-header"><span>Data</span>
              </li>
              <li class="nav-item"><a href="#"><i class="feather icon-mail"></i><span class="menu-title" data-i18n="Dashboard">Data Dumas</span></a>
                <ul class="menu-content">
                    <li>
                        <a href="{{ url('/pdatadumas')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Data yang tersedia</span></a>
                    </li>
                    <li>
                        <a href="{{ url('/pdataresdumas')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Data perlu direspon</span></a>
                    </li>
                </ul>
              </li>
              <li class=" nav-item">
                    <a href="{{ url('/pdatastat')}}"><i class="feather icon-bar-chart-2"></i><span class="menu-title" data-i18n="Email">Data Statistik</span></a>
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
              <div class="content-header-left col-md-9 col-12 mb-2">
                  <div class="row breadcrumbs-top">
                      <div class="col-12">
                          <h2 class="content-header-title float-left mb-0">Data Pengaduan Yang Tersedia </h2>
                          <div class="breadcrumb-wrapper col-12">
                              <ol class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="index.html">Data</a>
                                  </li>
                                  <li class="breadcrumb-item active">Data Pengaduan Yang Tersedia
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
                                      <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#primary"><i class="feather icon-plus-circle"></i> Tambah Data</button> 
                                    <div class="table-responsive">
                                        <table class="table add-rows">
                                            <thead>
                                                <tr>
                                                    <th>Judul</th>
                                                    <th>Tanggal</th>
                                                    <th>Penulis</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            @foreach($data as $dat)
                                            <tbody>
                                                <tr>
                                                    <td>{{$dat->JUDUL}}</td>
                                                    <td><?= date('d M Y H:i',strtotime($dat->TGL)); ?></td>
                                                    <td>{{$dat->NAMA}}</td>
                                                    <?php $cek = DB::SELECT("SELECT*FROM tindak_lanjut WHERE DUMAS_ID = '$dat->DUMAS_ID'");?>
                                                    @if($cek == null)
                                                        <td>{{$dat->STATUS}}</td>
                                                    @else
                                                      @foreach($cek as $ce)

                                                        @if($ce->STATUS == 'proses')
                                                            <td>Dalam proses</td>
                                                        @else
                                                            <?php $res = DB::SELECT("SELECT*FROM respon WHERE DUMAS_ID = '$dat->DUMAS_ID'");?>
                                                            @if($res == null)
                                                              <td>Menunggu Respon <span style="color:red;">*</span></td>
                                                            @else
                                                              <td>Selesai</td>
                                                            @endif
                                                        @endif
                                                      @endforeach
                                                    @endif
                                                    <td style="width: 120px;">
                                                      <a href="{{ url('/pdumas:det=')}}{{$dat->DUMAS_ID}}" class="btn btn-icon btn-icon btn-info"><i class="feather icon-info"></i></a>
                                                        <!-- <button type="button" class="btn btn-icon btn-icon btn-info" data-toggle="modal" data-target="#infodumas{{$dat->DUMAS_ID}}"><i class="feather icon-info"></i></button> -->
                                                        <button type="button" class="btn btn-icon btn-icon btn-warning" data-toggle="modal" data-target="#editdumas{{$dat->DUMAS_ID}}"><i class="feather icon-edit"></i></button>
                                                        <a href="{{ url('/pdumas:del=')}}{{$dat->DUMAS_ID}}" class="btn btn-icon btn-icon btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="feather icon-trash"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            @endforeach
                                        </table>
                                    </div>

                                  </div>
                              </div>
                              <div class="card-footer">
                                  
                              <span style="color:red;">*</span>) Mohon segera merespon hasil pengaduan pada menu data perlu direspon
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
            </div>
          </div>
        </div>

    <div class="modal fade text-left" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header bg-primary white">
                  <h5 class="modal-title" id="myModalLabel160">Masukkan Pengaduan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form action="{{url('/add_pdumas')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
              <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                          @foreach($idd as $id)
                            <input type="hidden" name="idd" value="{{$id->DUMAS_ID+1}}" readonly="">
                          @endforeach
                          @foreach($idv as $id)
                            <input type="hidden" name="idv" value="{{$id->DUMAS_ID+1}}" readonly="">
                          @endforeach
                          <div class="col-md-8">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first-name-vertical">Judul</label>
                                    <input type="text" id="first-name-vertical" class="form-control" name="judul" placeholder="judul" autocomplete="off" required="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password-vertical">Kategori</label>
                                    <select class="form-control" name="kat" required="">
                                        <option></option>
                                        @foreach($kat as $ka)
                                        <option style="padding:5px;">{{$ka->KATEGORI}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email-id-vertical">Isi Pengaduan</label>
                                    <textarea type="email" id="email-id-vertical" class="form-control" name="isi" placeholder="berikan alamat lengkap dan contoh: jalan rusak parah di depan Terminal Gubug Kec. Gubug Kabupaten Grobogan, mohon segera diperbaiki" autocomplete="off" required="" style="height: 270px;resize: none;"></textarea>
                                </div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact-info-vertical">Lokasi</label>
                                <input type="text" id="contact-info-vertical" class="form-control" name="lokasi" placeholder="lokasi" autocomplete="off" required="">
                            </div>
                            <div class="form-group">
                                <label for="password-vertical">Lampiran</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="lamp" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">.JPG, .JPEG, .PNG</label>
                                </div>
                                <label for="password-vertical" style="color: red;">ukuran maksimal 2MB</label>
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="contact-info-vertical" class="form-control" name="akun" value="{{Session::get('akun')}}" autocomplete="off" required="" readonly="">
                            </div>
                          </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary"><i class="feather icon-check-circle"></i> Simpan</button>
              </div>
              </form>
          </div>
      </div>
  </div>

  @foreach($data as $ed)
  <div class="modal fade text-left" id="editdumas{{$ed->DUMAS_ID}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header bg-primary white">
                  <h5 class="modal-title" id="myModalLabel160">Edit Pengguna</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <?php
                  $upd = DB::SELECT("select*from dumas where DUMAS_ID = '$ed->DUMAS_ID'");
              ?>
              @foreach($upd as $upd)
              <form action="{{ url('/dumas:upd=')}}{{$upd->DUMAS_ID}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
              <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                          <div class="col-md-8">
                              <div class="col-12">
                                  <div class="form-group">
                                      <label for="first-name-vertical">Judul</label>
                                      <input type="text" id="first-name-vertical" class="form-control" name="judul" value="{{$upd->JUDUL}}" autocomplete="off" required="">
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label for="password-vertical">Kategori</label>
                                      <select class="form-control" name="kat">
                                        @foreach($kat as $ka)
                                        <?php if ($ka->KATEGORI == $upd->KATEGORI){ ?>
                                             <option selected="" style="padding:5px;" >{{$ka->KATEGORI}}</option>
                                          <?php }else{ ?>
                                            <option  style="padding:5px;">{{$ka->KATEGORI}}</option>
                                          <?php }?>
                                        @endforeach
                                      </select>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label for="email-id-vertical">Isi Pengaduan</label>
                                      <textarea type="email" id="email-id-vertical" class="form-control" name="isi" autocomplete="off" required="" style="height: 270px;resize: none;white-space: pre-line;"> {{$upd->ISI}} </textarea>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact-info-vertical">Lokasi</label>
                                <input type="text" id="contact-info-vertical" class="form-control" name="lokasi" value="{{$upd->LOKASI}}" autocomplete="off" required="">
                            </div>
                            <div class="form-group">
                                <label for="password-vertical">Lampiran</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="lamp" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">.JPG, .JPEG, .PNG</label>
                                    <label for="password-vertical" style="color: red;">ukuran maksimal 2MB</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="contact-info-vertical" class="form-control" name="akun" value="{{Session::get('akun')}}" autocomplete="off" required="" readonly="">
                            </div>
                          </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary"><i class="feather icon-edit"></i> Ubah</button>
              </div>
              </form>
              @endforeach
          </div>
      </div>
  </div>
  @endforeach


@endsection

            
