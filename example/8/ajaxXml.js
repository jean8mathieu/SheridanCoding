/**
 * Created by Jean-Mathieu on 3/9/2015.
 */

function process(){
    $.ajax({
        url:'file.xml',
        dataType: 'xml',
        success: function(data){
            $("ul").children().remove();
            $(data).find("employee").each(function(){
               var info = '<li>Name = ' + $(this).find("name").text() + '</li>';
                info += '<li>Age = ' + $(this).find("age").text() + '</li>';
                info += '<li>Address = ' + $(this).find("address").text() + '</li>';
                info += '<hr width="30%" align="left">';
                $("ul").append(info);
            });
        }
    });
}