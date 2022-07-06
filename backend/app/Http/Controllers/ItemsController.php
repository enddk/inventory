<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;


class ItemsController extends Controller
{
    public function index(Request $request)
    {
        if($request->user_id == 0){
            $items = Item::orderBy('created_at', 'asc')->get();
        } else {
            $items = Item::where('user_id', $request->user_id)->orderBy('created_at', 'asc')->get();
        }
        return json_encode($items);
    }

    public function add(Request $request)
    {
        $file = $request->file('image');
        if(!empty($file))
        {
            $fileName = $file->getClientOriginalName();
            //Storage::disk('public')->putFileAs('files', $file, $fileName);
            Storage::disk('s3')->putFileAs('/', $file, $fileName, 'public');
        } else {
            $fileName = '';
        }

        $items = new Item;
        $items->user_id = $request->user_id;
        $items->image = $fileName;
        $items->title = $request->title;
        $items->num = $request->num;
        $items->save();
    }

    public function update(Request $request)
    {
        $file = $request->file('image');
        if(!empty($file))
        {
            $fileName = $file->getClientOriginalName();
            //Storage::disk('public')->putFileAs('files', $file, $fileName);
            Storage::disk('s3')->putFileAs('/', $file, $fileName, 'public');
        } else {
            $fileName = '';
        }

        $items = Item::find($request->id);
        if($fileName != '')
        {
            $items->image = $fileName;
        }
        $items->title = $request->title;
        $items->num = $request->num;
        $items->save();
        return json_encode($items);
    }

    public function delete(Item $item)
    {
        $item->delete();
    }

    public function edit(Item $item)
    {
        return json_encode($item);
    }
}
