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
		$this->pesan=new Models\Pesan;
		$this->readmore = new Libraries\Readmore;
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
			if($penerima_voucher){
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
            }else{
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0,2,'Data Tidak ada');
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
	
	public function pesan($page='')
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


        

		if($_POST){
			$dari_tgl=$this->request->post('dari_tgl');
			$ke_tgl=$this->request->post('ke_tgl');
			$page=$this->request->post('page');
			
			if($page=='inbox'){
				$penerima=$this->session->getValue('user_id');				
				$data_pesan=$this->pesan->view_inbox_by_date($dari_tgl,$ke_tgl,$penerima);
				
				$work_excel=$this->user->view_nama_lengkap($penerima);
				if($work_excel->nama_lengkap != ''){
					$work_excel=$work_excel->nama_lengkap;
				}else{
					$work_excel=$this->user->ambil_username($penerima)->username;
				}
				$worksheet='Data Inbox '.$work_excel;
				
				$namaFile=$this->randomstring->randomstring(5).'-Inbox-'.$work_excel.'.xlsx';
				// Add some data
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A1', 'Data Pesan Inbox :')
							->setCellValue('A2', 'No')
							->setCellValue('B2', 'Pengirim')
							->setCellValue('C2', 'Email Pengirim')
							->setCellValue('D2', 'Subjek')
							->setCellValue('E2', 'Isi Pesan')
							->setCellValue('F2', 'Tgl Terkirim');
							
							
				//Miscellaneous glyphs, UTF-8		
				$objPHPExcel->setActiveSheetIndex(0);
					//(k,b) = (kolom,baris)
					$no=1;
					$k=0;
					$b=3;
					if($data_pesan){
					foreach($data_pesan as $data){
						$pengirim=$data->pengirim;
						$nama_pengirim=$this->user->view_nama_lengkap($pengirim);
						if($nama_pengirim){
							if($nama_pengirim->nama_lengkap != ''){
								$nama_pengirim=$nama_pengirim->nama_lengkap;
							}else{
								$nama_pengirim=$this->user->ambil_username($pengirim)->username;
							}
						}else{
							$nama_pengirim='GUEST';
						}						
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k,$b,$no);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+1,$b,$nama_pengirim);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+2,$b,$data->email);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+3,$b,$data->subjek);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+4,$b,$data->isi_pesan);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+5,$b,$data->tgl_input);
						
						$no++;
						$b++;
					}//end foreach
					}else{
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0,3,'Data Tidak ada');
					}		
							
			}else{
				//page sentitems
				
				$pengirim=$this->session->getValue('user_id');				
				$data_pesan=$this->pesan->view_sent_by_date($dari_tgl,$ke_tgl,$pengirim);
				
				$work_excel=$this->user->view_nama_lengkap($pengirim);
				if($work_excel->nama_lengkap != ''){
					$work_excel=$work_excel->nama_lengkap;
				}else{
					$work_excel=$this->user->ambil_username($pengirim)->username;
				}
				$worksheet='Data Terkirim '.$work_excel;
				
				$namaFile=$this->randomstring->randomstring(5).'-Pesan Terkirim-'.$work_excel.'.xlsx';
				// Add some data
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A1', 'Data Pesan Terkirim :')
							->setCellValue('A2', 'No')
							->setCellValue('B2', 'Penerima')
							->setCellValue('C2', 'Subjek')
							->setCellValue('D2', 'Isi Pesan')
							->setCellValue('E2', 'Tgl Terkirim');
							
							
				//Miscellaneous glyphs, UTF-8		
				$objPHPExcel->setActiveSheetIndex(0);
					//(k,b) = (kolom,baris)
					$no=1;
					$k=0;
					$b=3;
					if($data_pesan){
					foreach($data_pesan as $data){
						$penerima=$data->penerima;
						$nama_penerima=$this->user->view_nama_lengkap($penerima);
						if($nama_penerima){
						if($nama_penerima->nama_lengkap != ''){
							$nama_penerima=$nama_penerima->nama_lengkap;
						}else{
							$nama_penerima=$this->user->ambil_username($pengirim)->username;
						}
						}else{
							$nama_penerima='GUEST';
						}					
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k,$b,$no);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+1,$b,$nama_penerima);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+2,$b,$data->subjek);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+3,$b,$data->isi_pesan);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+4,$b,$data->tgl_input);
						
						$no++;
						$b++;
					}//end foreach
					}else{
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0,3,'Data Tidak ada');
					}
			}
		}else{
			//not POST
			$page=$page;			
			if($page=='inbox'){
				$penerima=$this->session->getValue('user_id');				
				$data_pesan=$this->pesan->viewall_inbox($penerima);
				
				$work_excel=$this->user->view_nama_lengkap($penerima);
				if($work_excel->nama_lengkap != ''){
					$work_excel=$work_excel->nama_lengkap;
				}else{
					$work_excel=$this->user->ambil_username($penerima)->username;
				}
				$worksheet='Data Inbox '.$work_excel;
				
				$namaFile=$this->randomstring->randomstring(5).'-Inbox-'.$work_excel.'.xlsx';
				// Add some data
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A1', 'Data Pesan Inbox :')
							->setCellValue('A2', 'No')
							->setCellValue('B2', 'Pengirim')
							->setCellValue('C2', 'Email Pengirim')
							->setCellValue('D2', 'Subjek')
							->setCellValue('E2', 'Isi Pesan')
							->setCellValue('F2', 'Tgl Terkirim');
							
							
				//Miscellaneous glyphs, UTF-8		
				$objPHPExcel->setActiveSheetIndex(0);
					//(k,b) = (kolom,baris)
					$no=1;
					$k=0;
					$b=3;
					if($data_pesan){
					foreach($data_pesan as $data){
						$pengirim=$data->pengirim;
						$nama_pengirim=$this->user->view_nama_lengkap($pengirim);
						if($nama_pengirim){
						if($nama_pengirim->nama_lengkap != ''){
							$nama_pengirim=$nama_pengirim->nama_lengkap;
						}else{
							$nama_pengirim=$this->user->ambil_username($pengirim)->username;
						}
						}else{
							$nama_pengirim='GUEST';
						}					
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k,$b,$no);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+1,$b,$nama_pengirim);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+2,$b,$data->email);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+3,$b,$data->subjek);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+4,$b,$data->isi_pesan);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+5,$b,$data->tgl_input);
						
						$no++;
						$b++;
					}//end foreach
					}else{
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0,3,'Data Tidak ada');
					}		
							
			}elseif($page=='sentitems'){
				//page sentitems
				
				$pengirim=$this->session->getValue('user_id');				
				$data_pesan=$this->pesan->viewall_sent($pengirim);
				
				$work_excel=$this->user->view_nama_lengkap($pengirim);
				if($work_excel->nama_lengkap != ''){
					$work_excel=$work_excel->nama_lengkap;
				}else{
					$work_excel=$this->user->ambil_username($pengirim)->username;
				}
				$worksheet='Data Terkirim '.$work_excel;
				
				$namaFile=$this->randomstring->randomstring(5).'-Pesan Terkirim-'.$work_excel.'.xlsx';
				// Add some data
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A1', 'Data Pesan Terkirim :')
							->setCellValue('A2', 'No')
							->setCellValue('B2', 'Penerima')
							->setCellValue('C2', 'Subjek')
							->setCellValue('D2', 'Isi Pesan')
							->setCellValue('E2', 'Tgl Terkirim');
							
							
				//Miscellaneous glyphs, UTF-8		
				$objPHPExcel->setActiveSheetIndex(0);
					//(k,b) = (kolom,baris)
					$no=1;
					$k=0;
					$b=3;
					if($data_pesan){
					foreach($data_pesan as $data){
						$penerima=$data->penerima;
						$nama_penerima=$this->user->view_nama_lengkap($penerima);
						if($nama_penerima){
							if($nama_penerima->nama_lengkap != ''){
								$nama_penerima=$nama_penerima->nama_lengkap;
							}else{
								$nama_penerima=$this->user->ambil_username($penerima)->username;
							}
						}else{
							$nama_penerima='GUEST';
						}						
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k,$b,$no);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+1,$b,$nama_penerima);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+2,$b,$data->subjek);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+3,$b,$data->isi_pesan);
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow ($k+4,$b,$data->tgl_input);
						
						$no++;
						$b++;
					}//end foreach
					}else{
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow (0,3,'Data Tidak ada');
					}
			}else{
				$this->redirect('index.php/admin/pesan');
			}
			
		}
		
        
                    

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle($worksheet);
		
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
    }
}
