<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManager extends Controller
{
    public function getFile(Request $request){
        // dd(Storage::disk('storePartition')->files('.'));
        // dd(Storage::disk('storePartition')->listContents());

        // $directories = Storage::disk('storePartition')->directories();
        // $directories = array_diff($directories, ['.', '..']);

        // dd($directories);

        $lists = Storage::disk('storePartition')->listContents();
        foreach($lists as $key => $list){
            if(in_array($list['path'], ['$RECYCLE.BIN', 'System Volume Information'])){
                unset($lists[$key]);
            }
        }

        $lists = array_values($lists);

        return response()->json(['data' => $lists]);
    }

    public function getFolder($folder){
        $lists = Storage::disk('storePartition')->listContents($folder);
        foreach($lists as $key => $list){
            if(in_array($list['path'], ['$RECYCLE.BIN', 'System Volume Information'])){
                unset($lists[$key]);
            }
        }

        return response()->json(['data' => $lists]);
    }
}
