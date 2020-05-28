<?php

if (!function_exists('message_view')) {
    function message_view($type,$text)
    {
        session()->flash($type, $text);    
    }
}
if (!function_exists('isError')) {
    function isError($errors, $name){
        if($errors->has($name)){
            return   '<span class="focus-input100" data-placeholder="&#xf207;" role="alert"></span>'.
                     '<strong style="color: red;font-size: larger;">'.$errors->first($name).'</strong>';                    
        }
    }
}


if (!function_exists('setting')) {
    function setting()
    {
        return \App\Model\Setting::orderBy('id', 'desc')->first();
    }
}

if (!function_exists('up')) {
    function up()
    {
        return new \App\Http\Controllers\Upload;
    }
}

if (!function_exists('aurl')) {
    function aurl($url = null)
    {
        return url('admin/' . $url);
    }
}

if (!function_exists('admin')) {
    function admin()
    {
        return auth()->guard('admin');
    }
}

if (!function_exists('lang')) {
    function lang()
    {
        //return session()->has('lang')? session()->has('lang') : 'en';
        if (session()->has('lang')) {
            return session('lang');
        } else {
            session()->put('lang',setting()->main_lang);
            return setting()->main_lang;
        }
    }
}

if (!function_exists('direction')) {
    function direction()
    {
        //return session()->has('lang')? session()->has('lang') : 'en';
        /*if (session()->has('lang')) {
        if (session('lang') == 'ar') {
        return 'rtl';
        } else {
        return 'ltr';
        }
        } else {
        return 'ltr';
        }*/
        if (lang() == 'ar') {
            return 'rtl';
        } else {
            return 'ltr';
        }
    }
}

if (!function_exists('datatable_lang')) {
    function datatable_lang()
    {
        return [
            'sProcessing' => trans('admin.sProcessing'),
            'sLengthMenu' => trans('admin.sLengthMenu'),
            'sZeroRecords' => trans('admin.sZeroRecords'),
            'sEmptyTable' => trans('admin.sEmptyTable'),
            'sInfo' => trans('admin.sInfo'),
            'sInfoEmpty' => trans('admin.sInfoEmpty'),
            'sInfoFiltered' => trans('admin.sInfoFiltered'),
            'sInfoPostFix' => trans('admin.sInfoPostFix'),
            'sSearch' => trans('admin.sSearch'),
            'sUrl' => trans('admin.sUrl'),
            'sInfoThousands' => trans('admin.sInfoThousands'),
            'sLoadingRecords' => trans('admin.sLoadingRecords'),
            'oPaginate' => [
                'sFirst' => trans('admin.sFirst'),
                'sLast' => trans('admin.sLast'),
                'sNext' => trans('admin.sNext'),
                'sPrevious' => trans('admin.sPrevious'),
            ],
            'oAria' => [
                'sSortAscending' => trans('admin.sSortAscending'),
                'sSortDescending' => trans('admin.sSortDescending'),
            ],
            'buttons' => [
                
                'pageLength' => [
                    '_'=> trans('admin.records_show',['d'=>'%d']),
                    '-1'=> __('admin.all_record')
                ]
            ],


        ];
    }
}

if (!function_exists('active_menu')) {
    function active_menu($link)
    {
        if (preg_match('/' . $link . '/i', Request::segment(2))) {
            return ['menu-open', 'display:block'];
        } else {
            return ['', ''];
        }
    }
}

/////// Validate Helper Functions ///////
if (!function_exists('v_image')) {
    function v_image($ext = null)
    {
        if ($ext === null) {
            return 'image|mimes:jpg,jpeg,png,gif,bmp';
        } else {
            return 'image|mimes:' . $ext;
        }

    }
}
/////// Validate Helper Functions ///////

if (!function_exists('load_dep')) {
    function load_dep($select = null, $dep_hide = null)
    {

        /*$dep = Department::select('dep_name_' . lang() . ' as text','id as id','department_id as parent')
        ->get(['text', 'parent', 'id']);
        dd($dep->all());  */
        $departments = \App\Model\Department::selectRaw('dep_name_' . lang() . ' as text')
            ->selectRaw('id as id')
            ->selectRaw('department_id as parent')
            ->get(['text', 'parent', 'id']);
        $dep_arr = [];
        foreach ($departments as $department) {
            $list_arr = [];
            $list_arr['icon'] = '';
            $list_arr['li_attr'] = '';
            $list_arr['a_attr'] = '';
            $list_arr['children'] = [];

            if ($select !== null and $select == $department->id) {
                $list_arr['state'] = [
                    'opened' => true,
                    'selected' => true,
                    'disabled' => false,
                ];
            }
            if ($dep_hide !== null and $dep_hide == $department->id) {
                $list_arr['state'] = [
                    'opened' => false,
                    'hidden' => true,
                    'disabled' => true,
                ];
            }
            $list_arr['id']     = $department->id;
			$list_arr['parent'] = $department->parent >0 ?$department->parent:'#';
            $list_arr['text']   = $department->text;
            array_push($dep_arr, $list_arr);
        }

        return json_encode($dep_arr, JSON_UNESCAPED_UNICODE);
    }
}
