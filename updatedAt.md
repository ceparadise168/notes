直接在entity的 getUpdateAt()中寫入最新的時間
這樣每次呼叫get都會刷新時間
但是實際上到index時，再產生list的過程會對每一筆資料做get
所以不管有沒有更新過，所有資料的更新時間都會被更新成一樣的當時時間。

改為在controller做，
先弄清楚關西

在entity中
__construct 被用來目前時間 ，這個參數為建構子通常拿類做事前的準備工作，

setUpdatedAt 會先取得 __construct 中的時間， 回傳到 Message 中，
getUpdatedAt 會從 Message 中取得 set好的時間 ， 回傳string

PublishedAt 只在 CreateAction 時做一次 set ，往後只會透過 get 來取得這筆時間

updatedAt 會在CreateAction 時做一次set(也可以不做) ， 在 editAction 時也會再做一次， 之後也是透過get取得


```
95     public function updateAction(Request $request, Message $message)~
| 96     {~
- 98         $em = $this->getDoctrine()->getManager();~
2 99 ~
2100         $deleteForm = $this->createDeleteForm($message);~
2101         $updateForm = $this->createForm('AppBundle\Form\MessageType', $message);~
2102         $updateForm->handleRequest($request);~
2103 ~
2104         if ($updateForm->isSubmitted() && $updateForm->isValid()) {~
-107            $message->setupdatedAt(new \DateTime('now', new \DateTimeZone('Asia/Taipei')));~
2108            $em->flush();~
 109 //~
-110             $redirectArray = ['id' => $message->getId()];~
3111 ~
3112             return $this->redirectToRoute('update', $redirectArray);~
2113         }~
2114 ~
2115         $renderArray = ['message' => $message,~
-116                         'edit_form' => $updateForm->createView(),~
6117                         'delete_form' => $deleteForm->createView()];~
2118 ~
2119         return $this->render('edit.html.twig', $renderArray);~
|120     }~
```