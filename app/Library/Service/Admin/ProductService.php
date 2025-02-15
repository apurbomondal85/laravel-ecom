<?php

namespace App\Library\Service\Admin;

use Exception;
use App\Library\Enum;
use App\Library\Helper;
use App\Models\Attachment;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProductService extends BaseService
{
    private function actionHtml($row)
    {
        $actionHtml = '';

        if ($row->id) {
            $actionHtml = '
            <a class="dropdown-item" href="' . route('admin.product.updateForm', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>
            <a style="cursor: pointer" class="dropdown-item text-danger" onclick="confirmFormModal(\'' . route('admin.product.delete', $row->id) . '\', \'Confirmation\', \'Are you sure to delete operation?\')" ><i class="fas fa-trash-alt"></i> Delete</a>';
        } else {
            $actionHtml = '';
        }

        return '<div class="action dropdown dropdown-menu-end">
                    <button class="btn btn2-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                       <i class="fas fa-tools"></i> Action
                    </button>
                    <div class="dropdown-menu">
                        ' . $actionHtml . '
                    </div>
                </div>';
    }

    private function getActiveSwitch($row)
    {
        $is_check = $row->featured == 1 ? "checked" : "";
        $route = "'" . route('admin.product.changeStatus', $row->id) . "'";

        return '<label class="custom-switch" for="primarySwitch_' . $row->id . '">
                    <input type="checkbox" class="custom-switch-input"
                        id="primarySwitch_' . $row->id . '" ' . $is_check . '
                        onchange="changeStatus(event, ' . $route . ')">
                    <span class="custom-switch-indicator"></span>
                </label>';
    }

    public function dataTable()
    {
        $data = Product::with(['category', 'brand'])->orderBy('id', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function ($row){
                $image = $row->getThumbnailImage();

                return '<img src="'. $image .'" class="img-fluid" style="width: 60px; height: 60px;"/>' . ' ' . '<a href="">'. Str::limit($row->name, 40) .'</a>';
            })
            // ->addColumn('attachment', function ($row){
            //     $image = $row->getThumbnailImage();
            //     return '<img src="'. $image .'" class="img-fluid" style="width: 60px; height: 60px;"/>';
            // })
            ->addColumn('category_id', function ($row){
                return $row->category?->name;
            })
            ->addColumn('brand_id', function ($row){
                return $row->brand->name;
            })
            ->addColumn('price', function ($row){
                return getFormattedAmount($row->price);
            })
            ->addColumn('sale_price', function ($row){
                return getFormattedAmount($row->sale_price);
            })
            ->addColumn('quantity', function ($row){
                return $row->quantity;
            })
            ->addColumn('stock', function ($row){
                $html = '';
                if($row->quantity <= 0) {
                    $html = '<span class="badge bg-danger py-2 px-3" >'. $row->stock .'</span>';
                } else {
                    $html = '<span class="badge bg-success py-2 px-3" >'. $row->stock .'</span>';
                }
                return $html;
            })
            ->editColumn('featured', function ($row) {
                return $this->getActiveSwitch($row);
            })
            ->addColumn('action', function ($row){
                return $this->actionHtml($row);
            })
            ->rawColumns(['action', 'name', 'stock', 'featured'])
            ->make(true);
    }

    public function store(array $data)
    {
          DB::beginTransaction();

          try {
            $data['slug'] = Str::slug($data['slug']);

            $product = Product::create($data);

            if (isset($data['image']) && $data['image'] != '') {
                attachmentStore($data['image'], $product, Enum::PRODUCT_THUMBNAIL_IMAGE_DIR, Enum::ATTACHMENT_TYPE_THUMBNAIL, 540 , 689);
            }

            // Gallery Image
            if (isset($data['images']) && $data['images'] != '') {
                foreach ($data['images'] as $image) {
                    attachmentStore($image, $product, Enum::PRODUCT_GALLERY_IMAGE_DIR, Enum::ATTACHMENT_TYPE_GALLERY, 540 , 689);
                }
            }

            DB::commit();

            return $this->handleSuccess('Successfully created');
          } catch (Exception $e) {
            DB::rollback();
            Helper::log($e);

            return $this->handleException($e);
          }
    }

    public function update(array $data, Product $product)
    {
          DB::beginTransaction();

          try {
            $data['slug'] = Str::slug($data['slug']);

            $product->update($data);

            // Product Thumbnail
            if (isset($data['image']) && $data['image'] != '') {
                $attachment = Attachment::where('attachable_type', Product::class)->where('attachable_id', $product->id)->where('for', Enum::ATTACHMENT_TYPE_THUMBNAIL)->first();

                deleteFile($product->getThumbnailAttribute());
                isset($attachment) ? $attachment->delete() : '';

                attachmentStore($data['image'], $product, Enum::PRODUCT_THUMBNAIL_IMAGE_DIR, Enum::ATTACHMENT_TYPE_THUMBNAIL, 540, 689);
            }

            // Gallery Image
            if (isset($requestData['old_images'])) {
                $oldImages = $requestData['old_images'];
                $attachments = Attachment::where('attachable_type', Product::class)->where('attachable_id', $product->id)->where('for', Enum::ATTACHMENT_TYPE_GALLERY)->get();

                foreach ($attachments as $attachment) {
                    if (! in_array($attachment->id, $oldImages)) {
                        deleteFile($attachment->attachment);

                        $attachment->delete();
                    }
                }
            }

            if (isset($data['images']) && $data['images'] != '') {
                foreach ($data['images'] as $image) {
                    attachmentStore($image, $product, Enum::PRODUCT_GALLERY_IMAGE_DIR, Enum::ATTACHMENT_TYPE_GALLERY, 750, 750);
                }
            }

            DB::commit();

            return $this->handleSuccess('Successfully created');
          } catch (Exception $e) {
            DB::rollback();
            Helper::log($e);

            return $this->handleException($e);
          }
    }

    public function changeStatus(Product $product): bool
    {
        try {
            if ($product->featured == 1) {
                $product->update(['featured' => 0]);
            }else{
                $product->update(['featured' => 1]);
            }

            return $this->handleSuccess('Successfully Updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function delete(Product $product): bool
    {
        try {
            deleteFile($product->getThumbnailAttribute());
            $product?->attachments()?->where('for', Enum::ATTACHMENT_TYPE_THUMBNAIL)?->delete();

            if (count($product->gallery_images) > 0) {
                foreach ($product->gallery_images as $image) {
                    deleteFile($image->attachment);
                    $image->delete();
                }
            }

            // $ext = Order::where('product_id', $product->id)->exists();
            // if (isset($ext)) {
            //     return $this->handleFailed('This product is associated with an order. Please remove the association before deleting.');
            // }

            $product->delete();

            return $this->handleSuccess('Successfully deleted');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }
}