<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 12/12/14
 * Time: 9:04 PM
 */

class picture {
    public function __construct($imageId,$userId,$imageAuthor,$imageLocation,$imageUploadedDate){
        $this->imageId = $imageId;
        $this->imageUserId = $userId;
        $this->imageLocation = $imageLocation;
        $this->imageAuthor = $imageAuthor;
        $this->imageUploadedDate = $imageUploadedDate;
    }

    function getImageId(){
        return $this->imageId;
    }

    function getImageUserId(){
        return $this->imageUserId;
    }

    function getImageUploadedBy(){
        return $this->imageAuthor;
    }

    function getImageLocation(){
        return $this->imageLocation;
    }

    function getUploadedDate(){
        return $this->imageUploadedDate;
    }

    function getImageAuthor(){
        return $this->imageAuthor;
    }

    function getImageDisplayTitle(){
        return '<a href="http://www.jmdev.ca/sheridan/picture/img/?id="' . $this->getImageId() . '"
                    style="text-decoration: none">Picture #"' . $this->getImageId() .
                '</a>';
    }

    function getImageDisplayTitleNoRedirect(){
        return 'Picture #"' . $this->getImageId();
    }

    function getImagePower(){
        return '<small>
                    <a href="/sheridan/picture/delete/?id="' . $this->getImageId() . '"&name="' . $this->getImageLocation() . "&hash=" . md5($this->getImageUploadedBy()) . '"><span class="glyphicon glyphicon-trash" style="text-decoration: none"></span></a>
                </small>';
    }

    function getImageFacebookLikeShare(){
        return '<div class="fb-like" data-href="http://www.jmdev.ca/sheridan/picture/img/?id=' . $this->getImageId()  .'"
                    data-layout="standard" data-action="like" data-show-faces="true" data-share="true">
                </div>';
    }

    function getImageFacebookComment(){
        return '<div class="fb-comments" data-href="http://www.jmdev.ca/sheridan/picture/img/?id=' . $this->getImageId() . '"
                    data-width="700px" data-numposts="2" data-colorscheme="light">
                </div>';
    }

    function getDisplayImage(){
        return '<a href="../img/?id=' . $this->getImageId() . '"><img src="../../picture/img/' . $this->getImageLocation() . '"></a>';
    }

    function getDisplayImageNoRedirect(){
        return '<img src="../../../picture/img/' . $this->getImageLocation() . '">';
    }

    function getImageInfo(){
        return '<small>Uploaded by: <a href="/sheridan/profile/' . $this->getImageAuthor() . '">' . $this->getImageAuthor() . '</a>
                    on' .  date("m/d/y", $this->getUploadedDate()) . '
                </small>';
    }
} 