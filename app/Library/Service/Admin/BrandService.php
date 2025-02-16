<?php

namespace App\Library\Service\Admin;

use Exception;
use App\Library\Enum;
use App\Library\Helper;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BrandService extends BaseService
{
    private function actionHtml($row)
    {
        $actionHtml = '';

        if ($row->id) {
            $actionHtml = '
            <a class="dropdown-item" href="' . route('admin.brand.updateForm', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>
            <a style="cursor: pointer" class="dropdown-item text-danger" onclick="confirmFormModal(\'' . route('admin.brand.delete', $row->id) . '\', \'Confirmation\', \'Are you sure to delete operation?\')" ><i class="fas fa-trash-alt"></i> Delete</a>';
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
        $is_check = $row->status == 'active' ? "checked" : "";
        $route = "'" . route('admin.brand.changeStatus', $row->id) . "'";

        return '<label class="custom-switch" for="primarySwitch_' . $row->id . '">
                    <input type="checkbox" class="custom-switch-input"
                        id="primarySwitch_' . $row->id . '" ' . $is_check . '
                        onchange="changeStatus(event, ' . $route . ')">
                    <span class="custom-switch-indicator"></span>
                </label>';
    }

    public function dataTable()
    {
        $data = Brand::orderBy('id', 'desc')->get();

        return DataTables::of($data)
               ->addIndexColumn()
               ->addColumn('name', function ($row){
                    return $row->name;
               })
               ->addColumn('slug', function ($row){
                    return $row->slug;
               })
               ->addColumn('attachment', function ($row){
                    $image = $row->getThumbnailImage();
                    return '<img src="'. $image .'" class="img-fluid" style="width: 60px; height: 60px;"/>';
               })
               ->editColumn('status', function ($row) {
                    return $this->getActiveSwitch($row);
                })
               ->addColumn('action', function ($row){
                    return $this->actionHtml($row);
               })
               ->rawColumns(['action', 'attachment', 'status'])
               ->make(true);
    }

    public function store(array $data)
    {
          DB::beginTransaction();

          try {
              $data['slug'] = Str::slug($data['slug']);
              $brand = Brand::create($data);

              if (isset($data['image']) && $data['image'] != '') {
                    attachmentStore($data['image'], $brand, Enum::BRAND_THUMBNAIL_IMAGE_DIR, Enum::ATTACHMENT_TYPE_THUMBNAIL, 400 , 400);
              }

               DB::commit();

               return $this->handleSuccess('Successfully created');
          } catch (Exception $e) {
               DB::rollback();
               Helper::log($e);

               return $this->handleException($e);
          }
    }

    public function update(array $data, Brand $brand)
    {
          DB::beginTransaction();

          try {
              $data['slug'] = Str::slug($data['slug']);
              $brand->update($data);

              if (isset($data['image']) && $data['image'] != '') {
                    attachmentStore($data['image'], $brand, Enum::BRAND_THUMBNAIL_IMAGE_DIR, Enum::ATTACHMENT_TYPE_THUMBNAIL, 400 , 400);
              }

               DB::commit();

               return $this->handleSuccess('Successfully created');
          } catch (Exception $e) {
               DB::rollback();
               Helper::log($e);

               return $this->handleException($e);
          }
    }

    public function changeStatus(Brand $brand): bool
    {
        try {
          if ($brand->status == 'active') {
               $this->data = $brand->update(['status' => 'inactive']);
          }else{
               $this->data = $brand->update(['status' => 'active']);
          }

            return $this->handleSuccess('Successfully Updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function delete(Brand $brand): bool
    {
        try {
            deleteFile($brand->getThumbnailAttribute());
            $brand?->attachments()?->where('for', Enum::ATTACHMENT_TYPE_THUMBNAIL)?->delete();

            $brand->delete();

            return $this->handleSuccess('Successfully deleted');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }
}