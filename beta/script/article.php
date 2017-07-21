<?php

/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 12/7/14
 * Time: 11:25 AM
 */
class article
{
    public $title, $author, $description, $code, $category, $editedBy, $createdBy, $editedOn, $createdOn, $attachment;

    public function __construct($id, $title, $author, $description, $code, $category, $editedBy, $createdBy, $editedOn, $createdOn, $attachment)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
        $this->code = $code;
        $this->category = $category;
        $this->editedBy = $editedBy;
        $this->createdBy = $createdBy;
        $this->editedOn = $editedOn;
        $this->createdOn = $createdOn;
        $this->attachment = $attachment;
    }

    function getArticleId(){
       return $this->id;
    }

    function getArticleTitle()
    {
        return $this->title;
    }

    function getArticleCreatedBy()
    {
        $id = $this->author;
        //Query to get Author
        include("../connection.php");
        mysql_connect("$host", "$username", "$password") or die("Cannot connect. Contact the admin!");
        mysql_select_db("$db_name") or die("cannot select DB. Contact the admin!");
        $sql = "SELECT * FROM account WHERE id='$id'";
        $result = mysql_query($sql);
        $rows = mysql_fetch_array($result);
        return $rows['username'];
    }

    function getArticleDescription()
    {
        return $this->description;
    }

    function getArticleCode()
    {
        return $this->code;
    }

    function getArticleCategory()
    {
        if ($this->category == "java") {
            $label = '<span class="label label-primary">Java</span>';
        } elseif ($this->category == "html") {
            $label = '<span class="label label-success">HTML</span>';
        } elseif ($this->category == "js") {
            $label = '<span class="label label-danger">Javascript</span>';
        } elseif ($this->category == "php") {
            $label = '<span class="label label-info">PHP/MySQL</span>';
        } elseif ($this->category == "text") {
            $label = '<span class="label label-default">Other</span>';
        } elseif ($this->category == "avrasm") {
            $label = '<span class="label label-warning">Assembly</span>';
        } elseif ($this->category == "objectivec") {
            $label = '<span class="label label-default">C</span>';
        } else {
            $label = null;
        }
        return $label;
    }

    function getArticleEditedBy()
    {
        return $this->editedBy;
    }

    function getArticleEditedOn()
    {
        return $this->editedOn;
    }


    function getArticleCreatedOn()
    {
        return $this->createdOn;
    }

    function getArticleAttachment()
    {
        return $this->attachment;
    }

    function getArticleLabel()
    {
        return $this->category;
    }

    function getArticlePower()
    {
        $power = '
        <small>
            <a href="/sheridan/edit/?id=' . ($this->getArticleId() . "&a=" . md5($this->getArticleCreatedBy())) . '"><span class="glyphicon glyphicon-pencil" style="text-decoration: none"></span></a>
            <a href="/sheridan/delete/?id='  . ($this->getArticleId() . "&a=" . md5($this->getArticleCreatedBy())) . '"><span class="glyphicon glyphicon-trash" style="text-decoration: none"></span></a>
        </small>';
        return $power;
    }

    function getFacebookComment(){
        $page = new pageFrame();
        $comment = '
            <div class="fb-comments" data-href="' . $page->getSiteAddress() . 'page/?p=' . $this->getArticleId() . '"
                 data-width="700px" data-numposts="2"
                 data-colorscheme="light">
            </div>
        ';

        return $comment;
    }

    function getFacebookShareLike(){
        $page = new pageFrame();
        $likeShare = '
         <div class="fb-like" data-href="' .  $page->getSiteAddress() . 'page/?p=' . $this->getArticleId() . '"
         data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
        ';
        return $likeShare;
    }

    function getCodePreview(){
        $code = '
             <pre><code class="' . $this->category . '">' . mb_strimwidth($this->getArticleCode(), 0, 1000, '<h3 style="color: red">**Click on the title to see the full article.**</h3>') . '</code></pre>
        ';
        return $code;
    }

    function getCode(){
        return '<pre>
                    <code class="' . $this->category . '">' . $this->getArticleCode() . '</code>
               </pre>';
    }

    function getDescription(){

        if($this->getArticleDescription() != null){
            $desc = '

                ' . $this->getArticleDescription() . '

            ';
            return $desc;
        }else{
            return null;
        }

    }

    function getAttachment(){

        if ($this->getArticleAttachment() != null) {
            $links = explode("-", $this->getArticleAttachment());
            $link = $links[count($links) - 1];
            $l =  '<a href="' . $this->getArticleAttachment() . '">' . $link . '</a>';
        } else {
            $l =  "None";
        }

        $att = '
          <small>Attachments: '
            . $l  . '
          </small>
        ';

        return $att;
    }

    function getArticleInfo(){
        $updated = null;
        if ($this->getArticleEditedOn() != 0){
            $updated = ' and updated on ' .  date("m/d/y", $this->getArticleEditedOn());
        }
        return '<small>Created by: <a href="profile/' . $this->getArticleCreatedBy() . '">' . $this->getArticleCreatedBy() .  '</a>
            on ' . date("m/d/y", $this->getArticleCreatedOn())   . $updated . '
        </small>';
    }

    function getArticleDisplayTitle(){
        return '<a href="page/?p=' . $this->getArticleId() . '"
                    style="text-decoration: none">' . $this->getArticleTitle(). " " . $this->getArticleCategory() .'
                </a>';
    }

    function getArticleDisplayTitleNoRedirect(){
        return $this->getArticleTitle(). " " . $this->getArticleCategory();
    }


} 