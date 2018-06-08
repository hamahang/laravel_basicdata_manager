<?php

namespace ArtinCMS\LBDM\Controllers;

use ArtinCMS\LBDM\Models\BasicData;
use ArtinCMS\LBDM\Models\BasicDataValue;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Support\Facades\View;
use Validator;
use Illuminate\Http\Request;

class LBDMController extends Controller
{
    private function reOrderBasicdata($filter_id)
    {
        $all_basicdata = BasicData::where('parent_id',$filter_id)->orderBy('order', 'asc')->get();
        $i = 1;
        foreach ($all_basicdata as $basicdata)
        {
            $basicdata->order = $i++;
            $basicdata->save();
        }
        return $i;
    }
    private function reOrderBasicdataValue($basicdata_id)
    {
        $all_work_group_item_more_services = BasicDataValue::where('basicdata_id', $basicdata_id)->orderBy('order', 'asc')->get();
        $i = 1;
        foreach ($all_work_group_item_more_services as $work_group_item_more_service)
        {
            $work_group_item_more_service->order = $i++;
            $work_group_item_more_service->save();
        }
        return $i;
    }

    public function index_basicdata_value()
    {
        return view('LBDM::backend.helper.index_basicdata_value');
    }

    public function index()
    {
        $basic_data=BasicData::with('Items')->get();
        return view('LBDM::backend.index')->with('basicdata',$basic_data);

    }

    public function list_basicdata(Request $request)
    {

        if(isset($request->filter_id)&& $request->filter_id)
        {
            return datatables()->eloquent(
                BasicData::with('Items')
                    ->where('parent_id',$request->filter_id))
                ->addColumn('count_basic', function ($data) {
                    return $data->items->count();
                })->make(true);
        }
        else{

            return datatables()->eloquent(BasicData::with('Items')->orderBY('order','ASC')
                ->orderBY('id','ASC'))
                ->addColumn('count_basic', function ($data) {
                    return $data->items->count();
                })->make(true);
        }

    }

    public function list_basicdata_value(Request $request)
    {
      $validator = Validator::make(
           $request->all(),
           [
               'basicdata_id' => 'required|exists:basicdata,id',
           ]
       );
       if ($validator->fails()) {

           $res =
               [
                   'success' => false,
                   'error' => $validator->errors()
               ];
           return json_encode($res);
       } else {
        return datatables()->eloquent(BasicDataValue::where('basicdata_id',$request->basicdata_id))->make(true);
        }
    }

    public function insert_basicdata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'parent_id'=>'required|exists_or_zero:BasicData',
                'title' => 'required|string',
                'dev_title' => 'required|string',
                'is_active' => 'required|integer:0,1',
                'comment' => 'nullable|string',
            ]
        );
        if ($validator->fails()) {
            /* $error = validation_error_to_api_json($validator->errors());*/
            $res =
                [
                    'success' => false,
                    'error' => $validator->errors()
                ];
            return json_encode($res);
        } else {
            $basic = new BasicData();
            $basic->title = $request->title;
            $basic->dev_title = $request->dev_title;
            $basic->is_active = $request->is_active;
            $basic->comment = $request->comment;
            $basic->dev_comment = $request->dev_comment;
            $basic->parent_id = $request->parent_id;
            $basic->extra_field = $request->extra_field;
            $basic->save();
            $result['message'] = 'عملیات ثبت با موفقیت انجام شد';
            $result['success'] = true;
            return json_encode($result);
        }
    }

    public function delete_basicdata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|exists:basicdata,id',
            ]
        );
        if ($validator->fails()) {
            /* $error = validation_error_to_api_json($validator->errors());*/
            $res =
                [
                    'success' => false,
                    'error' => $validator->errors()
                ];
            return json_encode($res);
        } else {
            $basic = BasicData::find($request->id);
            $basic->delete();
            $result['message'] = 'عملیات حذف با موفقیت انجام شد';
            $result['success'] = true;
            return json_encode($result);
        }

    }

    public function update_basicdata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|exists:basicdata,id',
                'title' => 'required|string',
                'dev_title' => 'required|string',
                'is_active' => 'required|integer:0,1',
                'comment' => 'required|string',
            ]
        );
        if ($validator->fails()) {
            /* $error = validation_error_to_api_json($validator->errors());*/
            $res =
                [
                    'success' => false,
                    'error' => $validator->errors()
                ];
            return json_encode($res);
        } else {
            $basic = BasicData::find($request->id);
            $basic->title = $request->title;
            $basic->dev_title = $request->dev_title;
            $basic->is_active = $request->is_active;
            $basic->comment = $request->comment;
            $basic->dev_comment = $request->dev_comment;
            $basic->created_by = $request->created_by;
            $basic->parent_id = $request->parent_id;
            $basic->extra_field = $request->extra_field;
            $basic->save();
            $result['message'] = 'عملیات ویرایش با موفقیت انجام شد';
            $result['success'] = true;
            return json_encode($result);
        }
    }

    public function insert_basicdata_value(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'basicdata_id' => 'required|exists:basicdata,id',
                'title' => 'required|max:255',
                'dev_title' => 'nullable|string',
                'is_active' => 'required|integer:0,1',
            ]
        );
        if ($validator->fails()) {
            /*$error = validation_error_to_api_json($validator->errors());*/
            $res =
                [
                    'success' => false,
                    'error' => $validator->errors()
                ];
            return json_encode($res);
        } else {
            $basic_value = new BasicDataValue();
            $basic_value->basicdata_id = $request->basicdata_id;
            $basic_value->title = $request->title;
            $basic_value->dev_title = $request->dev_title;
            $basic_value->extra_field = $request->extra_field;
            $basic_value->is_active = $request->is_active;
            $basic_value->value = $request->dev_val;
            $basic_value->save();
            $result['message'] = 'عملیات ثبت با موفقیت انجام شد';
            $result['success'] = true;
            return json_encode($result);
        }
    }

    public function delete_basicdata_value(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|exists:basicdata_values,id',
            ]
        );
        if ($validator->fails()) {
            /*$error = validation_error_to_api_json($validator->errors());*/
            $res =
                [
                    'success' => false,
                    'error' => $validator->errors()
                ];
            return json_encode($res);
        } else {
            $basic_value = BasicDataValue::find($request->id);
            $basic_value->delete();
            $result['message'] = 'عملیات حذف با موفقیت انجام شد';
            $result['success'] = true;
            return json_encode($result);
        }
    }

    public function update_basicdata_value(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|exists:basicdata_values,id',
                'basicdata_id' => 'required|exists:basicdata,id',
                'title' => 'required|string',
                'dev_title' => 'nullable|string',
                'is_active' => 'required|integer:0,1',
            ]
        );
        if ($validator->fails()) {
            $res =
                [
                    'success' => false,
                    'error' => $validator->errors()
                ];
            return json_encode($res);
        } else {
            $basic_value = BasicDataValue::find($request->id);
            $basic_value->basicdata_id = $request->basicdata_id;
            $basic_value->title = $request->title;
            $basic_value->dev_title = $request->dev_title;
            $basic_value->extra_field = $request->extra_field;
            $basic_value->value = $request->dev_val;
            $basic_value->comment = $request->comment;
            $basic_value->is_active = $request->is_active;
            $basic_value->save();
            $result['message'] = 'عملیات ویرایش با موفقیت انجام شد';
            $result['success'] = true;
            return json_encode($result);
        }
    }

    public function JSBasicDataValue(Request $request)
    {
        $basicdata=BasicData::orderBy('id','ASC');
        $basic_middel=$basicdata->get();
        $basicdata_selected=$basic_middel->where('id',$request->basicdata_id)->first();
            $result['header'] = '<span class="pull-right">'.$basicdata_selected->title.'</span>';
            $result['content'] = View::make('LBDM::backend.JsPanelBasicDataValue.content')
                ->with('basic_id',$request->basicdata_id)
                ->with('basicdata',$basicdata->get())
                ->with('basicdata_selected',$basicdata_selected)->render();
            $result['footer'] = View::make('LBDM::backend.JsPanelBasicDataValue.footer')->render();
        return json_encode($result);
    }

    public function show_edit_basicdata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|exists:basicdata,id',
            ]
        );
        if ($validator->fails()) {
            $result['success'] = true;
            $result['view'] = view('LBDM::backend.helper.edit_basicdata')->render();
        } else {
            $basicdata = BasicData::find($request->id);

            $result['view'] = view('LBDM::backend.helper.edit_basicdata')->with('basicdata', $basicdata)->render();
            $result['success'] = true;
            return json_encode($result);
        }

    }

    public function show_edit_basicdata_value(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|exists:basicdata_values,id',
            ]
        );
        if ($validator->fails()) {
            $result['success'] = false;
            $result['view'] = view('LBDM::backend.helper.edit_basicdata_value')->render();
        } else {

            $basicdata_value = BasicDataValue::with('parent')->find($request->id);
            $basicdata = BasicData::get();
            $result['view'] = view('LBDM::backend.helper.edit_basicdata_value')
                ->with('basicdata_value', $basicdata_value)
                ->with('basicdata', $basicdata)
                ->render();
            $result['success'] = true;
            return json_encode($result);
        }

    }

    public function basic_select2(){
        $basicdata = BasicData::select("id", 'title  AS text')->get();
        $data = array('results' => $basicdata);
        return json_encode($data);
    }

    public function save_order_basicdata(Request $request)
    {
        $input = $request->all();
        $rules = [
            'id' => 'required',
            'parent_id' => 'required',
            'order_type' => 'required',
        ];
        $messages = [
            'id.required' => 'محدوده هزینه خدمات انتخاب نشده است.',
            'parent_id.required' => 'زیر گروه کاری انتخاب نشده است.',
            'order_type.required' => 'نوع تغییر مشخص نشده است. ',
        ];
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails())
        {
            $error = validation_error_to_api_json($validator->errors());
            $res =
                [
                    'success' => false,
                    'error' => $error
                ];
            return response()->json($res, 200)->withHeaders(['Content-Type' => 'json', 'charset' => 'utf-8']);
        }
        else
        {
            $count_wgims = $this->reOrderBasicdata($request->parent_id);
            $basic_data = BasicData::find($request->id);
            $order = $basic_data->order;
            if ($request->order_type == 'increase')
            {
                $next_WGIMS = $basic_data::where('parent_id', $request->parent_id)->where('order', '=', $order + 1)->first();

                if ($next_WGIMS)
                {
                    $basic_data->order = $order + 1;
                    $basic_data->save();

                    $next_WGIMS->order = $order;
                    $next_WGIMS->save();
                }

            }
            elseif ($request->order_type == 'decrease')
            {
                $previous_WGIMS = $basic_data::where('parent_id', $request->parent_id)->where('order', '=', $order - 1)->first();
                if ($previous_WGIMS)
                {
                    $basic_data->order = $order - 1;
                    $basic_data->save();

                    $previous_WGIMS->order = $order;
                    $previous_WGIMS->save();
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

    public function save_order_basicdata_value(Request $request)
    {
        $input = $request->all();
        $rules = [
            'basicdata_id' => 'required',
            'basicdata_value_id' => 'required',
            'order_type' => 'required',
        ];
        $messages = [
            'basicdata_id.required' => 'محدوده هزینه خدمات انتخاب نشده است.',
            'basicdata_value_id.required' => 'زیر گروه کاری انتخاب نشده است.',
            'order_type.required' => 'نوع تغییر مشخص نشده است. ',
        ];
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails())
        {
            $error = validation_error_to_api_json($validator->errors());
            $res =
                [
                    'success' => false,
                    'error' => $error
                ];
            return response()->json($res, 200)->withHeaders(['Content-Type' => 'json', 'charset' => 'utf-8']);
        }
        else
        {
            $count_wgims = $this->reOrderBasicdataValue($request->basicdata_id);
            $basicdata_value = BasicDataValue::find($request->basicdata_value_id);
            $order = $basicdata_value->order;
            if ($request->order_type == 'increase')
            {
                $next_WGIMS = BasicDataValue::where('basicdata_id', $request->basicdata_id)->where('order', '=', $order + 1)->first();

                if ($next_WGIMS)
                {
                    $basicdata_value->order = $order + 1;
                    $basicdata_value->save();

                    $next_WGIMS->order = $order;
                    $next_WGIMS->save();
                }

            }
            elseif ($request->order_type == 'decrease')
            {
                $previous_WGIMS = BasicDataValue::where('basicdata_id', $request->basicdata_id)->where('order', '=', $order - 1)->first();
                if ($previous_WGIMS)
                {
                    $basicdata_value->order = $order - 1;
                    $basicdata_value->save();

                    $previous_WGIMS->order = $order;
                    $previous_WGIMS->save();
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

    public function get_jstree_basicdata(){
       $basic=BasicData::select('id','title as text','parent_id as parent')->get();
       foreach ($basic as $basic_data)
        {
            if(!$basic_data->parent){
                $basic_data->parent='#';
            }
        }

       return json_encode($basic);
    }
}