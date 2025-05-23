<?PHP

/**
 * Copyright 2021, 2024 5 Mode
 *
 * This file is part of Homolog.
 *
 * Homolog is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Homolog is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.  
 * 
 * You should have received a copy of the GNU General Public License
 * along with Homolog. If not, see <https://www.gnu.org/licenses/>.
 *
 * index.js
 * 
 * JS file for Home page
 *
 * @author Daniele Bonini <my25mb@aol.com>
 * @copyrights (c) 2021, 2024, the Open Gallery's contributors     
 */

 require "../init.inc";

 header("Content-Type: text/javascript");

?>

var bBurgerMenuVisible = false;
var bSideBarVisible = false;

$(document).ready(function() {
 $("#txtSearch").on("keyup",function(e){
   key = e.which;
   if (key===13) {
   e.preventDefault();
   frmDI.submit();
   } else { 
   //e.preventDefault();
   }
 });
 
 $("#Password").on("keydown",function(e){
   key = e.which;
   //alert(key);
   $("#chatHint").val("");
   if (key===13) {
   e.preventDefault();
   frmDI.submit();
   } else { 
   $("#Password2").val($(this).val());
   //e.preventDefault();
   }
 }); 

 $("#Password2").on("keydown",function(e){
   key = e.which;
   //alert(key);
   $("#chatHint").val("");
   if (key===13) {
   e.preventDefault();
   $("#Password").val("");
   frmDI.submit();
   } else { 
   //e.preventDefault();
   }
 });

 $("#MessageLine").on("keydown",function(e){
   key = e.which;
   //alert(key);
   if (key===13) {
     //e.preventDefault();
     //sendMessage()
   } else { 
     //e.preventDefault();
   }
 });
});

$("#burger-menu").on("click",function(){
  if (!bBurgerMenuVisible) {
    $(".friend-header").css("display", "table");
  } else {
    $(".friend-header").css("display", "none");
  }    
  bBurgerMenuVisible=!bBurgerMenuVisible;  
});

function hideBurgerMenu() {
  $(".friend-header").css("display", "none");
  bBurgerMenuVisible=false;  
}

function showSideBar() {
 if (!bSideBarVisible) {
   $("#content-bar").css("width","100%");
   $("#sidebar").show("slow");
 }  
 bSideBarVisible = true; 
}

function closeSideBar() {
 $("#sidebar").hide();
 $("#content-bar").css("width","100%");
 bSideBarVisible = false; 
}


$("#call-sidebar").on("mouseover", function() {
  //alert("hello");
  showSideBar();
});  

function closeSplash() {
  $("#hideSplash").val("1");
  $("#splash").hide();	
}

function refresh() {
 $("#CommandLine").val("refreshbrd");
 frmDI.submit();
}

function delSign(sign) {
  $("#CommandLine").val("del '" + sign + "'");
  frmDI.submit();
}

function confSign(sign) {
  $("#CommandLine").val("conf '" + sign + "'");
  frmDI.submit();
}

function sendSign() {
  var val = "";
  val = $("#date").val().trim();
  if (val=="" || val.length<4) {
    $("#date").addClass("emptyfield");
    return;
  }  
  val = $("#desc").val().trim();
  if (val=="" || val.length<4) {
    $("#desc").addClass("emptyfield");
    return;
  }  
  $("#CommandLine").val("sign");
  frmDI.submit();
}

$("#send").on("click",function() {
  $("#date").removeClass("emptyfield");
  $("#desc").removeClass("emptyfield");
  sendSign();
});


function setContentPos() {
  if (window.innerWidth<650) {
    $("#ahome").attr("href","/");
    $("#agithub").css("display","none");
    $("#afeedback").css("display","none");
    $("#asupport").css("display","none");
    $("#pwd2").css("display","inline");    
    //$("#sidebar").css("display","none");
    $("#burger-menu").css("display","inline");
    //$("#contentbar").css("width","100%");
    $("#logo-hl").css("display","none");
    $("#template-img").hide();
    $(".dragover").css("min-width", "450px");
  } else {  
    $("#ahome").attr("href","http://dropin.5mode-foss.eu");
    $("#agithub").css("display","inline");
    $("#afeedback").css("display","inline");
    $("#asupport").css("display","inline");  
    $("#pwd2").css("display","none");
    //$("#sidebar").css("display","inline");
    $("#burger-menu").css("display","none");
    //$("#contentbar").css("width","75%");
    $("#logo-hl").css("display","inline");
    $("#template-img").show();    
    $(".dragover").css("min-width", "630px");
  }
  hideBurgerMenu();
  //window.scroll(0, 0);
  //$(document.body).css("overflow-y", "hidden");
}  

function setFooterPos() {
  //if (document.getElementById("footerCont")) {
	//if ($("#Password").val() === "") {  
  //  tollerance = 48;
  //} else {
	  tollerance = 15;
	//}  	  
  
    if (window.innerWidth<450) {
      $(".no-sm").css("display", "none");
    } else {
      $(".no-sm").css("display", "inline");
    }
    
    $("#footerCont").css("top", parseInt( window.innerHeight - $("#footerCont").height() - tollerance ) + "px");
    $("#footer").css("top", parseInt( window.innerHeight - $("#footer").height() - tollerance ) + "px");
  //}
}

function showEncodedPassword() {
   if ($("#Password").val() === "") {
	 $("#Password").addClass("emptyfield");
	 return;  
   }
   if ($("#Salt").val() === "") {
	 $("#Salt").addClass("emptyfield");
	 return;  
   }	   	
   passw = encryptSha2( $("#Password").val() + $("#Salt").val());
   msg = "Please set your hash in the config file with this value:";
   alert(msg + "\n\n" + passw);	
}

//$("input#files").on("change", function(e) {
//  
//  if (!document.getElementById("files").files) {
//    $("#del-attach").css("display", "none");
//  } else {  
//    $("#del-attach").css("display", "inline");
//  }  
  //frmDI.submit();
//});

$("div.dragover").on("dragover", function(e) {
  e.stopPropagation();
  e.preventDefault();

  e.originalEvent.dataTransfer.dropEffect = "copy";

  return false;
});

$("div.dragover").on("drop", function(e) {
  e.stopPropagation();
  e.preventDefault();

  // Get the current Upload form obejct..
  var form = document.getElementById("frmDI");
  // Create a FormData object including the actual form data..
  var fd = new FormData(form);

  // Get the array of files dropped..
  var dt = e.originalEvent.dataTransfer;
  var files = dt.files;

  var count = files.length;
  //alert("File Count: " + count + "\n");

  if (count !== 0) {

    for (var i = 0; i < count; i++) {
      //alert(" File " + i + ":\n(" + (typeof files[i]) + ") : <" + files[i] + " > " +
      //       files[i].name + " " + files[i].size + " " + files[i].type + "\n");
      if (files[i].size > <?PHP echo(APP_FILE_MAX_SIZE); ?>) {
        alert("ERROR: file size (" + files[i].size +") exceeds app limit: <?PHP echo(APP_FILE_MAX_SIZE); ?>");
        return;
      }
      
      fd.append("filesdd[]", files[i]);
    }

    // Submit of the FormData..
    $.ajax("/", {
        method: "POST",
        processData: false,
        contentType: false,
        data: fd//,
        //success: function (data) {
        //  $("body").html(data);
        //}
    });
      
    setTimeout("reload()", 2000); 
    
  } else {
    
    ttext = e.originalEvent.dataTransfer.getData('text/plain');
    //re = new RegExp(/(https?:\/\/)([\da-z\.-]+)\.([a-z\.]{2,8})(\/?.+)?$/gum);
    //matches = mytext.matchAll(re);
    //matches = mytext;
    
    //alert(ttext);     
                
    if (ttext!=="") {
      
      //fd.append("f", ffriends);
      document.getElementById("t").value = ttext;  
      
      //alert(document.getElementById("f").value);
      
      document.getElementById("frmDI").submit();
      
    } else {
      //alert("ale!");
    }  
  }

  return false;
});

$("input#files").on("change", function(e) {
  frmDI.submit();
});

function reload() {
  document.getElementById("frmDI").submit();
}

function openEx(ex) {
   <?PHP if (DISPLAY_SHOW_HEADER): ?>
   $("#fullExerpt").html($("#hheader"+ex).html() + $("#eexerpt"+ex).html());
   <?PHP else: ?>
   $("#fullExerpt").html($("#eexerpt"+ex).html());   
   <?PHP endif; ?>
   $("#modalButtonNew").click();
}

//function clearUpload() {
//  $("#upload-cont").html("<input id='files' name='files[]' type='file' accept='.gif,.png,.jpg,.jpeg' style='visibility: hidden;' multiple>"); 
//  $("#del-attach").css("display", "none");
//}  

$("#Password").on("keydown", function(e){
	$("#Password").removeClass("emptyfield");
});	

$("#Salt").on("keydown", function(e){
	$("#Salt").removeClass("emptyfield");
});	

window.addEventListener("load", function() {
  
  if ($("#frmDI").css("display")==="none") {
    setTimeout("setContentPos()", 5200);  
    setTimeout("setFooterPos()", 300);
  } else {
    setTimeout("setContentPos()", 300);
    setTimeout("setFooterPos()", 300);
  }      
  
}, true);

window.addEventListener("resize", function() {

  if ($("#frmDI").css("display")==="none") {
    setTimeout("setContentPos()", 5200);
    setTimeout("setFooterPos()", 300);
  } else {
    setTimeout("setContentPos()", 300);
    setTimeout("setFooterPos()", 300);
  }      

}, true);
