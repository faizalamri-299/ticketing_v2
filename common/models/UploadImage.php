<?php
namespace common\models;

use Imagine\Image\Box;
use Yii;
use common\models\User;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;
use frontend\modules\pentadbiran\models\Kakitangan;
use frontend\modules\pentadbiran\models\DokumenDigital;
use frontend\modules\pentadbiran\models\Tuntutan;
use frontend\modules\pentadbiran\models\PermohonanCuti;


class UploadImage extends Model
{
    CONST SYMBOL = [' ', '`','~','!','@','#','$','%','%','^','&','*','(',')','-','=','+','[','{',']','}','\\','|',';',':','\'','"',',','<','>','/','?'];
    // CONST SIZE_LARGE = 'l_';
    // CONST SIZE_MEDIUM = 'm_';
    // CONST SIZE_SMALL = 's_';
    // CONST SIZE_THUMBNAIL = 't_';

    /**
     * @var UploadedFile
     */
    public $imageFiles, $multipleImageFiles, $fail, $failBantuan, $tempFile;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'extensions'=>['png','gif','jpg', 'jpeg', 'mp4'], 'skipOnEmpty' => true], // Upload multiple files
            [['multipleImageFiles'], 'file', 'extensions'=>['png','gif','jpg', 'jpeg', 'mp4'], 'skipOnEmpty' => true, 'maxFiles' => 5],
            // [['videoFiles'], 'file', 'extensions'=>'mp4', 'skipOnEmpty' => true],
            //[['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 10], // Upload multiple files
            
            [['fail'], 'file', 'extensions'=>['pdf','doc','docx','xls','xlsx','mp4'], 'skipOnEmpty' => true],
            // [['failBantuan'], 'file', 'extensions'=>['pdf','doc','docx','xls','xlsx','png','jpg', 'jpeg'], 'skipOnEmpty' => true],
            [['failBantuan'], 'file', 'extensions'=>['pdf','png','jpg','jpeg'], 'skipOnEmpty' => true],
            [['tempFile'], 'file', 'extensions'=>['pdf','doc','docx','xls','xlsx','png','gif','jpg', 'jpeg'], 'skipOnEmpty' => true],
        ];
    }
    
    /**
     * Upload gambar ikut jenis gambar
     * @param  integer  $id    ID model
     * @param  string  $jenis Jenis Gambar dan Folder jenis gambar
     * @return boolean True jika success
     */
    public function upload($id, $jenis)
    {
        if ($this->validate()) {
            switch ($jenis) {
                case 'user':
                    $model = User::findOne(['id' => $id]);
                    $columnImej = 'imej';

                    $filePath = Yii::getAlias('@upload_path_images').'/'.$jenis;
                    $folderName = FileHelper::normalizePath($filePath . '/' . $id . '/');
                    break;
                case 'kakitangan':
                    $model = Kakitangan::findOne(['id' => $id]);
                    $columnImej = 'ma_mod_gambar';

                    $filePath = Yii::getAlias('@upload_path_images').'/'.$jenis;
                    $folderName = FileHelper::normalizePath($filePath . '/' . $id . '/');
                    break;
            }

            if (file_exists($folderName)) {
                FileHelper::removeDirectory($folderName);
            }

            $namaFile = trim(str_replace(self::SYMBOL, "_", $this->imageFiles->baseName)).'.'.$this->imageFiles->extension;

            $model->{$columnImej} = $namaFile;

            if($model->save()) {
                $fullPath = $folderName;
                $this->uploadAndResize($this->imageFiles, $fullPath, $namaFile);
            }
            
            return true;
        } else {
            return false;
        }
    }

    public function uploadMultiple($id)
    {
        
        $tblSchema = 'tbl_ft_foto';
        $imejPath = Yii::getAlias('@upload_path_images'). '/form';  
        
        
        $folderName = FileHelper::normalizePath($imejPath . '/' . $id . '/foto');
        
        if ($this->validate()) {

            foreach($this->multipleImageFiles as $oneImage){

                $modelFt = new Foto();
                $modelFt->ft_fk_form_id = $id;

                $modelFt->save();

                if (file_exists($folderName)) {
                    FileHelper::removeDirectory($folderName);
                }

                $namaFile = trim(str_replace(self::SYMBOL, "_", $oneImage->baseName)).'.'.$oneImage->extension;

                $modelFt->ft_mod_imej = $namaFile;

                if($modelFt->save(false)) {
                    $fullPath = FileHelper::normalizePath($folderName . '/' . $modelFt->id . '/');
                    $this->uploadAndResize($oneImage, $fullPath, $namaFile);
                }


            }

            return true;
        }
        else
            return false;
    }

    public function uploadFail($id, $jenis)
    {
        if ($this->validate()) {
            switch ($jenis) {
                case 'latihan':
                    $model = Video::findOne(['id' => $id]);
                    $columnFail = 'vd_mod_video';
                    $attrFail = 'fail';

                    $filePath = Yii::getAlias('@upload_path_videos').'/'.$jenis;
                    $folderName = FileHelper::normalizePath($filePath . '/' . $id . '/');
                    break;

                case 'dokumendigital':
                    $model = dokumenDigital::findOne(['id' => $id]);
                    $columnFail = 'dd_mod_dokumen';
                    $attrFail = 'fail';

                    $filePath = Yii::getAlias('@upload_path_file').'/'.$jenis;
                    $folderName = FileHelper::normalizePath($filePath . '/' . $id . '/');
                    break;

                case 'TuntutanResit':
                    $model = Tuntutan::findOne(['id' => $id]);
                    $columnFail = 'makt_mod_resit';
                    $attrFail = 'fail';

                    $filePath = Yii::getAlias('@upload_path_file').'/'.$jenis;
                    $folderName = FileHelper::normalizePath($filePath . '/' . $id . '/');
                    break;

                case 'SuratSokongan':
                    $model = PermohonanCuti::findOne(['id' => $id]);
                    $columnFail = 'pc_mod_surat_sokongan';

                    $attrFail = 'fail';

                    $filePath = Yii::getAlias('@upload_path_file').'/'.$jenis;
                    $folderName = FileHelper::normalizePath($filePath . '/' . $id . '/');
                    break;

            }

            if (file_exists($folderName)) {
                FileHelper::removeDirectory($folderName);
            }

            $namaFile = trim(str_replace(self::SYMBOL, "_", $this->{$attrFail}->baseName)).'.'.$this->{$attrFail}->extension;

            $model->{$columnFail} = $namaFile;
            if(!empty($columnFormatFail)) {
                $model->{$columnFormatFail} = $this->{$attrFail}->extension;
            }

            if($model->save(false)) {
                $fullPath = $folderName;
                $this->uploadOnly($this->{$attrFail}, $fullPath, $namaFile);
            }
            
            return true;
        } else {
            return false;
        }
    }
    
    public static function delete($id, $jenis)
    {
        switch ($jenis) {
            case 'sebutharga':
                $model = Sebutharga::findOne(['id' => $id]);

                $filePath = Yii::getAlias('@upload_path_dokumen').'/'.$jenis;
                $folderName = FileHelper::normalizePath($filePath . '/' . $model->id . '/');
                break;
            case 'dokumen_sokongan':
            case 'dokumen_lain':
                $model = DokumenBantuan::findOne($id);

                $filePath = Yii::getAlias('@upload_path_dokumen').'/'.$jenis;
                $folderName = FileHelper::normalizePath($filePath . '/' . $id . '/');
                break;

            case 'tuntutan':
                $model = Tuntutan::findOne(['id' => $id]);

                $filePath = Yii::getAlias('@upload_path_file').'/'.$jenis;
                $folderName = FileHelper::normalizePath($filePath . '/' . $id . '/');
                break;
        }
        FileHelper::removeDirectory($folderName);
        return true;
    }

    public static function deleteFoto($idFm, $jenis, $id, $id_gb = 0)
    {
        $modelFm = Form::findOne(['id' => $idKdr]);
        $modelFt = Foto::findOne(['id' => $id]);
        $filePath = Yii::getAlias('@upload_path_images').'/foto';
        
        if ($jenis == 'foto') {
            $tempName = trim(str_replace(self::SYMBOL, "_", $myImageArray->baseName) . '.' . $myImageArray->extension);
            $fileLoc = $idFm . $filePath . '/' . $id;
            
            if (file_exists($fileLoc)) {
                $folderName = FileHelper::normalizePath($fileLoc);
                unlink($folderName);
            }
            
        } else {
            if(empty($id_gb)) {
                $folderName = FileHelper::normalizePath($filePath . '/' . $id . '/');
            } else {
                $folderName = FileHelper::normalizePath($filePath . '/' . $id . '/' . $id_gb . '/');
            }
            
            FileHelper::removeDirectory($folderName);
        }
        
        return true;
    }

    protected function uploadAndResize($imageFiles, $fullPath, $namaFile)
    {
        FileHelper::createDirectory(FileHelper::normalizePath($fullPath), 0775);
        $pathFile = FileHelper::normalizePath($fullPath . '/' . $namaFile);

        //save gambar ori
        $imageFiles->saveAs($pathFile);

        $sizes = getimagesize($pathFile);

        $failOri = Image::getImagine()->open($pathFile);
        $failOri->save($fullPath . '/' . 'o_' . $namaFile, ['quality'=>100]);

        $failLarge = Image::getImagine()->open($pathFile);

        $width = 800;
        $height = round($sizes[1]*$width/$sizes[0]);  
        $failLarge->resize(new Box($width, $height))->save($fullPath . '/' . 'l_' . $namaFile, ['quality'=>100]);

        $failMedium = Image::getImagine()->open($pathFile);

        $width = 400;
        $height = round($sizes[1]*$width/$sizes[0]);  
        $failMedium->resize(new Box($width, $height))->save($fullPath . '/' . 'm_' . $namaFile, ['quality'=>100]);

        $failSmall = Image::getImagine()->open($pathFile);

        $width = 200;
        $height = round($sizes[1]*$width/$sizes[0]);  
        $failSmall->resize(new Box($width, $height))->save($fullPath . '/' . 's_' . $namaFile, ['quality'=>100]);

        $failThumbnail = Image::getImagine()->open($pathFile);

        $width = 100;
        $height = round($sizes[1]*$width/$sizes[0]);  
        $failThumbnail->resize(new Box($width, $height))->save($fullPath . '/' . 't_' . $namaFile, ['quality'=>100]);
    }

    protected function uploadOnly($fail, $fullPath, $namaFile)
    {
        FileHelper::createDirectory(FileHelper::normalizePath($fullPath), 0775);
        $pathFile = FileHelper::normalizePath($fullPath . '/' . $namaFile);

        //save gambar ori
        $fail->saveAs($pathFile);

    }
}