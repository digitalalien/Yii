<?php
/**
 * index.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/22/12
 * Time: 8:30 PM
 */
?>
<?php $imageUrl = "http://www.yiiframework.com/extension/jii-jcrop/files/yii-jcrop-preview.png/"; ?>
<?php $this->widget('common.extensions.imageEdit.jCropWidget',array(
    	'imageUrl'=>$imageUrl,
		'formElementX'=>'AvatarForm_cropX',
		'formElementY'=>'AvatarForm_cropY',
		'formElementWidth'=>'AvatarForm_cropW',
		'formElementHeight'=>'AvatarForm_cropH',
		//'previewId'=>'avatar-preview', //optional preview image ID, see preview div below
		//'previewWidth'=>$previewWidth,
		//'previewHeight'=>$previewHeight,
		'jCropOptions'=>array(
			'aspectRatio'=>1, 
			'boxWidth'=>400,
			'boxHeight'=>400,
			'setSelect'=>array(0, 0, 100, 100),
		),
	)
);
?>
