<div id="chatbox" class="container-fluid">
	<div id="messages">
		<?php if(count($messages)==0): ?>
			<div class="alert alert-primary text-center mt-3">No messages found till now!</div>
		<?php else: foreach ($messages as $message) : ?>
			<?php if($message->type == "nmc") : ?>
				<div class="alert alert-info text-center"><?= $message->message ?></div>
			<?php else: if($message->username == $username) : ?>
				<div class="chat-box right">
				  <p><?= str_replace("\n", "<br>", $message->message); ?></p>
				  <span class="msg-details">
				  	<span class="user"><?= $message->username; ?></span>
				  	<span class="msg-time"><?= explode(" ", $message->timestamp)[1] ?></span>
				  </span>
				</div>
			<?php else : ?>
				<div class="chat-box">
				  <p><?= str_replace("\n", "<br>", $message->message); ?></p>
				  <span class="msg-details">
				  	<span class="user"><?= $message->username; ?></span>
				  	<span class="msg-time"><?= explode(" ", $message->timestamp)[1] ?></span>
				  </span>
				</div>
			<?php endif; ?>
			<?php endif; ?>
<?php endforeach; ?>
		<?php endif; ?>
<!-- 
<div class="chat-box">
		  <p>Hello. How are you today?</p>
		  <span class="msg-details">
		  	<span class="user">Shivam</span>
		  	<span class="msg-time">11:01</span>
		  </span>
		</div> -->
		<!-- <div class="chat-box right">
		  <p>Hey! I'm fine. Thanks for asking!</p>
		  <span class="msg-details">
		  	<span class="user">Shubham</span>
		  	<span class="msg-time">11:01</span>
		  </span>
		</div> -->

	</div>
</div>
<textarea name="" id="senderText" cols="30" class="chat-box" placeholder="Write your message here..."></textarea>