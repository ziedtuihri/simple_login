function fn1(){

x = $( "#selectName option:selected" ).text();

console.log(x);


$(document).ready(function() {
$.ajax({
           url: 'api.php', //This is the current doc
           type: "POST",
           data: ({name: x}),
           success: function(data){
            obj = JSON.parse(data);
               console.log("404"+data+" ---"+obj.length);
               $("#tel").text(obj[0].tel);
               ch = ' ';
               for(let i=0;i<obj.length;i++){
                 ch += ' '+obj[i].tel+'<br>';
               }
               $("#tel").html(ch);
               console.log("404"+ch);
           }
       });

});

}
