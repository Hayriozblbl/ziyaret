@extends('back.layouts.master')
@section('title',$article->title.' Ziyaret Kaydı Güncelle')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">@yield('title')
    </div>
    <div class="card-body">
      @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
        </div>
      @endif
        <form method="post" action="{{route('admin.ziyaretler.update',$article->id)}}" enctype="multipart/form-data">
          @method('PUT')
          @csrf
            <div class="form-group">
                <label>Ad Soyad</label>
                <input type="text" name="ad_soyad" class="form-control" value="{{$article->ad_soyad}}" required></input>
            </div>
            <div class="form-group">
                <label>Kurum</label>
                <input type="text" name="kurum" class="form-control" value="{{$article->kurum}}" required></input>
            </div>
            <div class="form-group">
                <label>Telefon Numarası</label>
                <input type="text" name="telefon" class="form-control" value="{{$article->telefon}}" required></input>
            </div>
            <div class="form-group">
                <label>E-posta Adresi</label>
                <input type="text" name="mail" class="form-control" value="{{$article->mail}}" required></input>
            </div>
            <div class="form-group">
                <label>Ziyaret Talep Tarihi</label>
                <div class="input-group date">
                    <input type="datetime-local" name="ziyaret_talep_tarihi" class="form-control"
                           value="{{ $article->ziyaret_talep_tarihi ? date('Y-m-d\TH:i', strtotime($article->ziyaret_talep_tarihi)) : '' }}">
                </div>
            </div>

            <div class="form-group">
                <label>Ziyaret Amacı</label>
                <textarea id="editor" name="ziyaret_amaci" class="form-control" rows="4">{!! $article->ziyaret_amaci !!}</textarea>
            </div>
            <div class="form-group">
                <label>Ziyaret Gerçekleşme Durumu</label>
                <select class="form-control" name="ziyaret_durumu" required>
                    <option value="" disabled>Seçim Yapınız</option>
                    <option value="0" <?php echo ( $article->ziyaret_durumu == 0) ? 'selected' : ''; ?>>Gerçekleşmedi</option>
                    <option value="1" <?php echo ( $article->ziyaret_durumu == 1) ? 'selected' : ''; ?>>Gerçekleşti</option>
                    <option value="2" <?php echo ( $article->ziyaret_durumu == 2) ? 'selected' : ''; ?>>Beklemede</option>

                </select>
            </div>

            <div class="form-group">
                <label> Ziyaret Gerçekleşme Tarihi</label>
                <div class="input-group date">
                    <input type="datetime-local" name="ziyaret_gerceklesme_tarihi" class="form-control"
                           value="{{ $article->ziyaret_gerceklesme_tarihi ? date('Y-m-d\TH:i', strtotime($article->ziyaret_gerceklesme_tarihi)) : '' }}">
                </div>
            </div>
            <div class="form-group">
                <label>İadeyi Ziyaret Gerçekleşme Tarihi</label>
                <div class="input-group date">
                    <input type="datetime-local" name="iadeyi_ziyaret_tarihi" class="form-control"
                           value="{{ $article->iadeyi_ziyaret_tarihi ? date('Y-m-d\TH:i', strtotime($article->iadeyi_ziyaret_tarihi)) : '' }}">
                </div>
            </div>
            <div class="form-group">
                <label>İadeyi Ziyaret Durumu</label>
                <select class="form-control" name="iadeyi_ziyaret_durumu" required>
                    <option value="" disabled>Seçim Yapınız</option>
                    <option value="0" <?php echo ( $article->iadeyi_ziyaret_durumu == 0) ? 'selected' : ''; ?>>Gerçekleşmedi</option>
                    <option value="1" <?php echo ( $article->iadeyi_ziyaret_durumu == 1) ? 'selected' : ''; ?>>Gerçekleşti</option>
                    <option value="2" <?php echo ( $article->ziyaret_durumu == 2) ? 'selected' : ''; ?>>Beklemede</option>

                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Kaydı Güncelle</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('css')
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
@endsection
@section('js')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
<script>
$(document).ready(function() {
$('#editor').summernote(
  {
    'height':300
  }
);
});
</script>
@endsection
