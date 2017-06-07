
I want to sent a message as json to my api/add router,
and get json from the request then store the message.
but i get null in the data:message.

```html
<DOCTYPE>
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>TEST CATCH API</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            var Submit = function() {
                var message = {
                    "userName": 'test',
                    "msg": 'test'
                }

                $.ajax({
                    url: 'http://test123/api/add',
                    data: message,
                    type: "get",
                    dataType: 'json',

                    success: function(data) {
                        // alert(msg);
                        console.log(data)
                    },

                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });

            }
        </script>
    </head>

    <body>
        <form id="sentToBack">
            <input type="text" name="Text" />
            <input type="button" value="送出" onClick="Submit()" />
        </form>
    </body>

    </html>
```

here is my header
```
Request URL:http://test123/api/add?userName=test&msg=test
Request Method:GET
Status Code:404 Not Found
Remote Address:192.168.171.128:80
Referrer Policy:no-referrer-when-downgrade
```

here is my api

```php
<?php

      /**~
      * Add New Message
      * @Route("api/add", name="api/add")
      * @Method("GET")
      */
     public function createActionAPI(Request $request)
     {
      // $temp = $message;
     //  $request = $this->container->get('request');
         $message = $request->get('data');
         $name = $message["userName"];
         $msg = $message["msg"];
 
       //  $name = "testName";
       //  $msg = "testMessage";
         $publishAt = new \DateTime('now', new \DateTimeZone('Asia/Taipei'));
 /*
         $message = new Message();
 
         $message->setUserName($name);
 
         $message->setMsg($msg);
 
         $message->setPublishedAt($publishAt);
*/
         $response = new Response();
 
         $response->setContent($request);
 
         $response->headers->set('Content-Type', 'application/json');
 
         $response->headers->set('Access-Control-Allow-Origin', '*');

 /*~
         $em = $this->getDoctrine()->getManager();~
 ~
         $em->persist($message);~
 ~
         $em->flush();~
 */~
         return $response;~
     }
```

error log
```
  15 [3/3] NotNullConstraintViolationException: An exception occurred while executing 'INSERT INTO MsgBoard (user_name, msg, published_at, updated_at) VALUES (?, ?, ?, ?)' with params [null, null, "2017-06-02 02:01:29", "2017-06-02 02:01:29"]:~
  16 ~
  17 SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'user_name' cannot be null  +~
  18 ~
  19 [2/3] PDOException: SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'user_name' cannot be null  +~
  20 ~
  21 [1/3] PDOException: SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'user_name' cannot be null  +~
  ```


---

the response form my list api and it is working

```php
    /**
     * Get page then redirect list to list/page
     * @Route("page/{page}", name="page")
     * @Method("GET")
     */
    /*
       public function pageAction($page)
       {
       $returnArray = ['page'=>$page ];

       return $this->redirectToRoute('list', $returnArray);
       }
     */

    /**
     * get message list and setting page
     * index
     * @Route("/api/list", name="apiList", requirements={"page": "\d+"})
     */
    public function indexActionAPI($page =1)
    {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository('AppBundle:Message');

        $thisPage = $page;
        $limit = 5;
        $offset = $limit * ($page-1);
        $maxPages = ceil(count($messages->findAll()) / $limit);

        $qb = $messages->createQueryBuilder('m')
            ->orderBy('m.updatedAt', 'DESC')
            ->setFirstResult($limit * ($page -1))
            ->setMaxResults($limit);

        $query = $qb->getQuery();

        $result = $query->getResult();

        $messages = $result;

        $renderArray = [
            'messages' => $messages,
            'maxPages' => $maxPages,
            'thisPage' => $thisPage
                ];

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $json = $serializer->serialize($renderArray,'json');

        $response = new Response();

        $response->setContent($json);

        $response->headers->set('Content-Type', 'application/json');

        $response->headers->set('Access-Control-Allow-Origin', '*');

        if (isset($messages)) {
            //    return new Response($json);
            return $response;
        } else {
            return new Response('QwQ something worng with messages');
        }
    }
```





```html
<DOCTYPE>
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>TEST CATCH API</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            var Submit = function() {                
                $.ajax({
                    url: 'http://test123/api/list',
                    // data: $('#sentToBack').serialize(),
                    type: "GET",
                    dataType: 'text',

                    success: function(msg) {
                        // alert(msg);
                        console.log(msg)
                    },

                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });

            }
        </script>
    </head>

    <body>
        <form id="sentToBack">
            <input type="text" name="Text" />
            <input type="button" value="送出" onClick="Submit()" />
        </form>
    </body>

    </html>
```

```json
{
  "messages": [
    {
      "updatedAt": "2017-06-01 16:23:48",
      "publishedAt": "2017-06-01 16:23:48",
      "id": 73,
      "userName": "ttt",
      "msg": "yyy",
      "url": null
    },
    {
      "updatedAt": "2017-06-01 15:24:16",
      "publishedAt": "2017-06-01 15:24:16",
      "id": 72,
      "userName": "3345678",
      "msg": "3345678",
      "url": null
    },
    {
      "updatedAt": "2017-05-31 08:14:03",
      "publishedAt": "2017-05-24 09:46:44",
      "id": 37,
      "userName": "test",
      "msg": "sadsadd",
      "url": null
    },
    {
      "updatedAt": "2017-05-31 08:13:18",
      "publishedAt": "2017-05-25 17:01:14",
      "id": 52,
      "userName": "new_asdad",
      "msg": "new_adsada",
      "url": null
    },
    {
      "updatedAt": "2017-05-26 16:35:04",
      "publishedAt": "2017-05-26 16:35:04",
      "id": 68,
      "userName": "hi",
      "msg": "yo",
      "url": null
    }
  ],
  "maxPages": 4,
  "thisPage": 1
}
```