
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>Upload Form</title>

</head>
<body>

<?php echo $this->upload->display_errors();?>
<?php echo validation_errors (); ?> 

<?php echo form_open_multipart('');?>
이름 : <input type="text" name="name" size="20" value="<?php echo set_value('name');?>">
첨부 : <input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>
