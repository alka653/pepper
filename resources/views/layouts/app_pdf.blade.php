<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>{{ $title }}</title>
		<style type="text/css" media="screen">
			*{
				font-family: "Times New Roman", Times, serif;
			}
			p{
				font-size: 12pt;
				text-align: justify;
			}
			.text-center{
				text-align: center;
			}
			h4{
				font-size: 18pt;
			}
		</style>
		@yield('style')
	</head>
	<body>
		@yield('content')
	</body>
</html>