<?php


namespace app\helpers;

use Yii;

class FileHelper
{
    private static $counter = 0;

    /**
     * @param string $imageData
     * @param string $folder
     * @return string
     */
    public static function saveFileFromBase64(string $imageData, string $folder): string
    {
        $data = explode(',', $imageData);
        if(count($data)<2) {
            return $imageData;
        }
        $image = base64_decode($data[1]);
        $dir = Yii::getAlias('@app/web/media/'.$folder);
        if (!file_exists($dir))
            mkdir($dir);
        $file_name = md5(time().Yii::$app->user->id.self::$counter);
        $folder1 = substr($file_name, 0, 2);
        $folder2 = substr($file_name, 2, 2);
        $file_name = substr($file_name, 4);
        $dir .= '/'.$folder1;
        if (!file_exists($dir))
            mkdir($dir);
        $dir .= '/'.$folder2;
        if (!file_exists($dir))
            mkdir($dir);
        $file_type = explode('/', $data[0]);
        $file_type = explode(';', $file_type[1]);
        $file_type = $file_type[0];

//$file_type = explode('/', $imageData['type'])[1];
        $file = fopen($dir . '/' . $file_name . '.' . $file_type, "wb");
        fwrite($file, $image);
        fclose($file);
        self::$counter++;
        return '/media/'.$folder.'/'.$folder1.'/'.$folder2.'/'.$file_name.'.'.$file_type;
    }
}