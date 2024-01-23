@extends('back.layouts.master')
@section('title','Ziyaret Detayı')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">@yield('title')
               </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <p> <b> Adı Soyadı:</b> {{$article->ad_soyad}} </p>
            <p>   <p>  <b> Kurum Adı:</b> {{$article->kurum}} </p>

            <p>  <b> Telefon:</b> {{$article->telefon}} </p>

            <p>  <b> E-posta:</b> {{$article->mail}} </p>

            <p>  <b> Ziyaret Talep Tarihi:</b> {{ \Carbon\Carbon::parse($article->ziyaret_talep_tarihi)->isoFormat('D MMMM YYYY HH:mm') }}</p>

            <p>  <b> Ziyaretin Amacı:</b> <p>{!!$article->ziyaret_amaci!!}</p> </p>
            <p>  <b> Ziyaret Gerçekleşme Durumu:</b>  <span style="color:
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
       </span> </p>
             <p> <b> Ziyaret Gerçekleşme Tarihi:</b>{{ \Carbon\Carbon::parse($article->ziyaret_gerceklesme_tarihi)->isoFormat('D MMMM YYYY HH:mm') }} </p>
             <p> <b> İadeyi Ziyaret Tarihi:</b> {{ \Carbon\Carbon::parse($article->iadeyi_ziyaret_tarihi)->isoFormat('D MMMM YYYY HH:mm') }}</p>
            <p>  <b> İadeyi Ziyaret Gerçekleşme Durumu:</b> <span style="color:
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
       </span></p>



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
