$(function(){
    $("#editsession").click(function(){
        $("#sessionpopup").dialog({
            draggable:true,
            modal: true,
            autoOpen: false,
            height:200,
            width:600,
            resizable: false,
            title:'Edit session',
            position:'center',
             show: {
                effect: "slide",
                duration: 1000
                },
                hide: {
                effect: "fade",
                duration: 1000
                }
        });
        $("#sessionpopup").load($(this).attr('href'));
        $("#sessionpopup").dialog("open");
         
        return false;
    });
});