<div class="form-box" id="login-box">
            <div class="header"><? echo $form_header_lang['login']; ?></div>
            <form action="login.php" method="post" enctype="multipart/form-data" name="form" id="form">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control firstin" id="username" placeholder="User ID"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control lastin" placeholder="Password"/>
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn btn-danger btn-block" id="Submit"><? echo $form_header_lang['login_btn']; ?></button>
                </div>
            </form>
<div>&nbsp;</div>
<div class="logoBottom"><? if($app_type=="ahass"){ ?><img src="templates/default/img/kualitas.png" /><img src="templates/default/img/ayokeahass.png" /><? } ?></div>
        </div>
        
        