<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeAndColorController;
use App\Http\Controllers\SubCategoryController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('contact', [FrontendController::class, 'contact'])->name('contact');
// Route::get('about',[FrontendController::class,'about'])->name('about');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

############################ Frontend Route ############################
Route::get('/', [FrontendController::class, 'Frontend'])->name('Frontend');
Route::get('product-details/{slug}/{id}', [FrontendController::class, 'ProductDetails'])->name('ProductDetails');
Route::get('get/color/size/{color_id}/{product_id}', [FrontendController::class, 'GetProduct'])->name('GetProduct');
Route::get('carts/', [CartController::class, 'CartView'])->name('CartView');
Route::post('cart/', [CartController::class, 'CartPost'])->name('CartPost');
Route::get('delete-cart/{id}', [CartController::class, 'DeleteCart'])->name('DeleteCart');



############################ Category Routes ############################
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/categories', [CategoryController::class, 'Category'])->name('categories');
Route::get('/add-categories', [CategoryController::class, 'CategoryForm'])->name('categoryform');
Route::post('/post-category', [CategoryController::class, 'PostCategory'])->name('postCategory');
Route::get('/delete-category/{data}', [CategoryController::class, 'DeleteCategory'])->name('deletecategory');
Route::get('/edit-category/{data}', [CategoryController::class, 'EditCategory'])->name('editcategory');
Route::post('/update-category', [CategoryController::class, 'UpdateCategory'])->name('updatecategory');
Route::get('/trashed-categories', [CategoryController::class, 'TrashCategory'])->name('trashcategory');
Route::get('/restore-categories/{data}', [CategoryController::class, 'RestoreCategory'])->name('restorecategory');
Route::get('/Permanent-delete-categories/{data}', [CategoryController::class, 'PermanentDeleteCategory'])->name('permanentdeletecategory');


############################ Sub-Category Routes ############################
Route::get('/subcategories', [SubCategoryController::class, 'Subcategories'])->name('Subcategories');
Route::get('/add-subcategory', [SubCategoryController::class, 'AddSubcategories'])->name('addSubcategory');
Route::post('/post-subcategory', [SubCategoryController::class, 'PostSubcategories'])->name('postSubcategory');
Route::post('/post-delete-subcategory', [SubCategoryController::class, 'PosstDeleteAllSubcategories'])->name('PosstDeleteAllSubcategories');
Route::get('/trashed-subcategories', [SubCategoryController::class, 'TrashSubCategory'])->name('trashSubcategory');
Route::get('/edit-subcategories/{slug}', [SubCategoryController::class, 'editsubcategories'])->name('editsubcategories');
Route::get('/delete-subcategory/{slug}', [SubCategoryController::class, 'Deletesubcategories'])->name('deletesubcategory');
Route::post('/update-subcategories', [SubCategoryController::class, 'updatesubcategories'])->name('updatesubcategories');
Route::get('/delete-subcategories/{slug}', [SubCategoryController::class, 'PermanentdeleteSubCategory'])->name('PermanentdeleteSubCategory');
Route::get('/restore-subcategories/{slug}', [SubCategoryController::class, 'PermanentrestoreSubCategory'])->name('PermanentrestoreSubCategory');

############################ Product Routes ############################
Route::get('/products', [ProductController::class, 'ViewProducts'])->name('products.view');
Route::get('api/get-subcat-list/{cat_id}', [ProductController::class, 'GetSubCat'])->name('GetSubCat');
Route::post('/add-products', [ProductController::class, 'AddProduct'])->name('AddProduct');
Route::get('/post-products', [ProductController::class, 'ProductForm'])->name('ProductForm');
Route::get('/edit-product/{slug}/{id}', [ProductController::class, 'EditProduct'])->name('EditProduct');
Route::post('/update-product', [ProductController::class, 'UpdateProduct'])->name('UpdateProduct');
Route::get('/delete-product/{slug}/{id}', [ProductController::class, 'DeleteProduct'])->name('DeleteProduct');
Route::get('/deleted-product', [ProductController::class, 'TrashedProduct'])->name('TrashedProduct');
Route::get('delete-product-attribute-id/{id}', [ProductController::class, 'DeleteProductAttribute'])->name('DeleteProductAttribute');


############################ Size And Color Route ############################
Route::get('create-size', [SizeAndColorController::class, 'CreateSize'])->name('CreateSize');
Route::post('post-size', [SizeAndColorController::class, 'PostSize'])->name('PostSize');
Route::get('create-color', [SizeAndColorController::class, 'CreateColor'])->name('CreateColor');
Route::post('post-color', [SizeAndColorController::class, 'PostColor'])->name('PostColor');
Route::get('delete-color/{id}', [SizeAndColorController::class, 'DeleteColor'])->name('DeleteColor');
Route::get('delete-size/{id}', [SizeAndColorController::class, 'DeleteSize'])->name('DeleteSize');





require __DIR__ . '/auth.php';
