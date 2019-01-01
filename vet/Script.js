//Modal
let modal = document.getElementById('modal');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function openModal() {
        document.getElementById('modal').style.display='block';
}
function closeModal(){
    document.getElementById('modal').style.display='none';
}
//show/hide animal rows
$(function() {
    $('.click').click(function() {
        $('#animalTable tr:nth-child(n+5)').toggle();
        if ($(this).text() == "Show More") { 
            $(this).text("Show Less"); 
        } else { 
            $(this).text("Show More"); 
        }; 
    });
});
//show/hide animal details
$(function() {
    $('.showMore').click(function() {
        $(this).next('.animalInfo').toggle();
        if ($(this).text() == "More") { 
            $(this).text("Less"); 
        } else { 
            $(this).text("More"); 
        }; 
    });
});
/*Show Hide Animal data for editing*/
$(document).ready(function() {  
    $(".animalClick").click(function() {
      $(this).next(".editAnimal").toggle()
    });  
  });   

/*Link to Medical record from Adoptable page*/
/*Cite: https://stackoverflow.com/questions/19491336/get-url-parameter-jquery-or-how-to-get-query-string-values-in-js */
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
var id = getUrlParameter('id');
$(document).ready(function() {  
    $('#' + id).show()  
}); 