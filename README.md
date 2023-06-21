# Laravel 示例项目

## 部署域名

    https://laravel-example.0x0f.tech

API示例：[https://laravel-example.0x0f.tech/api/health_check](https://laravel-example.0x0f.tech/api/health_check)

## API规范和结构

正确响应结构

code=200，message=ok

    {
        "code": 200,
        "message": "ok",
        "data": {
            "health": "good"
        }
    }

异常响应结构

code!=200，其中 trace字段在500s类错误时根据`APP_DEBUG`控制是否展示

    // 内部错误类
    {
        "code": 500,
        "message": "exception message",
        "data": null,
        "trace": [
            
        ]
    }
    // 输入错误类
    {
        "code": 400,
        "message": "The s field is required.",
        "data": null
    }
## API测试清单

```
    GET /api/health_check       #健康检查           Q2
    GET /api/test_exception     #测试异常           Q3
    GET /api/test_error         #测试运行错误        Q3

    GET /api/test_get           #get请求，返回请求体  Q5.a
    POST /api/test_post         #post请求，返回请求体 Q5.b
    GET /api/check_brackets     #检查括号是否闭合     Q6
```

## PHPMyAdmin

[https://pma.0x0f.tech](https://pma.0x0f.tech)

    user: laravel
    password: laravel666

### 表说明

    debug_logs_yyyy_mm_dd  #为debug日志表，按日期归档（Q3）
    request_logs           #为请求记录表（Q4）

