
```html
<script>
    var Submit = function () {
        var data = {
            userName: "testEdit",
            msg: "testEdit"
        }
        $.ajax({
            url: 'http://test123/api/edit/167',
            type: "PUT",
            data: data,
            success: function (msg) {
                // alert(msg);
                console.log(msg)
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }
</script>
```
```php
    /**
     * Get a request and edit the Message
     * @Route("api/edit/{id}", name="api/edit")
     * @Method("PUT")
     */
    public function editActionAPI(Request $request, $id)
    {
        $paramMsg = $request->request->get('msg');
        $paramName = $request->request->get('userName');
        $em = $this->getDoctrine()->getManager();
        $messages = $em->getRepository('AppBundle:Message');
        $message = $messages->find($id);
        dump($message);
        if ($message && $paramMsg !== null && $paramName !== null) {
            $message->setUserName($paramName);
            $message->setMsg($paramMsg);
            $message->setupdatedAt(new \DateTime('now', new \DateTimeZone('Asia/Taipei')));

            $encodersArray = [
                new XmlEncoder(),
                new JsonEncoder()
            ];
            $normalizersArray = [new ObjectNormalizer()];
            $encoders = $encodersArray;
            $normalizers = $normalizersArray;
            $serializer = new Serializer($normalizers, $encoders);
            $json = $serializer->serialize($message, 'json');
            $dejson = json_decode($json, true);
            $json = $serializer->serialize($dejson, 'json');

            $response = new Response();
            $response->setContent($json);
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');

            $em->flush();
            dump($json);
            return $response;
        } else {
            return new Response("GG");
        }
    }
```

```php
    /**
     * @group ee
     * It tests editActionAPI by creating a client
     * then request to the controller and check following assertions with the response.
     * 1.assert the statusCode is 200.
     * 2.assert the id requested by the client was not found in the conreollwe when get a response "GG".
     * 3.assert the userName in the request parameter including a random number is equal to the number in the response.
     */
    public function testEditActionAPI()
    {
        $postData = [
            'userName' => 'testEdit'. mt_rand(),
            'msg' => 'testEdit'
        ];
        $json = json_encode($postData);
        $id = 167;
        $path = 'api/edit/' .  $id;
        $uploadFileArray = [];
        $contentTypeArray = ['CONTENT_TYPE' => 'application/json'];

        $client = static::createClient();
        $crawler = $client->request(
                'PUT',
                $path,
                $postData,
                $uploadFileArray,
                $contentTypeArray
        );
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $content = $client->getResponse()->getcontent();

        if ($content == "GG") {
            $this->assertNotEquals($id, (string)$content);
            dump($content);
        } else {
            $this->assertContains($postData['userName'], (string)$content);
            dump($content);
        }
    }
```