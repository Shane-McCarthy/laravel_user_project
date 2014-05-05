<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>
<?php $link= URL::to('password/reset', array($token)); ?>
		<div>
			To reset your password, complete this form: {{ HTML::link($link,'Click Here', array($token)) }}
		</div>
		<div>If you cannot see the link copy and paste this {{URL::to('password/reset', array($token))}}
	</body>
</html>