function clickExpandBtn(section) {
  if (document.getElementById(section).style.display == "none") {
    document.getElementById(section).style.display = "inline";
  }else{
    document.getElementById(section).style.display = "none";    
  }

}
