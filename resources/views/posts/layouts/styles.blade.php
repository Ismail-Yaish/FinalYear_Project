<!-- styles.blade.php -->
	{{-- CSS Styles --}}
	{{-- <style>

		@import url(https://fonts.googleapis.com/css?family=Hind);
		@import url(https://fonts.googleapis.com/css?family=Open+Sans);
		
		
		body {
			font-family: 'Open Sans', sans-serif;
			color: #31383d;
			font-size: 1.1rem;
			padding-top: 80px; 
			/* margin-bottom: 80px; */

			display: flex;
			flex-direction: column;
			min-height: 100vh;

			margin-top: 5%;
		}

		.container-content {
			flex: 1; /* This will make sure the content takes up the remaining space */
			padding-bottom: 15px;
		}
		
		section {
			padding: 30px 0;
			background: #fff;
		}
		
		p {
			line-height: 1.5;
			margin: 30px 0;
		}
		
		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
		font-family: 'Hind', sans-serif;
		font-weight: 800;
		}
		

		h6 
		{
			font-family: 'Hind', sans-serif;
			font-weight: 800;
			padding-top: 50px;
		}
		
		a {
			color: #31383d;
			-webkit-transition: all 0.2s;
			-moz-transition: all 0.2s;
			transition: all 0.2s;
		}
		
		a:hover,
		a:focus {
			color: #73a5fc;
		}
		
		#navbar-main {
			position: absolute;
			font-family: 'Hind', sans-serif;
			background-color: #fff;
			border-bottom: 1px solid #d7e2e9;
		}
		
		#navbar-main .navbar-brand {
			color: #96a4b1;
		}
		
		#navbar-main .navbar-toggler {
			padding: 0.5rem;
			border: none;
		}
		
		#navbar-main .navbar-toggler-icon {
			background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgb(68, 189, 255)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
		}
		
		#navbar-main .navbar-nav > li.nav-item > a {
			text-transform: uppercase;
			font-size: 0.875rem;
			font-weight: 600;
			letter-spacing: 1px;
			text-align: center;
		}
		
		#navbar-main .navbar-brand .fa-cube {
			font-size: 2rem;
		}
		
		header.masthead {
			padding-top: 5rem;
			padding-bottom: 5rem;
			margin-bottom: 3rem;
			background: #a3bded;
			background: -webkit-linear-gradient(-20deg, #a3bded 0%, #6991c7 100%);
			background: -moz-linear-gradient(-20deg, #a3bded 0%, #6991c7 100%);
			background: linear-gradient(-20deg, #a3bded 0%, #6991c7 100%);
		}
		
		header.masthead .site-heading {
			padding: 100px 0 50px;
			color: #fff;
		}
		
		header.masthead .site-heading h1 {
			font-size: 2.3rem;
		}
		
		header.masthead .site-heading .subheading {
			display: block;
			font-weight: 300;
			margin: 0.625rem 0 0;
			color: #fff;
		}

		footer.bottom
		{
			background: -webkit-linear-gradient(-20deg, #a3bded 0%, #6991c7 100%);
			background: -moz-linear-gradient(-20deg, #a3bded 0%, #6991c7 100%);
			background: linear-gradient(-20deg, #a3bded 0%, #6991c7 100%);
			/* margin-top: 15px; */
			padding: 5px 0;
			/* position: fixed; */
			width: 100%;
            bottom: 0;
            left: 0;
			
		}

        .footer-text {
            color: #333;
            margin-bottom: 10px;
        }

		.social-link {
            color: #333;
            font-size: 24px;
            margin-right: 15px;
        }
		
		
		
		ul.job-list {
			margin: 0;
			padding: 0;
			list-style: none;
		}
		
		ul.job-list > li.job-preview {
			background: #fff;
			border: 1px solid #d7e2e9;
			-webkit-border-radius: 0.4rem;
			-moz-border-radius: 0.4rem;
			border-radius: 0.4rem;
			padding: 1.5rem 2rem;
			margin-bottom: 1rem;
			float: left;
			width: 100%;
			-webkit-transition: all 0.3s ease 0s;
			-moz-transition: all 0.3s ease 0s;
			transition: all 0.3s ease 0s;
		}
		
		ul.job-list > li.job-preview:hover {
			cursor: pointer;
			-webkit-box-shadow: 0 3px 8px rgba(0,0,0,0.05);
			-moz-box-shadow: 0 3px 8px rgba(0,0,0,0.05);
			box-shadow: 0 3px 8px rgba(0,0,0,0.05);
		}
		
		.job-title {
			margin-top: 0.6rem;
		}
		
		.company {
			color: #96a4b1;
		}
		
		.job-preview .btn {
			margin-top: 1.1rem;
		}
		
		.btn-apply {
			text-transform: uppercase;
			font-size: 0.875rem;
			font-weight: 800;
			letter-spacing: 1px;
			background-color: transparent;
			color:  #393a5f;
			border: 2px solid #393a5f;
			padding: 0.6rem 2rem;
			-webkit-border-radius: 2rem;
			-moz-border-radius: 2rem;
			border-radius: 2rem;
		}
		
		.btn-apply:hover {
			background-color: #393a5f;
			color:  #fff;
			border: 2px solid #393a5f;
		}
		
		@media (max-width: 575px) {
			.job-preview .content {
				width: 100%;
			}
		}
		
		@media only screen and (min-width: 10000px) {
			#navbar-main {
				background: transparent;
				border-bottom: 1px solid transparent;
				font
			}
			
			#navbar-main .navbar-brand {
				color: #fff;
				opacity: 0.8;
				padding: 0.95rem 1.2rem;
			}
			
			#navbar-main .navbar-brand:hover,
			#navbar-main .navbar-brand:focus {
				opacity: 1;
			}
			
			#navbar-main .navbar-nav > li.nav-item > a {
				color: #fff;
				opacity: 0.8;
				padding: 0.95rem 1.2rem;
			}
			
			#navbar-main .navbar-nav > li.nav-item > a:hover,
			#navbar-main .navbar-nav > li.nav-item > a:focus {
				opacity: 1;
			}

			
		}

		.navbar-title
			{
				font-size: 40px;
				font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
				font-weight: bold;
				text-decoration: none;
				color: #96a4b1;
				/* margin-left: 75px; */

			

			}

		#logout-button {

				background-color: #e53e3e; /* Red color */
				color: #fff; /* White text color */
				font-weight: bold;
				border: none;
				border-radius: 4px;
				padding: 8px 20px; /* Adjust padding as needed */
				cursor: pointer;
			}
		
			#logout-button:hover {
				background-color: #c53030; /* Darker red color on hover */
			}
		
			#homeButton {
			cursor: pointer;
			position: absolute;
			top: 20px;
			left: 20px;
			z-index: 100;
			background-color: white;
			border: 2px solid #007bff;
			border-radius: 50%;
			padding: 10px;
			transition: transform 0.3s ease;

		}

		.buttons.float-md-start {
			margin-right: 15px;
		}

		
		

		</style> --}}