<?php

namespace ArtinCMS\LBDM\Controllers;

use Validator;
use DataTables;
use Illuminate\Http\Request;
use ArtinCMS\LBDM\Models\BasicData;
use App\Http\Controllers\Controller;
use ArtinCMS\LBDM\Models\BasicDataValue;
use ArtinCMS\LBDM\Requests\EditBasicData_Request;
use ArtinCMS\LBDM\Requests\DeleteBasicData_Request;
use ArtinCMS\LBDM\Requests\CreateBasicData_Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use ArtinCMS\LBDM\Requests\GetBasicDataValues_Request;
use ArtinCMS\LBDM\Requests\EditBasicDataValue_Request;
use ArtinCMS\LBDM\Requests\CreateBasicDataValue_Request;
use ArtinCMS\LBDM\Requests\DeleteBasicDataValue_Request;
use ArtinCMS\LBDM\Requests\LoadBasicDataEditForm_Request;
use ArtinCMS\LBDM\Requests\LoadBasicDataValueEditForm_Request;

class LBDMController extends Controller
{
    private function reOrderBasicDataValueItem($basicdata_id)
    {
        $all_BasicDataValueItems = BasicdataValue::where('basicdata_id', $basicdata_id)->orderBy('order', 'asc')->get();
        $i = 1;
        foreach ($all_BasicDataValueItems as $item)
        {
            $item->order = $i++;
            $item->save();
        }
        return $i;
    }

    private function reOrderBasicDataItem($parent_id)
    {
        $all_BasicDataItems = Basicdata::where('parent_id', $parent_id)->orderBy('order', 'asc')->get();
        $i = 1;
        foreach ($all_BasicDataItems as $item)
        {
            $item->order = $i++;
            $item->save();
        }
        return $i;
    }

    public function index()
    {
        $basicData = Basicdata::all();
        return view('laravel_basicdata_manager::backend.basic_data_index', compact('basicData'));
    }

    public function getBasicData(Request $request)
    {
        if ($request->item_id)
        {
            $basic_data = Basicdata::where('parent_id', $request->item_id);
        }
        else
        {
            $basic_data = Basicdata::query();
        }
        return Datatables::eloquent($basic_data)
            ->editColumn('id', function ($data) {
                return LBDM_EnCodeId($data->id);
            })
            ->editColumn('short_comment', function ($data) {
                return substr($data->comment, 0, 70) . '...';
            })
            ->addColumn('created_at_jalali', function ($data) {
                return $data->created_at_jalali;
            })
            ->addColumn('base_item', function ($data) {
                return $data->id;
            })
            ->addColumn('main_id', function ($data) {
                return $data->id;
            })
            ->make(true);
    }

    public function getBasicDataValue(GetBasicDataValues_Request $request)
    {
        $basic_data = BasicdataValue::where('basicdata_id', LBDM_DeCodeId($request->basic_data_id));
        return Datatables::eloquent($basic_data)
            ->editColumn('id', function ($data) {
                return LBDM_EnCodeId($data->id);
            })
            ->addColumn('created_at_jalali', function ($data) {
                return $data->created_at_jalali;
            })
            ->addColumn('main_id', function ($data) {
                return $data->id;
            })
            ->make(true);

    }

    public function createBasicData(CreateBasicData_Request $request)
    {
        $basic_data = new Basicdata();
        $basic_data->parent_id = $request->parent_id ? $request->parent_id : 0;
        $basic_data->title = $request->title;
        $basic_data->comment = $request->comment;
        $basic_data->created_by = auth()->id();
        $basic_data->save();

        $res =
            [
                'success' => true,
                'status_type' => "success",
                'title' => 'افزودن داده اولیه .',
                'message' => 'داده اولیه با موفقیت افزوده شد.'
            ];


        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function createBasicDataValue(CreateBasicDataValue_Request $request)
    {
        $basic_data_value = new BasicdataValue();
        $basicdata_id = LBDM_DeCodeId($request->basicdata_id_hidden) ;
        $basic_data_value->basicdata_id = $basicdata_id;
        $basic_data_value->title = $request->title;
        $basic_data_value->value = $request->value;
        $basic_data_value->comment = $request->comment;
        $basic_data_value->created_by = auth()->id();
        $basic_data_value->save();

        $res =
            [
                'success' => true,
                'status_type' => "success",
                'message' => 'مقدار داده اولیه با موفقیت افزوده شد.'
            ];

        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function editBasicData(EditBasicData_Request $request)
    {
        $basic_data = Basicdata::find(LBDM_DeCodeId($request->item_id));
        $basic_data->parent_id = $request->parent_id ? $request->parent_id : 0;
        $basic_data->title = $request->title;
        $basic_data->comment = $request->comment;
        $basic_data->created_by = auth()->id();
        $basic_data->save();

        $res =
            [
                'success' => true,
                'status_type' => "success",
                'message' => 'داده اولیه با موفقیت ویرایش شد.'
            ];


        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function deleteBasicData(DeleteBasicData_Request $request)
    {
        $basic_data = Basicdata::find(LBDM_DeCodeId($request->basic_data_id));
        $basic_data->delete();

        $res =
            [
                'success' => true,
                'status_type' => "success",
                'message' => 'داده اولیه با موفقیت حذف گردید.'
            ];


        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function deleteBasicDataValue(DeleteBasicDataValue_Request $request)
    {
        $basic_data_value = BasicdataValue::find(LBDM_DeCodeId($request->basic_data_value_id));
        $basic_data_value->delete();

        $res =
            [
                'success' => true,
                'status_type' => "success",
                'message' => 'مقدار داده اولیه با موفقیت حذف گردید.'
            ];


        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function editBasicDataValue(EditBasicDataValue_Request $request)
    {
        $basic_data = BasicdataValue::find(LBDM_DeCodeId($request->item_id));
        $basic_data->basicdata_id = $request->basicdata_id;
        $basic_data->title = $request->title;
        $basic_data->value = $request->value;
        $basic_data->comment = $request->comment;
        $basic_data->created_by = auth()->id();
        $basic_data->save();

        $res =
            [
                'success' => true,
                'status_type' => "success",
                'message' => 'مقدار داده اولیه با موفقیت ویرایش شد.'
            ];


        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function getBasicDataEditForm(LoadBasicDataEditForm_Request $request)
    {
        $basic_data = Basicdata::find(LBDM_DeCodeId($request->basic_data_id));
        $basic_data_edit_view = view('laravel_basicdata_manager::backend.views.basic_data_edit_form')
            ->with('basic_data', $basic_data)
            ->render();
        $res =
            [
                'success' => true,
                'status_type' => "success",
                'edit_view' => $basic_data_edit_view
            ];


        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function getBasicDataValueEditForm(LoadBasicDataValueEditForm_Request $request)
    {
        $basic_data_value = BasicdataValue::find(LBDM_DeCodeId($request->basic_data_value_id));
        $basic_data_value_edit_view = view('laravel_basicdata_manager::backend.views.basic_data_value_edit_form')
            ->with('basic_data_value', $basic_data_value)
            ->render();
        $res =
            [
                'success' => true,
                'status_type' => "success",
                'basic_data_value_view' => $basic_data_value_edit_view
            ];


        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function saveOrderBasicDataValueItem(Request $request)
    {
        $item_id = LBDM_DeCodeId($request->item_id);
        $basicdata_id = $request->basicdata_id;
        $count = $this->reOrderBasicDataValueItem($basicdata_id);
        $BasicdataValue = BasicdataValue::find($item_id);
        $order = $BasicdataValue->order;
        if ($request->order_type == 'increase')
        {
            $nextItem = BasicdataValue::where('basicdata_id', $basicdata_id)->where('order', '=', $order + 1)->first();
            if ($nextItem)
            {
                $BasicdataValue->order = $order + 1;
                $BasicdataValue->save();
                //set new order
                $nextItem->order = $order;
                $nextItem->save();
            }
        }
        elseif ($request->order_type == 'decrease')
        {
            $previousItem = BasicdataValue::where('basicdata_id', $basicdata_id)->where('order', '=', $order - 1)->first();
            if ($previousItem)
            {
                $BasicdataValue->order = $order - 1;
                $BasicdataValue->save();
                //set new order
                $previousItem->order = $order;
                $previousItem->save();
            }
        }
        else
        {
            $result['error'][] = "متاسفانه با مشکل مواجه شد!";
            $result['success'] = false;
            return response()->json($result, 200)->withHeaders(['Content-Type' => 'json', 'charset' => 'utf-8']);
        }
        $result['message'][] = "با موفقیت انجام شد.";
        $result['success'] = true;
        return response()->json($result, 200)->withHeaders(['Content-Type' => 'json', 'charset' => 'utf-8']);
    }

    public function saveOrderBasicDataItem(Request $request)
    {
        $item_id = LBDM_DeCodeId($request->item_id);
        $parent_id = $request->parent_id;
        $count = $this->reOrderBasicDataItem($parent_id);
        $Basicdata = Basicdata::find($item_id);
        $order = $Basicdata->order;
        if ($request->order_type == 'increase')
        {
            $nextItem = Basicdata::where('parent_id', $parent_id)->where('order', '=', $order + 1)->first();
            if ($nextItem)
            {
                $Basicdata->order = $order + 1;
                $Basicdata->save();
                //set new order
                $nextItem->order = $order;
                $nextItem->save();
            }
        }
        elseif ($request->order_type == 'decrease')
        {
            $previousItem = Basicdata::where('parent_id', $parent_id)->where('order', '=', $order - 1)->first();
            if ($previousItem)
            {
                $Basicdata->order = $order - 1;
                $Basicdata->save();
                //set new order
                $previousItem->order = $order;
                $previousItem->save();
            }
        }
        else
        {
            $result['error'][] = "متاسفانه با مشکل مواجه شد!";
            $result['success'] = false;
            return response()->json($result, 200)->withHeaders(['Content-Type' => 'json', 'charset' => 'utf-8']);
        }
        $result['message'][] = "با موفقیت انجام شد.";
        $result['success'] = true;
        return response()->json($result, 200)->withHeaders(['Content-Type' => 'json', 'charset' => 'utf-8']);
    }



}