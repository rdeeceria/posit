<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
 
class loginSession implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    if(session('id') == null || session('status') == "Inactive") {
      return redirect()->to('/');
    }
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}