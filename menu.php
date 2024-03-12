<style>
.toggle, [id^=drop] {display: none;}
nav { margin: 0; padding: 0; background:#333 }
nav:after { content: ""; display: table; clear: both }
nav ul { float: left; padding: 0; margin: 0; list-style: none; position: relative; font-size:13px }
nav ul li { margin: 0px; display: inline-block; float: left; background:#333 }
nav a { display: block; padding:15px 20px; color: #FFF; text-decoration: none; transition:300ms ease-in-out }
nav ul li ul li:hover { background: #000000; color:#009cff; text-decoration:none }
nav a:hover { background: #000000; color:#FC0; text-decoration:none }
nav ul ul { display: none; position: absolute; top: 50px; z-index:1; border-top:1px solid #009cff }
nav ul li:hover > ul { display: inherit; }
nav ul ul li { width: 280px; float: none; display: list-item; position: relative }
nav ul ul ul li {
  position: relative;
  top: -60px;
  left: 170px;
}
nav ul ul li a {padding:10px 15px }
li > a:after { content: ' +'; }
li > a:only-child:after { content: ''; }
/* Media Queries
--------------------------------------------- */
@media all and (max-width : 768px) {
nav { margin: 0; }
.toggle + a, .menu { display: none; }
.toggle {
  display: block;
  background: #333;
  padding: 15px 20px;
  color: #FFF;
  font-size: 14px;
  text-decoration: none;
  border: none; margin:0
}

.toggle:hover { background: #000000; clear:#009cff; cursor:pointer }

[id^=drop]:checked + ul { display: block; border-top:none }

nav ul li {
  display: block;
  width: 100%;
}

nav ul ul .toggle, nav ul ul a { padding: 0 40px; }
nav ul ul ul a { padding: 0 80px; }
nav a:hover, nav ul ul ul a { background-color: #000000; }
nav ul li ul li .toggle, nav ul ul a { background-color: #212121; }
 nav ul ul {
  float: none;
  position: static;
  color: #ffffff;
}
nav ul ul li:hover > ul, nav ul li:hover > ul { display: none; }
nav ul ul li { display: block; width: 100% }
nav ul ul ul li { position: static }
}

@media all and (max-width : 330px) {

nav ul li {
  display: block;
  width: 100%; padding:0
}
}
</style>
<section class="sticky-top d-print-none">
    <nav>
        <label for="drop" class="toggle"><i class="fa fa-bars"></i> Navigation Menu</label>
        <input type="checkbox" id="drop">
        <ul class="menu">
            <li><a href="<?php echo BASE_URL;?>/StudentPanel/candidateLogin.php"><i class="fa fa-home"></i> Home</a></li>
            <li> 
                <label for="drop-MeritList" class="toggle"><i class="fa fa-list-alt"></i> Notice +</label>
                <a href="javascript:void(0)"><i class="fa fa-list-alt"></i> Notice </a>
                <input type="checkbox" id="drop-Notice">
                <ul>
                    <li><a href="https://vec.ac.in/noticeUpload/Notice/attachment_2022-07-23-07-28-23.pdf" target="_blank"><i class="fa fa-hand-o-right"></i> 20.08.2022: 3rd and 5th Semester Admission Notice 2022-23 <span class="badge badge-warning faa-flash faa-fast animated">New</span></a></li>
                    <!--<li><a href="https://vec.ac.in/noticeUpload/Notice/attachment_2021-10-26-05-48-37.pdf" target="_blank"><i class="fa fa-hand-o-right"></i> 26.10.2021: 3rd and 5th Semester Admission Notice 2021-22 <span class="badge badge-warning faa-flash faa-fast animated">New</span></a></li>-->
                </ul>
            </li>
            <li><a href="javascript:void(0)" data-toggle="modal" data-target="#helpline"><i class="fa fa-phone faa faa-tada animated"></i> Helpline</a></li>
        </ul>
    </nav>
</section>