@extends('back.layouts.master')
@section('title','Ziyaret Kaydı Oluştur')
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
        <form method="post" action="{{route('admin.ziyaretler.store')}}" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
                <label>Ad Soyad</label>
                <input type="text" name="ad_soyad" class="form-control" required></input>
            </div>
            <div class="form-group">
                <label>Kurum</label>
                <input type="text" name="kurum" class="form-control" required></input>
            </div>
            <div class="form-group">
                <label>Telefon Numarası</label>
                <input type="text" name="telefon" class="form-control" required></input>
            </div>
            <div class="form-group">
                <label>E-Posta Adresi</label>
                <input type="text" name="mail" class="form-control" required></input>
            </div>

            <div class="form-group">
                <label>Ziyaret Talep Tarihi</label>
                     <div class="input-group date" >
                         <input type="datetime-local" name="ziyaret_talep_tarihi" class="form-control" >

                    </div>
             </div>

             <div class="form-group">
                <label>Ziyaret Amacı</label>
                <textarea id="editor" name="ziyaret_amaci" class="form-control" rows="4" ></textarea>
            </div>

            <div class="form-group">
                <label>Ziyaret Gerçekleşme Durumu</label>
                <select class="form-control" name="ziyaret_durumu" required>
                    <option value="" selected>Seçim Yapınız</option>
                    <option value="0" selected>Gerçekleşmedi</option>
                    <option value="1">Gerçekleşti</option>
                    <option value="2">Beklemede</option>
                </select>
            </div>
            <div class="form-group">
                <label>Ziyaret Gerçekleşme Tarihi</label>
                     <div class="input-group date" >
                         <input type="datetime-local" name="ziyaret_gerceklesme_tarihi"  id="ziyaret_gerceklesme_tarihi" class="form-control" >

                    </div>
             </div>


             <div class="form-group">
                <label>İadeyi Ziyaret Tarihi</label>
                     <div class="input-group date">
                        <input type="datetime-local" name="iadeyi_ziyaret_tarihi" class="form-control" >

                        <span class="input-group-append">

                        </span>
                    </div>
             </div>
             <div class="form-group">
                <label>İadeyi Ziyaret Gerçekleşme Durumu</label>
                <select class="form-control" name="iadeyi_ziyaret_durumu" required>
                    <option value="" selected>Seçim Yapınız</option>
                    <option value="0" selected>Gerçekleşmedi</option>
                    <option value="1">Gerçekleşti</option>
                    <option value="2">Beklemede</option>

                </select>
            </div>




            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Ziyaret Defterine Kaydet</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('css')
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


@endsection
@section('js')

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
   <script>
    $(document).ready(function() {
        $('#editor').summernote({
            'height': 300
        });

        $('#myForm').submit(function(event) {
            var content = $('#editor').summernote('code'); // Summernote içeriğini al

            if (!content.trim()) { // İçerik boşsa
                alert('Ziyaret amacını doldurunuz.');
                event.preventDefault(); // Formu göndermeyi engelle
            }
        });
    });
</script>
<script>
config={
    enableTime:true,
    dateFormat: "d-m-Y H:i",
    altInput:true

}

flatpickr("#infut[type=datetime-local]",config);

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editorTextarea = document.getElementById('editor');
        editorTextarea.style.display = 'block';  // veya 'inline' veya 'inline-block' olarak ayarlayabilirsiniz.
    });
</script>
@endsection
