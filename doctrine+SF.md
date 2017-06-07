https://laravel.io/forum/09-17-2016-sqlstate42s02-base-table-or-view-not-found-1146-table
Schema::table is to modify an existing table, use Schema::create to create new. ;)

bin/console doctrine:cache:clear-metadata 
bin/console doctrine:cache:clear-query  
bin/console doctrine:cache:clear-result 


php bin/console cache:clear --env=prod

or 

php bin/console cache:clear -e prod


[2017-05-23 07:26:30] 
request.CRITICAL:

 Uncaught PHP Exception ErrorException:
 
  "Catchable Fatal Error: Argument 2 passed to Symfony\Bundle\FrameworkBundle\Controller\Controller::redirectToRoute() must be of the type array,

   null given, called in /home/eric_tu/eric_tu/src/AppBundle/Controller/DefaultController.php on line 104 and defined" at /home/eric_tu/eric_tu/vendor/symfony/symfony/src/Symfony/Bundle/FrameworkBundle/Controller/Controller.php line 100 {"exception":"[object] (ErrorException(code: 0): Catchable Fatal Error: Argument 2 passed to Symfony\\Bundle\\FrameworkBundle\\Controller\\Controller::redirectToRoute() must be of the type array, null given, called in /home/eric_tu/eric_tu/src/AppBundle/Controller/DefaultController.php on line 104 and defined at /home/eric_tu/eric_tu/vendor/symfony/symfony/src/Symfony/Bundle/FrameworkBundle/Controller/Controller.php:100)"} []



3 21             <td>~
- 22                 <ul>~
- 23                     <li>~
- 24                         <a href="{{ path('show', { 'id': message.id}) }}">show</a>~                                            
5 25                     </li>~
5 26                     <li>~
- 27                         <a href="{{ path('update', { 'id': message.id}) }}">edit</a>~
4 28                 </ul>~
3 29             </td>~


$deleteForm = $this->createDeleteForm($message);

$deleteForm = $this->createDeleteForm($message);


$renderArray = ['message' => $message,~
                         'edit_form' => $updateForm->createView(),~
                         'delete_form' => $deleteForm->createView()];

return $this->render('edit.html.twig', $renderArray);~






|121     public function deleteAction(Request $request, Message $message)~
|122     {~
-123         $form = $this->createDeleteForm($message);~
2124         $form->handleRequest($request);~
2125 ~
2126         if($form->isSubmitted() && $form->isValid()) {~
-127             $em = $this->getDoctrine()->getManager();~
3128 ~
3129             $em->remove($message);~
3130 ~
3131             $em->flush();~
2132         }~
2133         return $this->redirectToRoute('list');~
|134     }~
