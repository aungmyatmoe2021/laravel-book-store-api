<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\StoreRequest;
use App\Http\Requests\Book\UpdateRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\CloudinaryFileUploadService;
use Exception;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            $query = Book::query()->with('category');
            $query->when($request->has('search'),function ($q) use($request) {
                $searchKey = $request['search'];
                $q->where(function($subquery) use($searchKey){
                    $subquery->where('title','like','%'.$searchKey.'%')
                        ->orWhere('description','like','%'.$searchKey.'%')
                        ->orWhereHas('category',function ($categoryQuery) use($searchKey) {
                            $categoryQuery->where('name','like','%'.$searchKey.'%')
                                        ->orWhere('description','like','%'.$searchKey.'%');
                        });
                });
            });

            $perPage = $request->get('per_page',10);
            $books = $query->paginate($perPage);
            if(count($books) == 0){
                return response()->json([
                    "message"=>"Books not found"
                ],404);
            }
            return response()->json([
                "message"=>"Books retrieved successfully",
                "data"=>BookResource::collection($books),
                "total"=>$books->total(),
                "per_page"=>$books->perPage(),
                "current_page"=>$books->currentPage(),
                "last_page"=>$books->lastPage()
            ],200);
        }catch(Exception $e){
            return response()->json([
                "message"=>"Internal Server Error"
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try{
            $data = $request->validated();
            if($request->hasFile('cover_image_url')){
                $file = $request->file('cover_image_url');
                $path = CloudinaryFileUploadService::upload($file);
                $data['cover_image_url'] = $path;
            }
            $book = Book::create($data);
            return response()->json([
                "message"=>"Book crated successfully",
                "data"=>BookResource::make($book)
            ],201);
        }catch(Exception $e){
            return response()->json([
                "message"=>"Internal Server Error"
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $book = Book::find($id);
            if(!$book){
                return response()->json([
                    "message"=>"Book not found"
                ],404);
            }
            return response()->json([
                "message"=>"Book retrieved successfully",
                "data"=>BookResource::make($book)
            ],200);
        }catch(Exception $e){
            return response()->json([
                "message"=>"Internal Server Error"
            ],500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        try{
            $book = Book::find($id);
            if(!$book){
                return response()->json([
                    "message"=>"Book not found"
                ],404);
            }
            $data = $request->validated();
            if($request->hasFile('cover_image_url')){
                $file = $request->file('cover_image_url');
                CloudinaryFileUploadService::destroy($book->cover_image_url);
                $path = CloudinaryFileUploadService::upload($file);
                $data['cover_image_url'] = $path;
            }
            $book->update($data);
            return response()->json([
                "message" => "Book updated successfully",
                "data" => BookResource::make($book)
            ],200);
        }catch(Exception $e){
            return response()->json([
                "message"=>"Internal Server Error"
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $book = Book::find($id);
            if(!$book){
                return response()->json([
                    "message" => "Book not found"
                ],404);
            }
            if($book->cover_image_url){
                CloudinaryFileUploadService::destroy($book->cover_image_url);
            }
            $book->delete();
            return response()->json([
                "message"=>"Book deleted successfully"
            ],200);
        }catch(Exception $e){
            return response()->json([
                "message"=>"Internal Server Error"
            ],500);
        }
    }
}
