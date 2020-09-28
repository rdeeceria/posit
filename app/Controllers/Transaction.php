<?php namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Transaction extends BaseController
{
  public function index()
  { 
    $data = [
      'list' => $this->M_Transaction->getTransaction(),
      'validation' => $this->validation,
      'import' => '/transaction/import',
      'export' => '/transaction/export',
      'create' => '/transaction/create',
      'update' => '/transaction/update/',
      'delete' => '/transaction/delete/',
    ];
    echo view('transaction/list', $data);
  }

  public function create()
  {
    if($this->request->getMethod() === 'get') 
    {
      $products = array('' => 'Choose Product') + array_column($this->M_Product->getStatus(1), 'product_name', 'product_id');
      $data = [
        'validation' => $this->validation,
        'products' => $products,
        'action' => '/transaction/create',
        'back' => '/transaction',
      ];
      echo view('transaction/create', $data);
    }
    else
    {
      $rules = $this->M_Transaction->validationRules();

      if(! $this->validate($rules)) {
        return redirect()->back()->withInput();
      }
      $product_id = $this->request->getPost('product_id');
      $qty = $this->request->getPost('trx_qty');

      $product = $this->M_Product->getProduct($product_id);
      $data = [
        'product_id' => $product_id,
        'trx_qty' => $qty,
        'trx_price' => $product['product_price'] * $qty,
        'trx_date' => $this->request->getPost('trx_date'),
      ];
      $post = $this->M_Transaction->postTransaction($data);
      
      if($post) {
        $this->session->setFlashdata('success', 'Create Transaction '.$data['trx_date'].' Successfully');
        return redirect()->back();
      }
    }
  }

  public function update($id)
  {
    if($this->request->getMethod() === 'get') 
    {
      $products = array('' => 'Choose Product') + array_column($this->M_Product->getStatus(1), 'product_name', 'product_id');
      $data = [
        'validation' => $this->validation,
        'products' => $products,
        'action' => '/transaction/update/'.$id,
        'back' => '/transaction',
        'v' => $this->M_Transaction->getTransaction($id),
      ];
      echo view('transaction/update', $data);
    }
    else
    {
      $rules = $this->M_Transaction->validationRules();

      if(! $this->validate($rules)) {
        return redirect()->back()->withInput();
      }
      $product_id = $this->request->getPost('product_id');
      $qty = $this->request->getPost('trx_qty');

      $product = $this->M_Product->getProduct($product_id);
      $data = [
        'product_id' => $product_id,
        'trx_qty' => $qty,
        'trx_price' => $product['product_price'] * $qty,
        'trx_date' => $this->request->getPost('trx_date'),
      ];
      $put = $this->M_Transaction->putTransaction($id, $data);
      
      if($put) {
        $this->session->setFlashdata('info', 'Update Transaction '.$data['trx_date'].' Successfully');
        return redirect()->back();
      }
    }
  }
    
  public function delete($id)
  {
    $delete = $this->M_Transaction->deleteTransaction($id);
    
    if($delete) {
      $this->session->setFlashdata('warning', 'Delete Transactions Successfully');
      return redirect()->route('transaction'); 
    }
  }

  public function import()
  { 
    if($this->request->getMethod() === 'get') 
    {
      $data = [
        'validation' => $this->validation,
        'action' => '/transaction/import',
        'back' => '/transaction',
      ];
      echo view('transaction/import', $data);
    }
    else
    {
      $rules = $this->M_Transaction->validationImport();
      
      if(! $this->validate($rules)) {
        return redirect()->back()->withInput();
      }

      $file = $this->request->getFile('trx_file');
      $filename = $file->getName();
      $extension = $file->getClientExtension();

      if('xlsx' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
      } 
      else
      {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
      }

      $spreadsheet = $reader->load($file);
      $sheet = $spreadsheet->getActiveSheet()->toArray();
      
      foreach($sheet as $k => $v) {
        
        if($k == 0) continue;
        $product = $this->M_Product->getProductSKU($v[0]);

        $value[] = array(
          'product_id' => $product['product_id'],
          'product_name' => $product['product_name'],
          'trx_qty' => $v[1],
          'trx_price' => $product['product_price'] * $v[1],
          'trx_date' => date('d-m-Y', strtotime($v[2])),
        );
      }

      $data = [
        'list' => $value,
        'filename' => $filename,
        'action' => '/transaction/upload',
        'back' => '/transaction/import',
      ];
      echo view('transaction/upload', $data);

    }
  }

  public function upload()
  {
    if($this->request->getMethod() === 'get') 
    {
      return redirect()->route('transaction');
    }
    else
    {
      $batch = $this->request->getPost();
      $data = $this->transposeData($batch);

      foreach($data as $v) {
        $value = [
          'product_id' => $v['product_id'],
          'trx_qty' => (int)$v['trx_qty'],
          'trx_date' => date('Y-m-d', strtotime($v['trx_date'])),
          'trx_price' => (int)$v['trx_price'],
        ];
        $simpan = $this->M_Transaction->postTransaction(array('trx_id' => uniqid()) + $value);
      }
      
      if($simpan) {
        $this->session->setFlashdata('success', 'Import Successfully');
        return redirect()->route('transaction');
      }
    }
  }

  function export()
  {
    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A1', 'No')
    ->setCellValue('B1', 'Product')
    ->setCellValue('C1', 'QTY')
    ->setCellValue('D1', 'Date')
    ->setCellValue('E1', 'Price');

    $kolom = 2;
    $nomor = 1;
    $transactions = $this->M_Transaction->getTransaction();

    foreach($transactions as $data) {
      $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A' . $kolom, $nomor)
      ->setCellValue('B' . $kolom, $data['product_name'])
      ->setCellValue('C' . $kolom, $data['trx_qty'])
      ->setCellValue('D' . $kolom, date('j F Y', strtotime($data['trx_date'])))
      ->setCellValue('E' . $kolom, "Rp. ".number_format($data['trx_price']));

      $kolom++;
      $nomor++;
    }
    $this->download($spreadsheet);
  }

  function download($sheet)
  {
    $writer = new Xlsx($sheet);

    $segment = $this->request->uri->getSegment(2);
    $filename = $segment.'.xlsx';
  
    $this->response
    ->setHeader('Content-Type', 'application/vnd.ms-excel')
    ->setHeader('Content-Disposition', 'attachment;filename="'.$filename.'"')
    ->setHeader('Cache-Control', 'no-cache');

    $writer->save('php://output');
  }

  function transposeData($data)
  {
    $retData = array();

    foreach ($data as $row => $columns) {
      foreach ($columns as $row2 => $column2) {
        $retData[$row2][$row] = $column2;
      }
    }
    return $retData;
  }

}
