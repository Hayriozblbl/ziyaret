@extends('back.layouts.master')
@section('title','Silinen Ziyaret Kayıtları')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">@yield('title')
            <span class="float-right">{{$articles->count()}} makale bulundu.</strong>
        <a href="{{route('admin.ziyaretler.index')}}" class="btn btn-primary btn-sm">Aktif Ziyaretçi Kaydı</a>
             </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Ad Soyad</th>
                        <th>Ziyaret Talep Tarihi</th>
                        <th>Ziyaret Gerçekleşme Durumu</th>
                        <th>Ziyaret Gerçekleşme Tarihi</th>
                          <th>İadeyi Ziyaret Tarihi</th>

                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                    <tr>
                        <td>{{$article->ad_soyad}}</td>

                        <td>{{ \Carbon\Carbon::parse($article->ziyaret_talep_tarihi)->format('d-m-Y H:i') }}</td>

                        <td>{{ \Carbon\Carbon::parse($article->ziyaret_gerceklesme_tarihi)->format('d-m-Y H:i') }}</td>


                            <td>{{ \Carbon\Carbon::parse($article->iadeyi_ziyaret_tarihi)->format('d-m-Y H:i') }}</td>


                                <td>{{ \Carbon\Carbon::parse($article->iadeyi_ziyaret_tarihi)->format('d-m-Y H:i') }}</td>
                        <td>
                            <a href="{{route('admin.recover.article',$article->id)}}" title="Silmekten Kurtar" class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i> </a>
                            <a href="{{route('admin.hard.delete.article',$article->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
