<?php

header("Content-type: text/css; charset: UTF-8");

?>

html, body {
  height: 100%;
  margin: 0;
}

#splash{
	margin-bottom:5%;
	width:100%;
}

.splashImg{
	position:absolute;
	z-index:-2;
	margin-bottom:5%;
}

#Title{
float:left;
margin-left:5%;
margin-top:5%;
}

#topMenuer{
	position:fixed;
	top:0;
	width:100%;
	height:10%;
	background-color:#f2f3f5;
}

#Register{
	float:right;
	width: 40%;
	height: 55%;
	background-color:white;
	margin-top:7%;
	margin-right: 10%;
	margin-bottom:5%;
	border-radius:30px;
}

#Login{
	float:left;
	width: 45%;
	height: 55%;
	background-color:white;
	margin-top:15%;
	margin-left: 25%;
	margin-right: 25%;
	margin-bottom:5%;
	border-radius:30px;
}

#InputForm{
	padding-left: 25%;
	padding-right: 25%;
	padding-bottom: 3%;
	padding-top: 3%;

	height: 300px; 
	width:47%;
}

#roleSelect{
	margin-left:15%;
	margin-right:15%;
	padding-bottom: 3%;
	padding-top: 2%;
}

#FieldSpec{
	float:left;
	padding-left: 2%;

}

#Users{
	margin-top:3%;
	width:100%;
	height:150px;
	padding:1%;
	border: 2px solid #2CD5A7;
	border-color:#2CD5A7;
	border-radius: 30px;
}

#Section0{
	float:left;
	height:100px;
	width: 5%;
	margin-top: 3.5%;
}

#Section1{
	float:left;
	height:100px;
	width: 25%;
	margin-top: 3.5%;
	margin-left: 5%;
}

#Section2{
	float:left;
	height:100px;
	margin-top: 2%;
	margin-bottom: 2%;
	border-left: 4px solid  #707070;
	width: 25%;
	padding-left:3%;
	
}

#Section3{
	float:left;
	height:100px;
	margin-top: 2%;
	margin-bottom: 2%;
	border-left: 4px solid  #707070;
	width: 25%;
	padding-left:3%;
}
#Section4{
	width:5%;
	float:left;
	margin-left:2%;
}

.rowFit{
float:left;
margin-top:-0px;
margin-left:3%;
font-size:24px;
background-color:white;
border:none;

}

.rowFit:hover{
background-color:#2CD5A7;
border-radius:15px;
border-color:#2CD5A7;
border: 2px;
color:white;

}

.deleteFit{
float:left;
margin-top:-0px;
margin-left:3%;
font-size:24px;
background-color:red;
border-radius:15px;
border:4px solid  red;
color:white;

}

.deleteFit:hover{
background-color:white;
border-radius:15px;
border:4px solid  red;
color:red;

}

#CourseList{
	margin-left:5%;
	margin-top:3%;
	width:15%;
	margin-right:5%;
	height:100px;
	padding:1%;
	border: 2px solid #2CD5A7;
	border-color:#2CD5A7;
	border-radius: 30px;
}

#Container{
height:80%;
}

#ContentContain{
	margin-left:20%;
	margin-top:10%;
	width:75%;
	margin-right:5%;
	height:auto;
}

#sideMenu{
	float:left;
	padding-left:2%;
	padding-right:2%;
	position:fixed;
	top:20%;
	width:10%;
	height:80%;
	border-right: 10px solid  #707070;
	padding:50px;
	z-index:0;
}

.NavBtn{
	float:left;
	margin-top:30%;
	margin-left:15%;
	padding:45px;
	padding-left:30px;
	padding-right:30px;

	font-size:24px;
	border-radius:90%;
	color:#707070;
	border:4px solid  #2CD5A7;
}

.NavBtn:hover{
	background-color:#707070;
	color:#2CD5A7;
	border:none;
}

.pageTitle{
	font-size:48px;
	text-align:center;
}

.headerFit{
float:left;
margin-top:0px;
margin-left:3%;
margin-right:20%;
font-size:24px;
}

.fieldSize{
	padding:3%;
}

.buttonForm{
	background-color:#707070;
	color:white;
	padding:16px;
	font-size:24px;
	border-radius:15px;
	float:right;
	margin-left: 2%;
	margin-top: 5%;
}

.RoleBtn{
	float:left;
	padding:125px;
	padding-right:100px;
	padding-left:100px;
	font-size:65px;
	border-radius:90%;
	border:none;
	background-color:#777777;
	color:white;
}

.RoleBtn:hover{
	background-color:#2CD5A7;
}

#CourseSelection{
background-color: white;
padding:48px;
padding-top:8px;
padding-bottom:8px;
margin-top:-8px;
font-size:20px;
border: 1px solid  #707070;
}

#LessonSelection{
background-color: white;
padding:48px;
padding-top:8px;
padding-bottom:8px;
margin-top:-8px;
font-size:20px;
border: 1px solid  #707070;
}

#FileSelection{
background-color: white;
padding:48px;
padding-top:8px;
padding-bottom:8px;
margin-top:-8px;
font-size:20px;
border: 1px solid  #707070;
}

.dropdown {
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 17px;    
  border: none;
  outline: none;
  color: black;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.dropdown-content {
  display: none;
  float:right;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
width: 100%;
}

.dropdown-content button {
  float: none;
  color: black;
  width: 100%;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: center;
}

.topnav a:hover, .dropdown:hover .dropbtn {
  background-color: #555;
  color: white;
}

.dropdown-content a:hover {
  color: black;
}

.dropdown:hover .dropdown-content {
  display: block;
}