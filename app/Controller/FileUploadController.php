<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('display_errors', '1');
$helpers = array('Html', 'Form','Csv'); 

class FileUploadController extends AppController {
	public function index() {
		$this->set('title', __('File Upload Answer'));

		$file_uploads = $this->FileUpload->find('all');
		$this->set(compact('file_uploads'));
    }
    
    public function add() {
        // Starting Variables
        $message = "no message";
        $file_uploads = $this->FileUpload->find('all');
        $this->set(compact('file_uploads'));
        
        if ( isset($_FILES["file"])) {

            //if there was an error uploading the file
            if ($_FILES["file"]["error"] > 0) {
                $message = "Return Code: " . $_FILES["file"]["error"] . "<br />";

            }
            else {
                if(pathinfo(WWW_ROOT ."upload/" .$_FILES["file"]["name"])['extension'] !== 'csv'){
                    $message = "Wrong File Format";
                    $this->setFlash($message);
                    $this->render('index');
                    return 0;
                }
                //Print file details
                $message = "Upload: " . $_FILES["file"]["name"] . "<br />";
                $message = "Type: " . $_FILES["file"]["type"] . "<br />";
                $message = "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                $message = "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

                //if file already exists
                if (file_exists("upload/" . $_FILES["file"]["name"])) {
                    $message = $_FILES["file"]["name"] . " already exists. ";
                    $this->setFlash($message);
                    $this->render('index');
                    return 0;
                }
                else {
                    $storagename = $_FILES["file"]["name"];
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], WWW_ROOT ."upload/" . $storagename)){
      
                        $message = "Stored in: " . "upload/" . $_FILES["file"]["name"] . "<br />";
                    }
                    else{
                        var_dump($_FILES);
                        $message ="Error Uploading";
                    }
                    
                }
            }
        } else {
                $message = "No file selected <br />";
        }

        // Save into table
        ini_set('auto_detect_line_endings',TRUE);
        $file = fopen(WWW_ROOT ."upload/" .$_FILES["file"]["name"],"r");

        while(!feof($file)){
            $data = fgetcsv($file);
            $item1 = $data[0];
            $item2 = $data[1];

            $data = array(
                'name' => $item1,
                'email' => $item2
            );
            $this->FileUpload->save($data);
        }
        ini_set('auto_detect_line_endings',FALSE);
        fclose($file);

        // Refresh the viewed data
        $file_uploads = $this->FileUpload->find('all');
		$this->set(compact('file_uploads'));

        $this->set('message',$message);
        $this->render('index');
	}
}