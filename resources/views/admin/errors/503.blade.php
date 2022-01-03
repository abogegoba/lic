<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>LinkT(リンクト) - メンテナンスページ</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">

	<!-- Font -->
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.0.1/collection/components/icon/icon.min.css" rel="stylesheet">

	<style>
		/* ---------------------------------
		1. PRIMARY STYLES
		--------------------------------- */

		html{ font-size: 100%; height: 100%; width: 100%; overflow-x: hidden; margin: 0px;  padding: 0px; touch-action: manipulation; }
		body{ font-size: 16px; font-family: 'Noto Sans JP', sans-serif; width: 100%; height: 100%; margin: 0; font-weight: 400;
			-webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; word-wrap: break-word; overflow-x: hidden;
			color: #333; }
		h1, h2, h3, h4, h5, h6, p, a, ul, span, li, img, inpot, button{ margin: 0; padding: 0; }
		h1,h2,h3,h4,h5,h6{ line-height: 1.5; font-weight: inherit; }
		h1,h2,h3{ font-family: 'Noto Sans JP', sans-serif; }
		p{ line-height: 1.6; font-size: 1.05em; font-weight: 400; color: #555; }
		h1{ font-size: 3em; line-height: 1; }
		h2{ font-size: 3em; line-height: 1.1; }
		h3{ font-size: 2.5em; }
		h4{ font-size: 1.5em; }
		h5{ font-size: 1.2em; }
		h6{ font-size: .9em; letter-spacing: 1px; }
		a, button{ display: inline-block; text-decoration: none; color: inherit; transition: all .3s; line-height: 1; }
		a:focus, a:active, a:hover,
		button:focus, button:active, button:hover,
		a b.light-color:hover{ text-decoration: none; color: #E45F74; }
		b{ font-weight: 500; }
        img{ width: 200px; }
		li{ list-style: none; display: inline-block; }
		span{ display: inline-block; }
		button{ outline: 0; border: 0; background: none; cursor: pointer; }
		b.light-color{ color: #444; }
		.icon{ font-size: 1.1em; display: inline-block; line-height: inherit; }
		[class^="icon-"]:before, [class*=" icon-"]:before{ line-height: inherit; }
		*, *::before, *::after {
			-webkit-box-sizing: inherit;
			box-sizing: inherit;
		}
		*, *::before, *::after {
			-webkit-box-sizing: inherit;
			box-sizing: inherit;}

		/* ---------------------------------
		2. COMMONS FOR PAGE DESIGN
		--------------------------------- */

		.center-text{ text-align: center; }
		.display-table{ display: table; height: 100%; width: 100%; }
		.display-table-cell{ display: table-cell; vertical-align: middle; }
		::-webkit-input-placeholder { font-size: .9em; letter-spacing: 1px; }
		::-moz-placeholder { font-size: .9em; letter-spacing: 1px; }
		:-ms-input-placeholder { font-size: .9em; letter-spacing: 1px; }
		:-moz-placeholder { font-size: .9em; letter-spacing: 1px; }
		.full-height{ height: 100%; }
		.position-static{ position: static; }
		.font-white{ color: #fff; }
		.font-gray{ color: #383838; }
		.mb_30{ margin-bottom: 30px;}

		/* ---------------------------------
		3. MAIN SECTION
		--------------------------------- */

		.main-area{ position: relative; height: 100vh; z-index: 1; padding: 0 20px; background-size: cover; color: #fff; }
		.main-area:after{ content:''; position: absolute; top: 0; bottom: 0;left: 0; right: 0; z-index: -1; opacity: 1; background: #ebebeb; }
		.main-area .desc{ margin: 20px auto; max-width: 500px; }
		.main-area .notify-btn{ padding: 13px 35px; border-radius: 50px; border: 2px solid #F84982; color: #fff; background: #F84982; }
		.main-area .notify-btn:hover{ background: none; }
		.main-area .social-btn{ position: absolute; bottom: 40px; width: 100%; left: 50%; transform: translateX(-50%); }
		.main-area .social-btn > li > a{ margin: 0 10px; padding-bottom: 7px; position: relative; overflow: hidden; }
		.main-area .social-btn > li > a:after{ content:''; position: absolute; bottom: 0; left: 0; right: 0;
			transition: all .2s; height: 2px; background: #F84982; }
		.main-area .social-btn > li > a:hover:after{ transform: translateX(100%); }

		/* Screens Resolution : 992px
		-------------------------------------------------------------------------- */
		@media only screen and (max-width: 1200px) {}

		/* Screens Resolution : 992px
		-------------------------------------------------------------------------- */
		@media only screen and (max-width: 992px) {}

		/* Screens Resolution : 767px
		-------------------------------------------------------------------------- */
		@media only screen and (max-width: 767px) {
			/* ---------------------------------
			1. PRIMARY STYLES
			--------------------------------- */
			p{ line-height: 1.4; }
			h1{ font-size: 2.8em; line-height: 1; }
			h2{ font-size: 2.2em; line-height: 1.1; }
			h3{ font-size: 1.8em; }
		}

		/* Screens Resolution : 479px
		-------------------------------------------------------------------------- */
		@media only screen and (max-width: 479px) {
			/* ---------------------------------
			1. PRIMARY STYLES
			--------------------------------- */
			body{ font-size: 12px; }
		}

		/* Screens Resolution : 359px
		-------------------------------------------------------------------------- */
		@media only screen and (max-width: 359px) {}

		/* Screens Resolution : 290px
		-------------------------------------------------------------------------- */
		@media only screen and (max-width: 290px) {}
	</style>
</head>
<body>
	<div class="main-area center-text">
		<div class="display-table">
			<div class="display-table-cell">
				<img class="mb_30" src="https://linkt.jp/assets//img/common/logo.png" alt="linkt">
				<h1 class="title font-gray"><b>ただいまメンテナンス中です。</b></h1>
				<p class="desc font-gray">一時的にご利用いただけない状態となっております。</p>
				<p class="desc font-gray">ご不便をおかけいたしまして申し訳ございません。</p>
			</div><!-- display-table -->
		</div><!-- display-table-cell -->
	</div><!-- main-area -->
</body>
</html>