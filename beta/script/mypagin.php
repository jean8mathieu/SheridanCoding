<?php

/**
@authour olaoluwa olorunda
php pagination made easy
This program is open-source and part or all of it can be modified to suit your specific needs ,
if you have any modification or suggestion to make this class better, contact me
@email olorundaolaoluwa@gmail.com
 **/
class simplepagin
{

// variables
    public $val, $total_records, $noperpage, $url, $size;

// pagination function
    function pagin()
    {

// set @$_GET value
        if (@isset($_GET[$this->val])) {
            $page = @$_GET[$this->val];
        } else {
            $page = 1;
        }

// calculate pagin size

        $total_pages3 = ceil($this->total_records / $this->noperpage);

// condition for the FIRST button
        if ($total_pages3 > 1) {

            $part = '<ul class="pagination' . ' ' . 'pagination-' . $this->size . '" ><li><a href="' . $this->url . '?' . $this->val . '=';
            $last = '">&laquo;</a></li> <li><a href="' . $this->url . '?' . $this->val . '=' . (1) . '">First</a></li>  ';
            if (($page - 1) <= 1) {
                echo $part . (1) . $last;
            } else {
                echo $part . ($page - 1) . $last;
            }

            // condition for the pagination size
            if ($page <= 4 and $page != 0) {

                if ($total_pages3 == 1 || $total_pages3 == 2 || $total_pages3 == 3 || $total_pages3 == 4 || $total_pages3 == 5) {
                    $total_pages = $total_pages3;
                    $i = 1;
                } else {
                    $total_pages = 5;
                    $i = 1;
                }

            } else if ($page >= 4 && $page < ($total_pages3 - 2)) {

                $total_pages = $page + 2;
                $i = $page - 2;

            } else if ($page >= ($total_pages3 - 2)) {
                $total_pages = $total_pages3;
                $i = $total_pages3 - 4;

            }

            for ($i; $i <= $total_pages; $i++) {
                $li = "<li";
                if ($page == $i) {
                    $ac = "class='active'  ";
                    if ($page == $total_pages3) {

                        $title = "title=' " . $this->total_records . '  of  ' . $this->total_records . "&nbsp;total records'  ";

                    } else {

                        $title = "title=' " . $this->noperpage * $page . '  of  ' . $this->total_records . "&nbsp;total records ' ";
                    }

                } else {
                    $ac = "";
                    $title = "";
                }

                echo $li . ' ' . $ac . "><a " . $title . " href='" . $this->url . "?" . $this->val . "=" . $i . "'>" . $i . "</a> </li> ";

            }
            //condition for LAST button

            if ($page + 1 > $total_pages3) {
                $pp = $page;

            } else {
                $pp = $page + 1;
            }
            $pag = '<li><a href="' . $this->url . '?' . $this->val . '=' . $total_pages3 . '">Last</a></li> <li><a href="' . $this->url . '?' . $this->val . '=' . $pp . '">&raquo;</a></li></ul>';
            echo $pag;

        } else {

            echo '';
        }
    }

}

?>
