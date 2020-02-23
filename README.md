## 记录信息

通过http请求的方式来记录信息

####异常信息

请求方式:`POST`

请求路径:`/exception`

请求类型:`applicant/json`

请求内容:

```json
{
  "project": "laravel", //required 项目名称
  "line": "20", //required 异常发生的行
  "file": "/var/www/index.php",//required 异常所在的文件 
  "code": 404,
  "message": "无法识别的标点符号",//optional
  "html": "异常的明细页面的html,这个html内容会传到oss上",//optional
  "exception_class": "发生异常的完整类名",//optional
  "header": "发生异常的请求的请求头",//optional
  "cookie": "发生异常的请求的cookie",//optional
  "session": "发生异常的请求的session",//optional
  "server": "发生异常的请求的server变量",//optional
  "request_url": "发生异常请求的url地址",//optional
  "method": "发生异常的请求的请求方法,get/post等",//optional
  "params": "发生异常的请求的参数，这里必须是字符串，所以要么json，要么其他格式",//optional
  "ip": "发生异常的请求的客户端IP地址"//optional
}
```

####普通日志

请求方式:`POST`

请求路径:`/log/common`

请求类型:`applicant/json`

请求内容:

```json
{
	"project":"laravel",//required 项目名称
	"log":[{//异常信息 支持一次记录多条日志
		"level":"info", //required 日志等级
		"message":"日志",//required 日志信息
		"context":[]//optional 日志上下文 必须是一个数组，否则不会记录
	},{
		"level":"error",
		"message":"错误日志"
	}]
}
```



#### 请求日志

请求方式:`POST`

请求路径:`/log/request`

请求类型:`applicant/json`

请求内容:

```json
{
  "project": "项目名",//required
  "url": "请求地址",//required
  "method": "请求方式",//required
  "params": "请求参数",//optional
  "header": "请求头",//optional
  "cookie": "请求的cookie",//optional
  "session" :"请求的SESSION",//optional
  "server": "SERVER变量，环境变量等",//optional
  "ip": "IP地址",//optional
  "response": "响应参数",//optional
  "exectime": "123.56",//optional
  "memory": "123",//optional
  "xhprof": ""//optional  性能分析结果，应该是一个html的字符串
}
```


#### SQL日志

请求方式:`POST`

请求路径:`/log/sql`

请求类型:`applicant/json`

请求内容:

```json
{
    "project": "项目名",//required
    "url": "请求地址",//optional
    "method": "请求方式",//optional
    "params": "请求参数",//optional
    "header": "请求头",//optional
    "cookie": "请求的cookie",//optional
    "session" :"请求的SESSION",//optional
    "server": "SERVER变量，环境变量等",//optional
    "ip": "IP地址",//optional
    "sql_string":"执行的sql",//required
    "exectime": "123.56"//required
}
```



#### 计划任务执行日志

请求方式:`POST`

请求路径:`/log/crontab`

请求类型:`applicant/json`

请求内容:

```json
{
    "project": "项目名",//required
	"starttime":"2019-01-01 10:10:10",//required//required 开始时间
	"endtime":"2019-01-01 10:10:10",//required 结束时间
	"command":"php artisan ok",//required  任务的命令
    "exectime": "123.56"//required  任务执行时间
}
```

