<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\Food\NewFoodRequest;
use App\Http\Requests\Food\UpdateFoodRequest;
use App\Http\Traits\ResponseTrait;
use App\Http\Traits\ImageHandleTraits;


use App\Models\Food;
use App\Models\ProductList;
use App\Models\Category;
use App\Models\Restaurant;



use Exception;
use Carbon\Carbon;

use DB;

class FoodController extends Controller
{
    use ResponseTrait, ImageHandleTraits;

    public function index(){
		$allFood = Food::where('user_id','=',currentUserId())->with('category')
			->orderBy('id', 'DESC')
			->paginate(25);
        return view('backend.food.index', compact('allFood'));
    }

    public function addForm(){
        $allCategory    = Category::orderBy('id', 'DESC')->get();
        $allRestaurant  = Restaurant::where('active','=',1)->orderBy('id', 'DESC')->get();
        return view('backend.food.add_new', compact([
            'allCategory','allRestaurant'
        ]));
    }

    public function store(NewFoodRequest $request){
        /*dd($request->toArray());
        echo '</pre>';*/
        try {
            $food = new Food;

            if($request->has('thumbnail')) $food->thumbnail = $this->uploadImage($request->file('thumbnail'), 'food/thumbnail');
            $food->user_id =  encryptor('decrypt', request()->session()->get('user'));
            $food->restaurant_id =  $request->restaurant_id;
            $food->category_id = $request->category_id;
            $food->name = $request->name;

            $food->price = $request->price;
            $food->discount_price = $request->discount_price;
            $food->unit = $request->unit;
            $food->featured = $request->featured?$request->featured:0;
            $food->deliverable = $request->deliverable?$request->deliverable:0;
            $food->description = $request->description;
            
            
        

            if(!!$food->save()){
                return redirect(route(currentUser().'.allFood'))->with($this->responseMessage(true, null, 'Food created'));
            }

        } catch (Exception $e) {
            return redirect()->back()->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }

    }

    public function editForm($id){
        $data = Food::where('id',encryptor('decrypt', $id))->first();
        $allRestaurant  = Restaurant::where('active','=',1)->orderBy('id', 'DESC')->get();
		$allCategory = Category::where('userId','=',encryptor('decrypt', request()->session()->get('user')))->orderBy('id', 'DESC')->get();
        return view('backend.food.edit', compact([
            'data','allCategory','allRestaurant'
        ]));
    }

    public function update(Request $request){
        try {
            $food=Food::find(encryptor('decrypt', $request->id));

            if($request->has('thumbnail')) 
                if($this->deleteImage($food->thumbnail, 'product/thumbnail'))
                    $food->thumbnail = $this->uploadImage($request->file('thumbnail'), 'product/thumbnail');
                else
                    $food->thumbnail = $this->uploadImage($request->file('thumbnail'), 'product/thumbnail');


            $food->user_id =  encryptor('decrypt', request()->session()->get('user'));
            $food->restaurant_id =  $request->restaurant_id;
            $food->category_id = $request->category_id;
            $food->name = $request->name;

            $food->price = $request->price;
            $food->discount_price = $request->discount_price;
            $food->unit = $request->unit;
            $food->featured = $request->featured?$request->featured:0;
            $food->deliverable = $request->deliverable?$request->deliverable:0;
            $food->description = $request->description;

            $food->save();

            if(!!$food->save()){
                return redirect(route(currentUser().'.allFood'))->with($this->responseMessage(true, null, 'Product updated'));
            }

        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

    public function delete($id){
        try {
            $food = Food::find(encryptor('decrypt', $id));
            if($food != null){
                $this->deleteImage($food->thumbnail, 'Food/thumbnail');
                $food->delete();
                return redirect(route(currentUser().'.allFood'))->with($this->responseMessage(true, null, 'Food deleted'));
            }
        }catch (Exception $e) {
            dd($e);
            return redirect(route(currentUser().'.allProduct'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }

    }
	
    public function importProductList(Request $request){
        /* remove all search element */
		if(isset($_GET['fresh']) && $_GET['fresh']){
		    $request->session()->forget('brands');
		    $request->session()->forget('category');
		    $request->session()->forget('name');
		}
			
		$where['status']=1;
		if(isset($_GET['brands']) && $_GET['brands'])
			$request->session()->put('brands', $_GET['brands']);
		
		if(isset($_GET['category']) && $_GET['category'])
		    $request->session()->put('category', $_GET['category']);
		
		if(isset($_GET['name']) && $_GET['name'])
		    $request->session()->put('name', $_GET['name']);
		
		
		if($request->session()->has('brands') && $request->session()->get('brands'))
			$where['brandId']=$request->session()->get('brands');
		if($request->session()->has('category') && $request->session()->get('category'))
			$where['categoryId']=$request->session()->get('category');
			
		//$pro = Product::select('productId')->where(company())->where(branch())->pluck('productId')->toArray();

        $allCategory = Category::orderBy('id', 'DESC')->get();
        $allBrand = Brand::orderBy('id', 'DESC')->get();
        //$productlist=ProductList::where($where)->whereNotIn('id',$pro);
        $productlist=ProductList::where($where);
		
		if($request->session()->has('name') && $request->session()->get('name')){
		    $name=$request->session()->get('name');
			$productlist = $productlist->where('name','LIKE', "{$name}%");
		}
		$productlist = $productlist->orderBy('name', 'ASC')->paginate(25);
			
        return view('product.productlist', compact('productlist','allCategory','allBrand'));
    }

    public function importProduct(){
        try {
            $pro = ProductList::findOrFail($_GET['pid']);
            $p = new Product;
            $p->thumbnail = $pro->thumbnail;
            $p->brandId = $pro->brandId;
            $p->categoryId = $pro->categoryId;
            $p->name = $pro->name;
            $p->sku = company()['companyId'].'-'.str_pad(Product::where(company())->where(branch())->latest()->count() + 1,5,"0",STR_PAD_LEFT);
            $p->shortDescription = $pro->shortDescription;
            $p->description = $pro->description;
            $p->modelName = $pro->modelName;
            $p->modelNo = $pro->modelNo;
            $p->status = 1;
            $p->userId = currentUserId();
            $p->branchId = branch()['branchId'];
            $p->companyId = company()['companyId'];
            $p->save();
			return false;
        } catch (Exception $e) {
            dd($e);
        }

    }
	
}
