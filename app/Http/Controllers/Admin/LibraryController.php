<?php

namespace App\Http\Controllers\Admin;

use App\ItemsFiles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller {
    public function index()
    {
        $files = new ItemsFiles();
        $response = $files
            ->select('f.id', 'f.path', 'f.type_file', 'i.name as item_name', 'i.alias as item_url')
            ->from('sp_items_files as f')
            ->leftjoin('sp_items as i', 'f.item_id', '=', 'i.id')
            ->get();
        return view('admin.files.index')
            ->with('name', 'Библиотека')
            ->with('response', json_encode($response))
            ->with('type_files', $files->getTypeFile());
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        $item_id = $input['item_id'];
        $type = $input['type'];
        $total = $input['total'];
        $file = $input['file'];

        if (!$item_id || !$request->hasFile('file')) return response()->json(null, 400);

        $fileName = time() . '_' . $this->translit($file->getClientOriginalName());

        if (!Storage::disk('lib')->putFileAs('/', $file, $fileName))
            return response()->json(null, 404);

        ItemsFiles::create([
            'item_id' => intval($item_id),
            'path' => $fileName,
            'type_file' => intval($type),
        ]);

        if(intval($id)+1 < intval($total)) {
            $data = array('end'=>false, 'result'=>200, 'id'=>$id, 'item_id'=>$item_id, 'type'=>$type, 'total'=>$total, 'file'=>$fileName);
        } else {
            $data = array('end'=>true, 'result'=>200, 'id'=>$id, 'item_id'=>$item_id, 'type'=>$type, 'total'=>$total, 'file'=>$fileName);
        }

        return response()->json($data, 200);
    }

    public function destroy(Request $request)
    {
        $id = intval($request->input('id'));
        $file = ItemsFiles::find($id);
        Storage::disk('lib')->delete('/' . $file->path);
        $file->delete();

        print "200";
    }

    public function get_file($id) {
        if (Storage::disk('public')->exists('lib/'.$id)) {
            $content = Storage::disk('public')->get('lib/'.$id);
            $size = Storage::disk('public')->size('lib/'.$id);

            header('Content-Type: application/force-download');
            header('Content-Disposition: attachment; filename="'.$id.'"');
            header('Content-Length: ' . $size);
            print $content;
        } else return abort(404);
    }
}
