@extends('back.layouts.master')
@section('title','Tüm Ziyaretler')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">@yield('title')
            <span class="float-right">Listede {{$articles->count()}} Kayıt bulundu.</strong>
                <a href="{{route('admin.ziyaretler.create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Yeni Kayıt Ekle</a>

        <a href="{{route('admin.trashed.article')}}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Silinen Kayıtlar</a>
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
                        <th>Ziyaret Gerçekleşme Durumu</th>
                        <th>İadeyi Ziyaret Durumu</th>
                        <th>İadeyi Ziyaret Tarihi</th>

                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)

                            <td>{{$article->ad_soyad}}</td>

                            <td>{{ \Carbon\Carbon::parse($article->ziyaret_talep_tarihi)->format(' d/m/Y H:i') }}</td>


                            <td>
                                <input class="switch" article-id="{{ $article->id }}" type="checkbox" hidden
                                       @if($article->ziyaret_durumu == 1) checked @endif>
                                <span style="color:
                                    @if($article->ziyaret_durumu == 1) green
                                    @elseif($article->ziyaret_durumu == 0) red
                                    @elseif($article->ziyaret_durumu == 2) orange
                                    @endif;">
                                    @if($article->ziyaret_durumu == 1)
                                        Gerçekleşti
                                    @elseif($article->ziyaret_durumu == 0)
                                        Gerçekleşmedi
                                    @elseif($article->ziyaret_durumu == 2)
                                        Beklemede
                                    @endif
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($article->ziyaret_gerceklesme_tarihi)->isoFormat('D MMMM YYYY HH:mm') }}</td>


                                <td>
                                    @if($article->iadeyi_ziyaret_tarihi)
                                  {{ \Carbon\Carbon::parse($article->iadeyi_ziyaret_tarihi)->isoFormat('D MMMM YYYY HH:mm') }}
                                    @else
                                        Belirtilmemiş
                                    @endif
                                </td>
                                <td>
                                    <input class="switch" article-id="{{ $article->id }}" type="checkbox" hidden
                                           @if($article->iadeyi_ziyaret_durumu == 1) checked @endif>
                                    <span style="color:
                                        @if($article->iadeyi_ziyaret_durumu == 1) green
                                        @elseif($article->iadeyi_ziyaret_durumu == 0) red
                                        @elseif($article->iadeyi_ziyaret_durumu == 2) orange
                                        @endif;">
                                        @if($article->iadeyi_ziyaret_durumu == 1)
                                            Gerçekleşti
                                        @elseif($article->iadeyi_ziyaret_durumu == 0)
                                            Gerçekleşmedi
                                        @elseif($article->iadeyi_ziyaret_durumu == 2)
                                            Beklemede
                                        @endif
                                    </span>
                                </td>

                                     <td>
                                        @if($article->iadeyi_ziyaret_tarihi)
                                          {{ \Carbon\Carbon::parse($article->iadeyi_ziyaret_tarihi)->isoFormat('D MMMM YYYY HH:mm') }}

                                        @else
                                            Belirtilmemiş
                                        @endif
                                    </td>

                        <td>
                            <a  href="{{route('admin.ziyaretler.show',$article->id)}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> </a>
                             <a href="{{route('admin.ziyaretler.edit',$article->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i> </a>
                            <a href="{{route('admin.delete.article',$article->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(function() {
        $('.switch').change(function() {
            id = $(this)[0].getAttribute('article-id');
            statu=$(this).prop('checked');
            $.get("{{route('admin.switch')}}", {id:id,statu:statu},  function(data, iadeyi_ziyaret_durumu,ziyaret_durumu) {});
        })
    })
</script>
@endsection
