<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<body>
<main class="main" id="top">
      
	<div class="container">

	<style>
		@import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');

	:root {
		--blue1: #ad1fff;
		--blue2: #44006b;
	}

	body, html {
		margin: 0;
		overflow: hidden;
		position: relative;
	}

	body {
		align-items: center;
		background-image: linear-gradient(to bottom right, var(--blue1), var(--blue2));
		color: #fff;
		display: flex;
		flex-direction: column;
		font-family: 'Roboto', sans-serif;
		justify-content: center;
		height: 100vh;
		text-align: center;
	}

	.container h1 {
		font-size: 10em;
		margin: 0 0 0.5em;
		line-height: 10px;
	}

	.container p {
		font-size: 1.2em;
		line-height: 26px;
	}

	.container small {
		opacity: 0.7;
	}

	.container a {
		color: #eee;
	}

	.circle {
		background-image: linear-gradient(to top right, var(--blue1), var(--blue2));
		border-radius: 50%;
		position: absolute;
		z-index: -1;
	}

	.circle.small {
		top: 200px;
		left: 150px;
		width: 100px;
		height: 100px;
	}

	.circle.medium {
		background-image: linear-gradient(to bottom left, var(--blue1), var(--blue2));
		bottom: -70px;
		left: 0;
		width: 200px;
		height: 200px;
	}

	.circle.big {
		top: -100px;
		right: -50px;
		width: 400px;
		height: 400px;
	}

	@media screen and (max-width: 480px) {
		.container h1 {
			font-size: 8em;
		}
		
		.container p {
			font-size: 1em;
		}
	}

	</style>

		<h1>BANNI :p</h1>
		<div class="circle small"></div>
		<div class="circle medium"></div>
		<div class="circle big"></div>

	</div>
</main>
</body>
</html>