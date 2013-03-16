class jCropWidget extends CWidget{
    /**
    * Specifies the image URL that is displayed in the <img> tag
    * @var string $imgUrl
    */
    public $imageUrl;
    
    /**
    * The alt text for the image
    * @var string $imgAlt
    */
    public $imageAlt;
    
    /**
    * The ID of the form input element for the x coordinate
    * @var int $formElementX
    */
    public $formElementX;
    
    /**
    * The ID of the form input element for the y coordinate
    * @var int $formElementY
    */
    public $formElementY;
    
    /**
    * The id of the form input element for the width value
    * @var int $formElementWidth
    */
    public $formElementWidth;
    
    /**
    * The id of the form input element for the height value
    * @var int $formElementHeight
    */
    public $formElementHeight;
    
    /**
    * The image id of a preview box
    * @var string $previewId
    */
    public $previewId;
    
    /**
    * preview box width
    * @var int $previewWidth
    */
    public $previewWidth;
        
    /**
    * preview box height
    * @var int $previewHeight
    */
    public $previewHeight;
    
    /**
    * key => value options that are rendered into the <img> tag
    * @var array $htmlOptions
    */
    public $htmlOptions;
    
    /**
    * key => value options passed to jCrop
    * @var array $jCropOptions
    */
    public $jCropOptions;
    
    /**
    * counter to keep track of the global variables and IDs
    * @var int $_count
    */
    private static $_count =1;
    
    
    public function init(){
    
    }
    
    public function run(){
        $assetPrefix = Yii::app()->assetManager->publish(common.extensions.imageEdit.assets, true, 0, defined('YII_DEBUG'));
        
        Yii::app()->clientScript->registerScriptFile($assetPrefix.'jqurey.Jcrop.min.js');
        Yii::app()->clientScript->registerScriptFile($assetPrefix.'jquery.color.js');
        Yii::app()->clientScript->registerScriptFile($assetPrefix.'jquery.Jcrop.css');
        
        $count = self::$_count;
        
        if(array_key_exists('id', $this->htmlOptions')){
            $id = $this->htmlOptions['id'];
        }else{
            $id = 'yii-jcrop';
        }
        
        if(!this->previewId){
            $this->previewId = $id.'-preview';
            $this->previewWidth = 100;
            $this->previewHeight = 100;
        }
        
        $id.='-'.$count;
        $this->htmlOptions['id'] = $id;
        
        $this->jCropOptions['onChange'] = 'js:updateCoords'.$count;
        $this->jCropOptions['onSelect']= 'js:updateCoords.$count;
        $options=CJavaScript::encode($this->jCropOptions);
        $js = <<<EOF jQuery("#{$id}").Jcrop({$options}); EOF;
        $updateCoordsCode = <<<EOF
            function updateCoords{$count}(c)
            {
                jQuery('#{$this->formElementX}').val(c.x);
                jQuery('#{$this->formElementY}').val(c.y);
                jQuery('#{$this->formElementWidth'}).val(c.w);
                jQuery('#{$this->formElementHeight'}).val(c.h);
                var rx = {$this->previewWidth} / c.w;
                var ry = {$this->previewHeight} / c.h;
                
                if($('#{$this->previewId}') != undefined){ 
                    $('#{$this->previewId').css({
                        width: Math.round(rx * $('#{$id}').width()) + 'px',
                        height: Math.round(ry * $('#{$id}').height()) + 'px',
                        marginLeft: '-' + Math.round(rx * c.x) + 'px',
    				    marginTop: '-' + Math.round(ry * c.y) + 'px'
                    });
                }
            };
        EOF;
        Yii::app()->clientScript->registerScript('updateCoords'.$count,$updateCoordsCode, CClientScript::POS_BEGIN);
    	Yii::app()->clientScript->registerScript('Yii.'.get_class($this).'#'.$id, $js, CClientScript::POS_LOAD);
 		$this->render('jcrop', array('url'=>$this->imageUrl, 'alt'=>$this->imageAlt, 'htmlOptions' => $this->htmlOptions, 'id'=>$id));

		self::$_COUNT++;
	}
}