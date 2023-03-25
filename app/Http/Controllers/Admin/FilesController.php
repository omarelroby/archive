<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoardDirectors;
use App\Models\DocFiles;
use App\Models\DocumentType;
use App\Models\Fboards;
use App\Models\Files;
use App\Models\Follows;
use App\Models\Importance;
use App\Models\Parties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\StreamReader;
use ArPHP\I18N\Arabic;


class FilesController extends Controller
{
    public function index()
    {
        $allTags = Files::withCount('confirmation')->withCount('fboards')->get();
        //   dd($allTags);
        $files = $allTags->filter(function ($value, $key) {
            return $value->fboards_count != $value->confirmation_count;
        });
        return view('dashboard.files.index',compact('files'));
    }
    public function create()
    {
        $docs=DocumentType::all();
        $parties=Parties::all();
        $boards=BoardDirectors::all();
        $follows=Follows::all();
        $response=\App\Models\Response::all();
        $importances=Importance::all();
        return view('dashboard.files.create',compact('docs','parties','boards','follows','response','importances'));
    }
    public function store(Request $request)
    {
        $rules=['name'=>'required','file_number'=>'required','document_type_id'=>'required',
            'import_date'=>'required','parts_id'=>'required','doc_files.*'=>'required|mimetypes:application/pdf|max:10000'];
        $messages=['name.required'=>'الاسم مطلوب','file_number.required'=>'ادخل رقم المستند',
            'document_type_id.required'=>'ادخل نوع المستند','doc_files.*.mimetypes'=>'الملف يجب أن يكون من صيغة بي دي إف PDF','import_date.required'=>'ادخل التاريخ','parts_id.required'=>'ادخل الجهة'];
        $validation=validator()->make($request->all(),$rules,$messages);
        if($validation->fails())
        {
//            dd('ss');
            return $validation->errors()->first();
        }

       $files= Files::create($request->all());
//        dd('ss');
        foreach($request->parts_id as $part_id)
        {

            Fboards::create(['board_direct_id'=>$part_id,'file_id'=>$files->id]);

        }
        foreach ($request->doc_files as $doc_file)
        {
            $path='docs';
            $imageName = md5(rand(1000,9999).time()). '.'.$doc_file->getClientOriginalExtension();
            $imageMove = $doc_file->move(public_path('files/'.$path),$imageName);
            DocFiles::create(['file_name'=>$imageName,'file_id'=>$files->id]);
        }

        return redirect('admin/files')->with('success',trans('response.added'));

    }
    public function edit($id){
        $file=Files::find($id);
        $docs=DocumentType::all();
        $parties=Parties::all();
        $fboards=Fboards::where('file_id',$id)->pluck('board_direct_id')->toArray();
        $Boards=BoardDirectors::all();
        return view('dashboard.files.edit',compact('file','docs','parties','fboards','Boards'));
    }

        public function show($id)
        {
            $files=DocFiles::where('file_id',$id)->get();
            return view('dashboard.files.show',compact('files'));
        }
    public function update($id,Request $request)
    {
        $file=Files::find($id);
        $file->update($request->all());
        $file->boards()->sync($request->parts_id);
        return redirect('admin/files')->with('success',trans('response.updated'));
    }
    public function destroy($id)
    {
        $file=Files::find($id);
        $file->delete();
        return redirect('admin/files')->with('error',trans('response.deleted'));
    }
    public function status($id)
    {

        ini_set("allow_url_fopen", true);
        $file=DocFiles::find($id);

        $fpdi = new FPDI;
        $fileContent = file_get_contents($file->file_name,'rb');

        $count =  $fpdi->setSourceFile(StreamReader::createByString($fileContent));
        ;

        for ($i=1; $i<=$count; $i++) {

            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);

            $fpdi->SetFont("helvetica", "", 15);

            $fpdi->SetTextColor(153,0,153);

            $left = 10;
            $top = 10;
            foreach ($file->docs->boards as $key=>$board) {

                $Arabic = new Arabic();
                $font = './DroidNaskh-Bold.ttf';
                $text = $Arabic->utf8Glyphs($board->jobs->name??"");

                // Create the image
                $im = imagecreatetruecolor(50, 15);

                // Create some colors
                $white = imagecolorallocate($im, 255, 255, 255);
                $black = imagecolorallocate($im, 0, 0, 0);
                imagefilledrectangle($im, 0, 0, 599, 299, $white);

                // Add the text
                imagettftext($im, 7, 0, 7, 10, $black, $font, $text);

                // Using imagepng() results in clearer text compared with imagejpeg()
                imagepng($im, "./".$board->name.'.png');
                imagedestroy($im);
                //$fpdi->Text($size['width'] - (($key*100)+50), $size['height'] - 20, $board->jobs->name??"");
                $fpdi->Image("./".$board->name.'.png', $size['width'] - (($key*100)+50), $size['height'] - 20, '20','7');

                if ($board->pivot->status==1&&$board->signature)
                    $fpdi->Image($board->signature??"", $size['width'] - (($key*100)+50), $size['height'] - 15, '25','25');

            }
        }

        $name=time().".pdf";
        $fpdi->Output(public_path($name), 'F');
        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download(public_path($name), $name, $headers);
    }

    public function archive()
    {




        $allTags = Files::whereHas('confirmation')->withCount('confirmation')->withCount('fboards')->get();
     //   dd($allTags);
        $files = $allTags->filter(function ($value, $key) {
            return $value->fboards_count == $value->confirmation_count;
        });
        return view('dashboard.files.index',compact('files'));


    }


}
