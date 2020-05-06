<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Download_excel extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $this->load->view('excel_import');
  }

  public function data_excel()
  {
    // Create new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    // Set document properties
    $spreadsheet->getProperties()->setCreator('miraimedia.co.th')
      ->setLastModifiedBy('Cholcool')
      ->setTitle('how to export data to excel use phpspreadsheet in codeigniter')
      ->setSubject('Generate Excel use PhpSpreadsheet in CodeIgniter')
      ->setDescription('Export data to Excel Work for me!');
    // add style to the header
    $styleArray = array(
      'font' => array(
        'bold' => true,
      ),
      'alignment' => array(
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ),
      'borders' => array(
        'bottom' => array(
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
          'color' => array('rgb' => '333333'),
        ),
      ),
      'fill' => array(
        'type'       => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
        'rotation'   => 90,
        'startcolor' => array('rgb' => '0d0d0d'),
        'endColor'   => array('rgb' => 'f2f2f2'),
      ),
    );
    $spreadsheet->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArray);
    // auto fit column to content
    foreach (range('A', 'G') as $columnID) {
      $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
    }
    // set the names of header cells
    $sheet->setCellValue('A1', 'Customer ID');
    $sheet->setCellValue('B1', 'Customer Name');
    $sheet->setCellValue('C1', 'Address');
    $sheet->setCellValue('D1', 'City');
    $sheet->setCellValue('E1', 'Postal Code');
    $sheet->setCellValue('F1', 'Country');
    $getdata = $this->db->get('tbl_customer')->result();
    // Add some data
    $x = 2;
    foreach ($getdata as $get) {
      $sheet->setCellValue('A' . $x, $get->CustomerID);
      $sheet->setCellValue('B' . $x, $get->CustomerName);
      $sheet->setCellValue('C' . $x, $get->Address);
      $sheet->setCellValue('D' . $x, $get->City);
      $sheet->setCellValue('E' . $x, $get->PostalCode);
      $sheet->setCellValue('F' . $x, $get->Country);
      $x++;
    }
    //Create file excel.xlsx
    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.ms-excel');
	  header('Content-Disposition: attachment;filename="data_customer.xlsx"');
	  header('Cache-Control: max-age=0');

	  $writer->save('php://output');
    redirect('');
  }
}
