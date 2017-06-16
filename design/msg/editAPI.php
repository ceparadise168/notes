   /**
     * Update the Message
     * @Route("api/edit/{id}", name="api/edit")
     * @Method("PUT")
     */
    public function updateActionAPI(Request $request, $id)
    {
        $paramMsg = $request->request->get('msg');
        $paramName = $request->request->get('userName');
        $em = $this->getDoctrine()->getManager();
        $messages = $em->getRepository('AppBundle:Message');
        $message = $messages->find($id);
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
            return $response;
        } else {
            return new Response("GG");
        }
/*
        $em = $this->getDoctrine()->getManager();
        $messages = $em->getRepository('AppBundle:Message');
        $message = $messages->find($id);
        $temp  = $message;
        $content = $request->getContent();
        $paramMsg = $request->request->get('msg');
        // dump($paramMsg);
        $paramName = $request->request->get('userName');
        // dump($paramName);
        // $data = json_decode($content, true);
        // $u = $data['userName'];
        // $m = $data['msg'];
        // $message->setUserName($u);
        // $message->setMsg($m);
        $message->setUserName($paramName);
        $message->setMsg($paramMsg);
        $message->setupdatedAt(new \DateTime('now', new \DateTimeZone('Asia/Taipei')));
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($message, 'json');
        $dejson = json_decode($json, true);
        $json = $serializer->serialize($dejson, 'json');
        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $em->flush();
        return $response;
*/
    }