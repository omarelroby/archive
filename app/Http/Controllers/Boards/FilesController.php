<?php

namespace App\Http\Controllers\Boards;

use App\Http\Controllers\Controller;
use App\Models\BoardDirectors;
use App\Models\DocFiles;
use App\Models\Fboards;
use App\Models\Files;
use ArPHP\I18N\Arabic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Auth;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\StreamReader;

class FilesController extends Controller
{
    public function index()
    {
        $files = Auth::guard('board')->user()->files()->get();
//        dd($files[0]->pivot->id);
        $docs=DocFiles::all();
        $fboards=Fboards::all();
        return view('boards.files.index', compact('files','docs','fboards'));
    }
    public function show($id)
    {
        $files=DocFiles::where('file_id',$id)->get();


        return view('boards.files.show',compact('files'));
    }
    public function enabled($id)
    {
        $files=Fboards::find($id);
        $files->update([
           'status'=>'1',
        ]);
//        ini_set("allow_url_fopen", true);
//
//        $fpdi = new FPDI;
//
//        $count = $fpdi->setSourceFile('E:\pro\public\files\docs\Untitled-1.pdf');
//
//        for ($i=1; $i<=$count; $i++) {
//
//            $template = $fpdi->importPage($i);
//            $size = $fpdi->getTemplateSize($template);
//            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
//            $fpdi->useTemplate($template);
//
//            $fpdi->SetFont("helvetica", "", 15);
//            $fpdi->SetTextColor(153,0,153);
//
//            $left = 10;
//            $top = 10;
//            $text = "itsolutionstuff.com";
//            $fpdi->Text($size['width']-50,$size['height']-20,$text);
//
//            $fpdi->Image("https://www.itsolutionstuff.com/assets/images/footer-logo.png", $size['width']-50, $size['height']-10,'50');
//        }
//
//        return $fpdi->Output(public_path("sample_output.pdf"), 'F');
        return redirect('boards/boards')->with('success',trans('response.updated'));
    }
    public function disabled($id){
        $files=Fboards::find($id);

        $files->update([
            'status'=>'2',
        ]);
//        dd($files);
        return redirect('boards/boards')->with('success',trans('response.updated'));
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



}
