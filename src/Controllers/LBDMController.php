<?php

namespace ArtinCMS\LBDM\Controllers;

use Validator;
use DataTables;
use Illuminate\Http\Request;
use ArtinCMS\LBDM\Models\Basicdata;
use App\Http\Controllers\Controller;
use ArtinCMS\LBDM\Models\BasicdataValue;
use ArtinCMS\LBDM\Requests\EditBasicdata_Request;
use ArtinCMS\LBDM\Requests\DeleteBasicdata_Request;
use ArtinCMS\LBDM\Requests\CreateBasicdata_Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use ArtinCMS\LBDM\Requests\GetBasicdataValues_Request;
use ArtinCMS\LBDM\Requests\EditBasicdataValue_Request;
use ArtinCMS\LBDM\Requests\CreateBasicdataValue_Request;
use ArtinCMS\LBDM\Requests\DeleteBasicdataValue_Request;
use ArtinCMS\LBDM\Requests\LoadBasicdataEditForm_Request;
use ArtinCMS\LBDM\Requests\LoadBasicdataValueEditForm_Request;

class LBDMController extends Controller
{
    private function reOrderBasicdataValueItem($basicdata_id)
    {
        $all_BasicdataValueItems = BasicdataValue::where('basicdata_id', $basicdata_id)->orderBy('order', 'asc')->get();
        $i = 1;
        foreach ($all_BasicdataValueItems as $item)
        {
            $item->order = $i++;
            $item->save();
        }
        return $i;
    }

    private function reOrderBasicdataItem($parent_id)
    {
        $all_BasicdataItems = Basicdata::where('parent_id', $parent_id)->orderBy('order', 'asc')->get();
        $i = 1;
        foreach ($all_BasicdataItems as $item)
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

    public function getBasicdata(Request $request)
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

    public function getBasicdataValue(GetBasicdataValues_Request $request)
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

    public function createBasicdata(CreateBasicdata_Request $request)
    {
        $parent_id = $request->parent_id ? $request->parent_id : 0 ;
        $dev_title = md5($parent_id.'_'.date('Y-m-d:H-i-s'));
        $basic_data = new Basicdata();
        $basic_data->parent_id = $parent_id;
        $basic_data->dev_title = $dev_title;
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

    public function createBasicdataValue(CreateBasicdataValue_Request $request)
    {
        $basic_data_value = new BasicdataValue();
        $basicdata_id = LBDM_DeCodeId($request->basicdata_id_hidden) ;
        $basicdata = Basicdata::find($basicdata_id);
        if ($basicdata && $basicdata->fixed == 0)
        {
            $dev_title = md5($basicdata_id.'_'.date('Y-m-d:H-i-s'));
            $basic_data_value->basicdata_id = $basicdata_id;
            $basic_data_value->title = $request->title;
            $basic_data_value->dev_title = $dev_title;
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
        }
        else
        {
            $res =
                [
                    'success' => false,
                    'message' => [['title' => 'لطفا موارد زیر را بررسی نمایید:', 'items' => [
                        'error' => 'عملیات امکان پذیر نمیباشد .'
                    ]]]
                ];
        }

        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function editBasicdata(EditBasicdata_Request $request)
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

    public function deleteBasicdata(DeleteBasicdata_Request $request)
    {
        $basic_data = Basicdata::find(LBDM_DeCodeId($request->basic_data_id));
        if ($basic_data && $basic_data->undeletable == 0)
        {
            $basic_data->delete();
            $res =
                [
                    'success' => true,
                    'status_type' => "success",
                    'message' => 'داده اولیه با موفقیت حذف گردید.'
                ];

        }
        else
        {
            $res =
                [
                    'success' => false,
                    'message' => [['title' => 'لطفا موارد زیر را بررسی نمایید:', 'items' => [
                        'error' => 'عملیات امکان پذیر نمیباشد .'
                    ]]]
                ];
        }
        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function deleteBasicdataValue(DeleteBasicdataValue_Request $request)
    {
        $basic_data_value = BasicdataValue::find(LBDM_DeCodeId($request->basic_data_value_id));
        if ($basic_data_value && $basic_data_value->undeletable == 0)
        {
            $basic_data_value->delete();
            $res =
                [
                    'success' => true,
                    'status_type' => "success",
                    'message' => 'مقدار داده اولیه با موفقیت حذف گردید.'
                ];

        }
        else
        {
            $res =
                [
                    'success' => false,
                    'message' => [['title' => 'لطفا موارد زیر را بررسی نمایید:', 'items' => [
                        'error' => 'عملیات امکان پذیر نمیباشد .'
                    ]]]
                ];
        }

        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function editBasicdataValue(EditBasicdataValue_Request $request)
    {
        $basic_data = BasicdataValue::find(LBDM_DeCodeId($request->item_id));
//        $basic_data->basicdata_id = $request->basicdata_id;
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

    public function getBasicdataEditForm(LoadBasicdataEditForm_Request $request)
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

    public function getBasicdataValueEditForm(LoadBasicdataValueEditForm_Request $request)
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

    public function saveOrderBasicdataValueItem(Request $request)
    {
        $item_id = LBDM_DeCodeId($request->item_id);
        $basicdata_id = $request->basicdata_id;
        $count = $this->reOrderBasicdataValueItem($basicdata_id);
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

    public function saveOrderBasicdataItem(Request $request)
    {
        $item_id = LBDM_DeCodeId($request->item_id);
        $parent_id = $request->parent_id;
        $count = $this->reOrderBasicdataItem($parent_id);
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