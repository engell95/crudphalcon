<?php
use Phalcon\Http\Response;  

class IndexController extends \Phalcon\Mvc\Controller
{

    // List Products
    public function indexAction()
    {
        $this->view->items = Products::find();
    }

    //store app
    public function StoreAction()
    {
        $response = new Response();  
        $Products = new Products();

        // Store and check for errors
        $success = $Products->save(
            $this->request->getPost(),
            ['@InpDescription', '@OptType','@InpPrice','@InptStatus']
        );

        if ($success) {
            $message = "Thanks for registering!";
        } else {
            foreach ($Products->getMessages() as $error) {
                $errors .= " <li> ".$error->getMessage()." </li>";
            }

            $message = "Sorry, the following problems were generated:" . $errors;
        }
  
        $response->setStatusCode(200 , 'ok');
        $response->setJsonContent(
            [
                'status' => $success,
                'message' => $message,
                'data' => []
            ]
        ); 

        return $response;

    }
  
    //edit app
    public function EditAction()
    {
        $response = new Response();  
        $Products = new Products();

        // Store and check for errors
        $success = $Products->save(
            $this->request->getPost(),
            ['@InpDescription', '@OptType','@InpPrice','@InptStatus']
        );

        if ($success) {
            $message = "Thanks for registering!";
        } else {
            foreach ($Products->getMessages() as $error) {
                $errors .= " <li> ".$error->getMessage()." </li>";
            }

            $message = "Sorry, the following problems were generated:" . $errors;
        }
  
        $response->setStatusCode(200 , 'ok');
        $response->setJsonContent(
            [
                'status' => $success,
                'message' => $message,
                'data' => []
            ]
        ); 

        return $response;

    }

}