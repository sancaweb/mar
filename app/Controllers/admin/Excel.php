<?php
namespace Controllers\admin;
use Resources, Libraries, Models;

class Excel extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->home = new Models\Home; 
		$this->request=new Resources\Request;
		$this->upload=new Resources\Upload;
		$this->user=new Models\User;
		$this->voucher=new Models\Voucher;
		$this->rekanan=new Models\Rekanan;
		$this->randomstring = new Libraries\Randomstring;
		Resources\Import::composer();
    }
	
	public function index($page=1)
    {
		$objPHPExcel = new \PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
        							 ->setLastModifiedBy("Maarten Balliauw")
        							 ->setTitle("Office 2007 XLSX Test Document")
        							 ->setSubject("Office 2007 XLSX Test Document")
        							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        							 ->setKeywords("office 2007 openxml php")
        							 ->setCategory("Test result file");


        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Hello')
                    ->setCellValue('B2', 'world!')
                    ->setCellValue('C1', 'Hello')
                    ->setCellValue('D2', 'world!');

        // Miscellaneous glyphs, UTF-8
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A4', 'judulnya')
                    ->setCellValue('A5', 'sanca');

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="user.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
		
    }
	
	public function penerima_voucher()
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2 || $this->session->getValue('user_level')==3){
		$objPHPExcel = new \PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
        							 ->setLastModifiedBy("Maarten Balliauw")
        							 ->setTitle("Office 2007 XLSX Test Document")
        							 ->setSubject("Office 2007 XLSX Test Document")
        							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        							 ->setKeywords("office 2007 openxml php")
        							 ->setCategory("Test result file");


        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Nama Rekanan')
                    ->setCellValue('C1', 'Nama Penerima Voucher')
                    ->setCellValue('D1', 'No Vuocher')
                    ->setCellValue('E1', 'No Telpon')
                    ->setCellValue('F1', 'Email')
                    ->setCellValue('G1', 'Username')
                    ->setCellValue('H1', 'Tanggal Terima');

		if($_POST){
			$dari_tgl=$this->request->post('dari_tgl');
			$ke_tgl=$this->request->post('ke_tgl');
			
			
			if($this->session->getValue('user_level')==3){
				$user_id=$this->session->getValue('user_id');
				$id_rekanan=$this->rekanan->view_id_rekanan($user_id)->id_rekanan;
				$penerima_voucher=$this->voucher->view_penerima_by_date_id_rekanan($dari_tgl,$ke_tgl,$id_rekanan);
				
				
				$namaFile=$this->randomstring->randomstring(5).'-'.$id_rekanan.'.xlsx';
			
			}else{
				$penerima_voucher=$this->voucher->view_penerima_by_date($dari_tgl,$ke_tgl);
				
				$namaFile=$this->randomstring->randomstring(5).'-Admin.xlsx';
			}
		
		}else{
			if($this->session->getValue('user_level')==3){
				$user_id=$this->session->getValue('user_id');
				$id_rekanan=$this->rekanan->view_id_rekanan($user_id)->id_rekanan;
				$penerima_voucher=$this->voucher->view_penerima_voucher_by_id_rekanan_nopage($id_rekanan);
								
				$namaFile=$this->randomstring->randomstring(5).'-all_Data-'.$id_rekanan.'.xlsx';
			
			}else{
				$penerima_voucher=$this->voucher->viewall_penerima();;
				
				$namaFile=$this->randomstring->randomstring(5).'-all_Data-Admin.xlsx';
			}
			
			
			
			
		}
        //Miscellaneous glyphs, UTF-8
		
		
        $objPHPExcel->setActiveSheetIndex(0);
			//(k,b) = (kolom,baris)
			$no=1;
			$k=0;
			$b=2;
			foreach($penerima_voucher as $data){
				$nama_rekanan=$this->rekanan->view_nama_rekanan_by_id($data->id_rekanan)->nama_rekanan;
				$no_voucher=$this->voucher->view_no_voucher($data->id_voucher)->no_voucher;
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k,$b,$no);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+1,$b,$nama_rekanan);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+2,$b,$data->nama_penerima);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+3,$b,$no_voucher);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+4,$b,$data->no_tlp);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+5,$b,$data->email);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+6,$b,$data->alamat);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+7,$b,$data->tgl_terima);
				
				$no++;
				$b++;
			}
                    

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Penerima Voucher');
		
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$namaFile.'"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
		
		}else{
			$this->redirect('login');
		}
		
    }
	
	public function tes_excel(){
		$this->excel->WriteXls();
	}
	
	
	
}
