<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@upload_path', dirname(dirname(__DIR__)) . '/data');
Yii::setAlias('@upload_path_images', Yii::getAlias('@upload_path').'/images');
Yii::setAlias('@upload_path_file', Yii::getAlias('@upload_path').'/files');
