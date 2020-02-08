@component('mail::message')

@component('mail::panel')
###{{ $data['message'] }}
@endcomponent

@component('mail::table')
| 项目名称		| {{ $data['project'] }}									|
| ---------	|:-------------:											|
| 异常时间		| {{ $data['created_at'] }}									|
| 请求地址  	| （{{$data['method']}}）{{ $data['request_url'] }}			|
| 请求参数		| {{ $data['params']}}										|
| 错误码		| {{ $data['code'] }}										|
| 异常位置		| {{ $data['file'] }}（{{ $data['line'] }}）					|
| 异常类名		| {{ $data['exception_class'] }}							|
| 请求IP		| {{ $data['ip'] }}											|
| 异常明细 		| <{{ $data['url'] }}>										|
@endcomponent

###请求头
@if (!empty($data['header']))
@foreach(json_decode($data['header'],true) as $key=>$value)
	{{ $key }} => @if (is_array($value)){{ implode($value,',') }}@else{{ $value }}@endif
	
@endforeach
@endif
	
###Cookie
@if (!empty($data['cookie']))
@foreach(json_decode($data['cookie'],true) as $key=>$value)
	{{ $key }} => @if (is_array($value)){{ implode($value) }}@else{{ $value }}@endif
	
@endforeach
@endif
	
###Session:
@if (!empty($data['session']))
@foreach(json_decode($data['session'],true) as $key=>$value)
	{{ $key }} => @if (is_array($value)){{ implode($value) }}@else{{ $value }}@endif

@endforeach
@endif
	
@endcomponent