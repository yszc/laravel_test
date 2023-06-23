# Laravel example project

## API Domain

    https://laravel-example.0x0f.tech

API example：[https://laravel-example.0x0f.tech/api/health_check](https://laravel-example.0x0f.tech/api/health_check)

## API rule and structure

Correct reponse

code=200，message=ok

    {
        "code": 200,
        "message": "ok",
        "data": {
            "health": "good"
        }
    }

Incorrect response

code!=200，the `trace` will display in code 500s and controled by `APP_DEBUG`

    // internal error
    {
        "code": 500,
        "message": "exception message",
        "data": null,
        "trace": [
            
        ]
    }

    // invalid input
    {
        "code": 400,
        "message": "The s field is required.",
        "data": null
    }
## API List

### Health check

Always return a correct response, check if the service can respond normally.(Q2)

    GET /api/health_check       

### API for test exception

a response example when throw a exception.(Q3)

    GET /api/test_exception    

#### Test case

    curl --location 'https://laravel-example.0x0f.tech/api/test_exception'

### API for test error

a response while a runtime error occur.(Q3)

    GET /api/test_error         

#### Test case

    curl --location 'https://laravel-example.0x0f.tech/api/test_error'
### Get API

A get API, response all data that sent by request.(Q5.a)

    GET /api/test_get        

#### Test case

    curl --location 'https://laravel-example.0x0f.tech/api/test_get?aaa=bbb&cc=dd'

### Post API

A post API, response all data that sent by request.(Q5.b)

    POST /api/test_post         

#### Test case
    curl --location 'https://laravel-example.0x0f.tech/api/test_post' \
    --form 'a="b"' \
    --form 'c="d"'

### Check brackets

check if the brackets are closed.(Q6)

    GET /api/check_brackets     


| Params | Comment |
|------------- |-------------|
| s | A string of brackets, length is less than 10000 |

#### Test case

    curl --location --globoff 'https://laravel-example.0x0f.tech/api/check_brackets?s=]'
    # false
    curl --location --globoff 'https://laravel-example.0x0f.tech/api/check_brackets?s={[]()}'
    # true
    curl --location --globoff 'https://laravel-example.0x0f.tech/api/check_brackets?s={//}'
    # invalid input

## PHPMyAdmin

[https://pma.0x0f.tech](https://pma.0x0f.tech)

    username: laravel
    password: laravel666

### Table map

Table                  | Comment
-----------------------|-----------------------------
debug_logs_yyyy_mm_dd  | debug log, archived by date（Q3）
request_logs           | request log（Q4）
