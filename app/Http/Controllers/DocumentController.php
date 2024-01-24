<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Documenthistory;

class DocumentController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        //
    }

   
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        
        $rec1 = Document::where('id', $id)->first();
        $rec = Documenthistory::where('document_id', $id)->get();
        return view('pages.document.index',[
          'title' => $rec1->title,
          'details' => $rec,
          
        ]);
    }

   
    public function edit($id)
    {
        //
    }

  
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
