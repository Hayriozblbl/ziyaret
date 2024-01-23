<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles=Article::orderBy('created_at','desc')->get();
        return view('back.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('back.articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $article=new Article;
        $article->ad_soyad=$request->ad_soyad;
        $article->kurum=$request->kurum;
        $article->telefon=$request->telefon;
        $article->mail=$request->mail;
        $ziyaret_talep_tarihi = $request->ziyaret_talep_tarihi;
        $article->ziyaret_talep_tarihi = \Carbon\Carbon::parse($ziyaret_talep_tarihi);
        $article->ziyaret_amaci=$request->ziyaret_amaci;
        $article->ziyaret_durumu=$request->ziyaret_durumu;

        $article->ziyaret_gerceklesme_tarihi=$request->ziyaret_gerceklesme_tarihi;

        $article->iadeyi_ziyaret_durumu=$request->iadeyi_ziyaret_durumu;

        $article->iadeyi_ziyaret_tarihi=$request->iadeyi_ziyaret_tarihi;



        $saved = $article->save();

        // Hata kontrolü ve dd()
        if (!$saved) {
            dd('Veritabanına kayıt eklenirken bir hata oluştu.');
        }
         toastr()->success('Başarılı', 'Ziyaret Kaydı başarıyla oluşturuldu');
        return redirect()->route('admin.ziyaretler.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $article=Article::findOrFail($id);
         return view('back.articles.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $article=Article::findOrFail($id);
       return view('back.articles.update',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article= Article::findOrFail($id);
        $article->ad_soyad=$request->ad_soyad;
        $article->kurum=$request->kurum;
        $article->telefon=$request->telefon;
        $article->mail=$request->mail;
        $ziyaret_talep_tarihi = $request->ziyaret_talep_tarihi;
        $article->ziyaret_talep_tarihi = \Carbon\Carbon::parse($ziyaret_talep_tarihi);
        $article->ziyaret_amaci=$request->ziyaret_amaci;
        $article->ziyaret_durumu=$request->ziyaret_durumu;

        $article->ziyaret_gerceklesme_tarihi=$request->ziyaret_gerceklesme_tarihi;

        $article->iadeyi_ziyaret_durumu=$request->iadeyi_ziyaret_durumu;

        $article->iadeyi_ziyaret_tarihi=$request->iadeyi_ziyaret_tarihi;


      $article->save();
      toastr()->success('Başarılı', 'Ziyaret Kaydı başarıyla güncellendi.');
      return redirect()->route('admin.ziyaretler.index');
    }

    public function switch(Request $request){
      $article=Article::findOrFail($request->id);
      $article->iadeyi_ziyaret_durumu=$request->statu=="true" ? 1 : 0 ;
      $article->ziyaret_durumu=$request->statu=="true" ? 1 : 0 ;

      $article->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
      Article::find($id)->delete();
      toastr()->success('Kayıt, Silinen ziyaretlere taşındı.');
      return redirect()->route('admin.ziyaretler.index');
    }

    public function trashed(){
      $articles= Article::onlyTrashed()->orderBy('deleted_at','desc')->get();
      return view('back.articles.trashed',compact('articles'));
    }
    public function recover($id){
      Article::onlyTrashed()->find($id)->restore();
      toastr()->success('Ziyaret Kaydı başarıyla kurtarıldı.');
      return redirect()->back();
    }
    public function hardDelete($id){
      $article=Article::onlyTrashed()->find($id);
      if(File::exists($article->image)){
        File::delete(public_path($article->image));
      }
      $article->forceDelete();
      toastr()->success('Ziyaret Kaydı başarıyla silindi');
      return redirect()->route('admin.ziyaretler.index');
    }
}
