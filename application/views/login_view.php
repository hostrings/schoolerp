<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <title>Login</title>
</head>
<body>
<div class="container_second_main" style="siplay:block; width:500px; margin : 0 auto;">
<div class="container_second">
   <?php echo validation_errors(); ?>
   <?php echo form_open('verifylogin/index'); ?>
     <label for="username">Username:</label>
     <input class="username" type="text" size="20" id="username" name="username"/>
     <br/>
     <label for="password">Password:</label>
     <input class="password" type="password" size="20" id="passowrd" name="password"/>
     <br/>
     <input class="submit" type="submit" value="Login"/>
   </form>
</div>
</div>
</body>
</html>