<?php

namespace App\Http\Controllers\cms;

use App\Models\news;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class newsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = news::orderBy('position','asc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $action = '<a href="'.route('newsManagement.news.edit', $data->id).'?type=edit" class="btn-sm btn btn-warning"><i class="material-icons">mode_edit</i>Edit</a><br>';
                $action .= '<button type="button" name="deletePermanent" id="'.$data->id.'" class="deletePermanent btn-sm btn btn-danger mt-1"><i class="material-icons">delete_outline</i>Remove</button>';
                return $action;
            })
            ->addColumn('status', function($data) {
                if ($data->status == '1') {
                    $badge = '<span class="text-success">Active</span>';
                } else {
                    $badge = '<span class="text-danger">Not Active</span>';
                }
                return $badge;
            })
            ->addColumn('file', function($data) {
                $url = asset('assets/images/news/'.$data->file);
                if ($data->file == null) {
                    $image = '<img src="../../assets/cms/images/noImage.jpg" alt="" style="width:100px !important">';
                } else {
                    $image = '<img src="'.$url.'" alt="" style="width:100px !important">';
                }
                return $image;
            })
            ->addColumn('description', function($data) {
                return '<div>'.substr($data->description,0,15).'...</div>';
            })
            ->addColumn('tag', function($data) {
                if ($data->tag != null) {
                    $explode = explode(',',$data->tag);
                    $accomodate = '';
                    foreach ($explode as $key => $value) {
                        $accomodate .= '<div class="badge badge-info m-1 p-2">#'.$value.'</div>';
                    }
                } else {
                    $accomodate = '';
                }

                return $accomodate;
            })
            ->rawColumns(['action','status','file','tag','description'])
            ->make(true);
        }
        return view('cms.pages.news.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.pages.news.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->except(['_method','_token']);
            // validasi 
            $validate = Validator::make($request->all(), [
                'file' => 'mimes:png,jpg,jpeg|max:40000|required',
                'description' => 'required',
                'name' => 'required'
            ]);
            if($validate->fails()) {
                return redirect()->back()->with('failed', $validate->errors())->withInput($request->all());
            } 
            // create if first position 
            if(news::count() < 1){
                $data['position'] = 1;
            } else {
                // check position in database 
                $findPosition = news::orderBy('position','desc')->pluck('position')->first();
                $data['position'] = ++$findPosition;
            }
            $location = public_path('assets/images/news');
            // if location not found create folder 
            if(!file_exists($location)) mkdir($location);
            if ($file = $request->file('file')) {
                $optimizeImage = Image::make($file);
                $image = time() . str_replace(' ','-',$file->getClientOriginalName());
                $optimizeImage->save($location.'/' . $image, 72);
                $data['file'] = $image;
            }

            // save file in local and save to database in summernote when upload image 
            $content = $request->description;
            //Prepare HTML & ignore HTML errors
            $dom = new \DomDocument();
            @$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //identify img element
            $imageFile = $dom->getElementsByTagName('img');
            foreach($imageFile as $item => $image){
                //collect img source data
                $dataImage = $image->getAttribute('src');
                //checking if img source data is image by detecting 'data:image' in string
                if (strpos($dataImage, 'data:image') !== false) {
                    list($type, $dataImage) = explode(';', $dataImage);
                    list(, $dataImage)      = explode(',', $dataImage);
                    $imgeData = base64_decode($dataImage);
                    $locationService = public_path('assets/images/news/summernote/');
                    if (!file_exists($locationService)) {
                        mkdir($locationService);
                    }
                    $image_name= time().$item.'.png';
                    $path = $locationService . $image_name;
                    $locationSaveInLocal = asset('assets/images/news/summernote').'/'.$image_name;
                    file_put_contents($path, $imgeData);
                    
                    $image->removeAttribute('src');
                    $image->setAttribute('src', $locationSaveInLocal);
                } 
            }
            $data['description'] = $dom->saveHTML();
            $data['status'] = 1;
            $data['slug'] = Str::slug($request->name) ?? '';
            $data['created_by'] = Auth::user()->id ?? '-';
            $data['updated_by'] = Auth::user()->id ?? '-';
            // validate when position double 
            news::create($data);
            return redirect()->route('newsManagement.news.index')->with('success','Data Saved Successfully');
        } catch (\Exception $th) {
            return redirect()->back()->with('failed', $th->getMessage())->withInput($request->except('_method','_token'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = news::whereId($id)->first();
        return view('cms.pages.news.form',['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->except(['_method','_token','files']);
            // validasi 
            $validate = Validator::make($request->all(), [
                'file' => 'mimes:png,jpg,jpeg',
                'description' => 'required',
                'name' => 'required'
            ]);
            if($validate->fails()) {
                return redirect()->back()->with('failed', $validate->errors())->withInput($request->all());
            }
            // data 
            $news = news::findOrFail($id);
            
            if ($file = $request->file('file')) {
                $lokasi = public_path('assets/images/news/');
                if ($news->file != null) {
                    if (file_exists($lokasi.$news->file)) {
                        // delete image 
                        unlink($lokasi.$news->file);
                        // save image when fileure found
                        $image = Image::make($file);
                        $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                        $image->save($lokasi.$nameImage);
                        $data['file'] = $nameImage;
                    } else {
                        // save image when fileure not found 
                       $lokasi = public_path('assets/images/news/');
                       $image = Image::make($file);
                       $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                       $image->save($lokasi.$nameImage);
                       $data['file'] = $nameImage;
                    }
                } else {
                    // save image when fileure null in database 
                    $lokasi = public_path('assets/images/news/');
                    $image = Image::make($file);
                    $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                    $image->save($lokasi.$nameImage);
                    $data['file'] = $nameImage;
                }
            }
            // save file in local and save to database in summernote when upload image 
            $content = $request->description;
            //Prepare HTML & ignore HTML errors
            $dom = new \DomDocument();
            @$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //identify img element
            $imageFile = $dom->getElementsByTagName('img');
            foreach($imageFile as $item => $image){
                //collect img source data
                $dataImage = $image->getAttribute('src');
                //checking if img source data is image by detecting 'data:image' in string
                if (strpos($dataImage, 'data:image') !== false) {
                    list($type, $dataImage) = explode(';', $dataImage);
                    list(, $dataImage)      = explode(',', $dataImage);
                    $imgeData = base64_decode($dataImage);
                    $locationService = public_path('assets/images/news/summernote/');
                    if (!file_exists($locationService)) {
                        mkdir($locationService);
                    }
                    $image_name= time().$item.'.png';
                    $path = $locationService . $image_name;
                    $locationSaveInLocal = asset('assets/images/news/summernote').'/'.$image_name;
                    file_put_contents($path, $imgeData);
                    
                    $image->removeAttribute('src');
                    $image->setAttribute('src', $locationSaveInLocal);
                } 
            }
            $data['description'] = $dom->saveHTML();
            $data['slug'] = Str::slug($data['name']);
            $data['updated_by'] = Auth::user()->id;
            news::whereId($id)->update($data);
            return redirect()->back()->with('success','data updated successfully')->withInput($request->except(['_method','_token']));
        } catch (\Exception $th) {
            return redirect()->back()->with('failed',$th->getMessage())->withInput($request->except(['_method','_token']));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = news::whereId($id);
        // delete summernote image 
        $content = $news->pluck('description')->first();
        $dom = new \DomDocument();
        @$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');
        foreach($imageFile as $item => $image){
            //collect img source data
            $dataImage = $image->getAttribute('src');
            $getName = explode('/',$dataImage);
            // delete image 
            $lokasis = public_path('assets/images/news/summernote/');
            if ($getName[7] != null) {
                if (file_exists($lokasis.$getName[7])) {
                    unlink($lokasis.$getName[7]);
                }
            }
        }
        // delete image 
        $lokasi = public_path('assets/images/news/');
        if ($news->pluck('file')->first() != null) {
            if (file_exists($lokasi.$news->pluck('file')->first())) {
                unlink($lokasi.$news->pluck('file')->first());
            }
        }
        // delete 
        $news->delete();
        return redirect()->back()->with('success','data berhasil dihapus');
    }
}
