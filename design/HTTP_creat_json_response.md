http://symfony.com/doc/current/components/http_foundation.html

```
use Symfony\Component\HttpFoundation\Response;

$response = new Response();
$response->setContent(json_encode(array(
    'data' => 123,
)));
$response->headers->set('Content-Type', 'application/json');
```

There is also a helpful JsonResponse class, which can make this even easier:

```
use Symfony\Component\HttpFoundation\JsonResponse;

// if you know the data to send when creating the response
$response = new JsonResponse(array('data' => 123));

// if you don't know the data to send when creating the response
$response = new JsonResponse();
// ...
$response->setData(array('data' => 123));

// if the data to send is already encoded in JSON
$response = JsonResponse::fromJsonString('{ "data": 123 }');

use Symfony\Component\HttpFoundation\Response;

$response = new Response();
$response->setContent(json_encode(array(
    'data' => 123,
)));
$response->headers->set('Content-Type', 'application/json');
```


```
static fromJsonString($data = null, $status = 200, $headers = array())

Make easier the creation of JsonResponse from raw json.

Parameters

$data	
$status	
$headers
```