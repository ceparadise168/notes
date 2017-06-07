   <?php
    /**
     * index
     * @Route("/api/list", name="apiList")
     * @Method("GET")
     */
    public function indexActionAPI( $page = 2)
    {
        $currentPage = 1;
        // $page = 1;

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

        $renderArray = ['messages' => $messages, 'maxPages' => $maxPages, 'thisPage' => $thisPage];

        //    $result = json_encode($query, true);

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $json = $serializer->serialize($messages, 'json');


        $response = new Response($json);

        $response->headers->set('Access-Control-Allow-Origin','*');

        return $response;

    }

    /**
     * Add New Message
     * @Route("api/add", name="apiAdd")
     * @Method("POST")
     */
    public function createActioniAPI(Request $request)
    {
        $message = new Message();
        /*
           $message = $request->get('data');
           $name = $message["userName"];
           $msg = $message["msg"];
         */
        $content = $request->getContent();


        $data = json_decode($content, true);

        $u = $data['userName'];
        $m = $data['msg'];



  //      $name = "testName";
  //      $msg = "testMessage";
        $publishAt = new \DateTime('now', new \DateTimeZone('Asia/Taipei'));

        $message = new Message();

        $message->setUserName($u);

        $message->setMsg($m);

        $message->setPublishedAt($publishAt);

        $response = new Response();

        //      $response->setContent($request);
/*
        $content = $request->getContent();


        $data = json_decode($content, true);

        $u = $data['userName'];
        $m = $data['msg'];
*/
   //     $j = json_decode('{"indices":[1,2,6]}', true);

        $response->setContent("content-type: " . gettype($content) . "   \$content: " .$content . " userName  " . $u);
        $response->headers->set('Content-Type', 'application/json');

        $response->headers->set('Access-Control-Allow-Origin', '*');

        $em = $this->getDoctrine()->getManager();

        $em->persist($message);

        $em->flush();

        $redirectArray = ['id' => $message->getId()];

        $filename = "/home/eric_tu/eric_tu/request.log";
        $file = fopen( $filename, "w" );

        if( $file == false ) {
            echo ( "Error in opening new file" );
            exit();
        }
        fwrite( $file, "This is  a simple test\n" . $content . $response . $request);
        fclose( $file );

       // $re = ['hi' => '123'];

       // $j = $re['hi'];


        //    dump($j['indices'][0]);
      //   dump($request);
        return $response;


        //      return $this->redirectToRoute('list', $redirectArray);
    }


    /**
     * Update the Message
     * @Route("api/edit/{id}", name="apiEdit")
     * @Method({"GET", "POST"})
     */
    public function updateActionAPI(Request $request, Message $message)
    {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository('AppBundle:Message');

        $message = $messages->find('186');
        $content = $request->getContent();
/*
        $data = json_decode($content, true);

        $id = $data['id'];
        $u = $data['userName'];
        $m = $data['msg'];

        $message->setUserName("editutest");

        $message->setMsg("editmtest");

        $message->setupdatedAt(new \DateTime('now', new \DateTimeZone('Asia/Taipei')));

*/

        $response = new Response();

      //  $response->setContent("content-type: " . gettype($content) . "   \$content: " .$content . " userName  " . $u);

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

 //       $json = $serializer->serialize($message, 'json');




        $response->setContent("hello");

        $response->headers->set('Content-Type', 'application/json');

        $response->headers->set('Access-Control-Allow-Origin', '*');


//        $em->flush();

      //  $redirectArray = ['id' => $message->getId()];

  //       dump($message , gettype($message), $json, $id,$u,$m);

        return $response;



        
/*
        if ($message) {
            $message->setupdatedAt(new \DateTime('now', new \DateTimeZone('Asia/Taipei')));
            $em->flush();

            $redirectArray = ['id' => $message->getId()];

            return $this->redirectToRoute('update', $redirectArray);
        }

        $renderArray = ['message' => $message,
            'edit_form' => $updateForm->createView(),
            'delete_form' => $deleteForm->createView()];

        return $this->render('edit.html.twig', $renderArray);
*/
    }

}