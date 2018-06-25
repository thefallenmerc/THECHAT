<navbar id="header" class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
	<a href="<?= base_url() ?>" class="navbar-brand"><?= $site_name ?></a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
	<div class="collapse navbar-collapse" id="collapsibleNavbar">
		<ul class="navbar-nav mr-auto">
		<!-- dropdown -->
	    <li class="nav-item dropdown">
	      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
	        THEME
	      </a>
	      <div class="dropdown-menu">
	        <a class="dropdown-item text-dark" onclick="setTheme(0)" href="#">DEFAULT</a>
	        <a class="dropdown-item text-dark" onclick="setTheme(1)" href="#">RED</a>
	        <a class="dropdown-item text-dark" onclick="setTheme(2)" href="#">VIOLET</a>
	        <a class="dropdown-item text-dark" onclick="setTheme(3)" href="#">ORANGE</a>
	        <a class="dropdown-item text-dark" onclick="setTheme(-1)" href="#">PINK</a>
	      </div>
	    </li>
	    <!-- Dropdown -->
	    <li class="nav-item">
	    	<a href="#" class="nav-link" onclick="toggleFullscreen()">APP MODE</a>
	    </li>
		<li class="nav-item">
			<a href="<?php echo base_url("controllerMain/setUsername"); ?>" class="nav-link">ABOUT</a>
		</li>
	    <li class="nav-item">
	    	<a href="#" class="nav-link" id="openModal">USERNAME</a>
	    </li>
		</ul>
	</div>
</navbar>
