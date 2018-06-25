<navbar id="footer" class="navbar navbar-extend-sm bg-dark fixed-bottom">
	<a href="<?= base_url() ?>" class="navbar-brand">(C) DEADPOOL</a>
	<a href="#" class="btn btn-light text-dark" onclick="sendMessage()" id="sendButton">SEND</a>
</navbar>


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <input type="text" id="username" class="form-control" placeholder="Username" value="<?= $username ?>">
      </div>
    </div>
  </div>
</div>



	<script>

		theme = "<?= $theme; ?>";
		$(".chat-box").addClass("<?= $theme; ?>");
		$(".username").addClass("<?= $theme; ?>");
	</script>
	<script src="<?php echo base_url() ?>assets/js/chat.js"></script>
<style>
	#myModal .modal-dialog{
		box-shadow: 0px 0px 5px 0px #232323;
	}
	#myModal{
		background-color: rgba(0,0,0,0.7);
	}

</style>

</body>
</html>