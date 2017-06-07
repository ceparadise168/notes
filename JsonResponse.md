{"messages":[{},{},{},{},{}],"maxPages":3,"thisPage":1}

https://symfony.com/doc/current/controller.html#json-helper
json helper json_encode  JsonResponse 出來的都長上面那樣


```
  16 use Symfony\Component\Serializer\SerializerInterface;~
  17 use Symfony\Component\Serializer\Serializer;~
  18 use Symfony\Component\Serializer\Encoder\XmlEncoder;~
  19 use Symfony\Component\Serializer\Encoder\JsonEncoder;~
  20 use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
```

```
| 37     /**~
| 38      * get message list and setting page~
| 39      * index~
| 40      * @Route("/{page}", name="list", requirements={"page": "\d+"})~
| 41      */~
| 42     public function indexAction($page =1)~
| 43     {~
- 44         $em = $this->getDoctrine()->getManager();~
2 45 ~
2 46         $messages = $em->getRepository('AppBundle:Message');~
2 47 ~
2 48         $thisPage = $page;~
2 49         $limit = 5;~
2 50         $offset = $limit * ($page-1);~
2 51         $maxPages = ceil(count($messages->findAll()) / $limit);~
2 52 ~
2 53         $qb = $messages->createQueryBuilder('m')~
- 54             ->orderBy('m.updatedAt', 'DESC')~
3 55             ->setFirstResult($limit * ($page -1))~
3 56             ->setMaxResults($limit);~
2 57 ~
2 58         $query = $qb->getQuery();~
2 59 ~
2 60         $result = $query->getResult();~
2 61 ~
2 62         $messages = $result;~
2 63 ~
2 64         $renderArray = [~
- 65             'messages' => $messages,~
3 66             'maxPages' => $maxPages,~
3 67             'thisPage' => $thisPage~
- 68                 ];~
2 69 ~
2 70         $encoders = array(new XmlEncoder(), new JsonEncoder());~
2 71         $normalizers = array(new ObjectNormalizer());~
2 72 ~
2 73         $serializer = new Serializer($normalizers, $encoders);~
2 74 ~
- 75             $json = $serializer->serialize($renderArray,'json');~
2 76 ~
2 77         //        $response = new Response(json_encode($renderArray));~
2 78         //        $response->headers->set('Content-Type', 'application/json');~
2 79         if (isset($messages)) {~
- 80                           return new Response($json);~
3 81             //               return new JsonResponse($renderArray);~
3 82             //                return $response;~
2 83            // return $this->json($renderArray);~
- 84             //        return $this->render('index.html.twig', $renderArray);~
2 85         } else {~
- 86             return new Response('QwQ something worng with messages');~
2 87         }~
| 88     }~

```

{"messages":[{"updatedAt":"2017-05-31 08:14:03","publishedAt":"2017-05-24 09:46:44","id":37,"userName":"test","msg":"sadsadd","url":null},{"updatedAt":"2017-05-31 08:13:18","publishedAt":"2017-05-25 17:01:14","id":52,"userName":"new_asdad","msg":"new_adsada","url":null},{"updatedAt":"2017-05-26 16:35:04","publishedAt":"2017-05-26 16:35:04","id":68,"userName":"hi","msg":"yo","url":null},{"updatedAt":"2017-05-26 15:45:25","publishedAt":"2017-05-25 17:01:10","id":51,"userName":"asd","msg":"asdgggg","url":null},{"updatedAt":"2017-05-26 15:28:01","publishedAt":"2017-05-26 15:28:01","id":64,"userName":"dsfd","msg":"sdfs","url":null}],"maxPages":3,"thisPage":1}

{
    "messages": [
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
        }, 
        {
            "updatedAt": "2017-05-26 15:45:25", 
            "publishedAt": "2017-05-25 17:01:10", 
            "id": 51, 
            "userName": "asd", 
            "msg": "asdgggg", 
            "url": null
        }, 
        {
            "updatedAt": "2017-05-26 15:28:01", 
            "publishedAt": "2017-05-26 15:28:01", 
            "id": 64, 
            "userName": "dsfd", 
            "msg": "sdfs", 
            "url": null
        }
    ], 
    "maxPages": 3, 
    "thisPage": 1
}

ref:
https://symfony.com/doc/current/components/serializer.html

https://symfony.com/doc/current/components/serializer.html#component-serializer-attributes-groups-annotations

https://symfony.com/doc/current/serializer.html

http://php.net/manual/en/function.serialize.php

執行phpunit 的時候出錯
1) AppBundle\Entity\DefaultControllerTest::testIndex
Symfony\Component\Config\Exception\FileLoaderLoadException: A "tags" entry must be an array for service "get_set_method_normalizer" in /home/eric_tu/eric_tu/app/config/services.yml. Check your YAML syntax in /home/eric_tu/eric_tu/app/config/services.yml (which is being imported from "/home/eric_tu/eric_tu/app/config/config.yml").

render view 
回傳的時候都是網頁內容

要正常測試要使用
response json 
這樣回傳的就會是json array

前端去吃json array 
render 前端 再去吃json 

Q.但是同一個controller render 能再做 response嗎 ?

分開來再開一個新的router 專門render view 另一個專門出json

但這樣要如何test render 出來的 view ?


70         $encoders = array(new XmlEncoder(), new JsonEncoder());~
2 71         $normalizers = array(new ObjectNormalizer());~
2 72 ~
2 73         $serializer = new Serializer($normalizers, $encoders);~
2 74 ~
2 75         $json = $serializer->serialize($renderArray,'json');~
