<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\Document;
use App\Models\DocumentRow;

class DocumentController extends Controller
{

public function index()
{
    $categories = Category::pluck('name');

    return view('documents.sheet',compact('categories'));
}

public function categories()
{
    return Category::pluck('name');
}

public function items($category)
{

$cat = Category::where('name',$category)->first();

if(!$cat) return [];

return Item::where('category_id',$cat->id)->pluck('name');

}

public function store(Request $request)
{

$rows = $request->rows;

$document = Document::create([
'title' => 'Generated Document',
'municipality' => $request->municipality
]);

foreach($rows as $row){

if(!$row[0]) continue;

$category = Category::firstOrCreate([
'name'=>$row[0]
]);

$item = Item::firstOrCreate([
'name'=>$row[1],
'category_id'=>$category->id
]);

DocumentRow::create([
'document_id'=>$document->id,
'category'=>$row[0],
'name'=>$row[1],
'qty'=>$row[2],
'price'=>$row[3],
'total'=>$row[4]
]);

}

return response()->json([
'success'=>true
]);

}
}


